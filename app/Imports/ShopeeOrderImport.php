<?php

namespace App\Imports;

use App\Models\Customer;
use Modules\People\Entities\Customer as ModulesCustomer;
use Modules\Product\Entities\Product;
use Modules\Sale\Entities\Sale;
use Modules\Sale\Entities\SaleDetails;
use Modules\Sale\Entities\SalePayment;
use Modules\Sale\Entities\SaleShipment;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ShopeeOrderImport implements ToCollection, WithHeadingRow
{
    public function collection(Collection $rows)
    {
        DB::beginTransaction();

        try {
            foreach ($rows as $row) {
                // Cek apakah pesanan sudah ada berdasarkan nomor pesanan
                $existingSale = Sale::where('order_number', $row['no_pesanan'])->first();

                if ($existingSale) {
                    // Update pesanan yang sudah ada
                    $this->updateExistingSale($existingSale, $row);
                } else {
                    // Buat pesanan baru
                    $this->createNewSale($row);
                }
            }

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error importing Shopee orders: ' . $e->getMessage());
            throw $e;
        }
    }

    private function updateExistingSale($sale, $row)
    {
        // Update data sale
        $sale->update([
            'status' => $this->mapStatus($row['status_pesanan'] ?? ''),
            'total_amount' => $row['total_pembayaran'] ?? $sale->total_amount,
            // 'completed_at' => isset($row['waktu_pesanan_selesai']) ? Carbon::parse($row['waktu_pesanan_selesai']) : null,
        ]);

        // Update atau buat shipment
        $shipment = SaleShipment::where('sale_id', $sale->id)->first();

        if ($shipment) {
            $shipment->update([
                'tracking_number' => $row['no_resi'] ?? $shipment->tracking_number,
                'shipping_option' => $row['opsi_pengiriman'] ?? $shipment->shipping_option,
                'delivery_type' => $this->mapDeliveryType($row['antar_ke_counterpick_up'] ?? ''),
                'shipping_cost' => $row['biaya_pengiriman'] ?? $shipment->shipping_cost,
            ]);
        } else {
            $this->createShipment($sale->id, $row);
        }

        // Update payment method jika ada
        if (isset($row['metode_pembayaran']) && !empty($row['metode_pembayaran'])) {
            SalePayment::updateOrCreate(
                ['sale_id' => $sale->id],
                [
                    'payment_method' => $row['metode_pembayaran'],
                    'date' => isset($row['waktu_pesanan_selesai']) ? Carbon::parse($row['waktu_pesanan_selesai']) : now(),
                    'amount' => $row['total_pembayaran'] ?? 0,
                    'reference' => 'SHOPEE-' . time(),
                ]
            );
        }
    }

    private function createNewSale($row)
    {
        // Cari atau buat customer baru (menggunakan alamat sebagai identifikasi)
        $customer = $this->findOrCreateCustomer($row);

        // Buat sale baru
        $sale = Sale::create([
            'order_number' => $row['no_pesanan'] ?? null,
            'date' => isset($row['tanggal_pesanan']) ? Carbon::parse($row['tanggal_pesanan']) : now(),
            'reference' => 'SHOPEE-IMPORT-' . time(),
            'customer_id' => null,
            'customer_name' => 'customer shopee',
            'tax_percentage' => 0,
            'tax_amount' => 0,
            'discount_percentage' => 0,
            'discount_amount' => $row['potongan_jika_ada'] ?? 0,
            'shipping_amount' => $row['biaya_pengiriman'] ?? 0,
            'paid_amount' => $row['total_harga_produk'] ?? 0,
            'total_amount' => $row['total_harga_produk'] ?? 0,
            'due_amount' => 0,
            'status' => $this->mapStatus($row['status_pesanan'] ?? ''),
            'payment_status' => $this->mapPaymentStatus($row['status_pesanan'] ?? ''),
            'payment_method' => $row['metode_pembayaran'] ?? 'Shopee',
            'note' => $row['catatan_dari_pembeli'] ?? 'Imported from Shopee',
            'order_number' => $row['no_pesanan'] ?? null,
            // 'completed_at' => isset($row['waktu_pesanan_selesai']) ? Carbon::parse($row['waktu_pesanan_selesai']) : null,
        ]);

        // Cari produk berdasarkan nama atau SKU
        $product = $this->findOrCreateProduct($row);

        // Buat sale detail
        SaleDetails::create([
            'sale_id' => $sale->id,
            'product_id' => $product->id,
            'product_name' => $row['nama_produk'],
            'product_code' => $row['sku_induk'],
            'quantity' => $row['jumlah'] ?? 1,
            'price' => $row['harga_satuan'] ?? 0,
            'unit_price' => $row['harga_satuan'] ?? 0,
            'sub_total' => $row['total_harga_barang_subtotal'] ?? 0,
            'product_discount_amount' => $row['potongan_jika_ada'] ?? 0,
            'product_discount_type' => 'fixed',
            'product_tax_amount' => 0,
        ]);

        // Buat payment record
        SalePayment::create([
            'sale_id' => $sale->id,
            'amount' => $row['total_harga_produk'] ?? 0,
            'date' => now(),
            'reference' => 'SHOPEE-' . time(),
            'payment_method' => $row['metode_pembayaran'] ?? 'Shopee',
        ]);

        // Buat shipment record
        $this->createShipment($sale->id, $row);
    }

    private function createShipment($saleId, $row)
    {
        SaleShipment::create([
            'sale_id' => $saleId,
            'tracking_number' => $row['no_resi'] ?? null,
            'shipping_option' => $row['opsi_pengiriman'] ?? null,
            'delivery_type' => $this->mapDeliveryType($row['antar_ke_counterpick_up'] ?? ''),
            'destination_address' => $row['alamat_pengiriman'] ?? null,
            'city' => $row['kotakabupaten'] ?? null,
            'province' => $row['provinsi'] ?? null,
            'shipping_cost' => $row['biaya_pengiriman'] ?? 0,
        ]);
    }

    private function findOrCreateCustomer($row)
    {
        $address = $row['alamat_pengiriman'] ?? '';
        $city = $row['kotakabupaten'] ?? '';
        $province = $row['provinsi'] ?? '';

        // Coba cari customer berdasarkan alamat
        $customer = ModulesCustomer::where('address', 'like', "%$address%")
            ->where('city', 'like', "%$city%")
            ->first();

        // if (!$customer) {
        //     // Buat customer baru jika tidak ditemukan
        //     $customer = ModulesCustomer::create([
        //         'name' => $row['nama_pembeli'] ?? 'Shopee Customer',
        //         'email' => null,
        //         'phone' => null,
        //         'address' => $address,
        //         'city' => $city,
        //         'country' => $province,
        //         'tax_number' => null,
        //     ]);
        // }

        // return $customer;
    }

    private function findOrCreateProduct($row)
    {
        $productName = $row['nama_produk'] ?? '';
        $productSku = $row['sku_induk'] ?? '';

        // Cari produk berdasarkan SKU atau nama
        $product = null;

        if (!empty($productSku)) {
            $product = Product::where('product_code', $productSku)->first();
        }

        if (!$product && !empty($productName)) {
            $product = Product::where('product_name', 'like', "%$productName%")->first();
        }

        if (!$product) {
            // Buat produk baru jika tidak ditemukan
            $product = Product::create([
                'product_name' => $productName,
                'product_code' => $productSku ?: 'SHOPEE-' . time(),
                'product_barcode_symbology' => 'code128',
                'product_quantity' => 0,
                'product_cost' => 0,
                'product_price' => $row['harga_satuan'] ?? 0,
                'category_id' => 1, // Default category, sesuaikan dengan kebutuhan
                'product_unit' => 1, // Default unit, sesuaikan dengan kebutuhan
                'product_stock_alert' => 0,
                // 'status' => 1,
            ]);
        }

        return $product;
    }

    private function mapStatus($status)
    {
        $statusMap = [
            'Selesai' => 'Completed',
            'Dalam Pengiriman' => 'Shipped',
            'Dibatalkan' => 'Canceled',
            'Menunggu Pembayaran' => 'Pending',
            'Pesanan Dibuat' => 'Pending',
            'Siap Dikirim' => 'Processing',
        ];

        return $statusMap[$status] ?? 'Pending';
    }

    private function mapPaymentStatus($status)
    {
        $statusMap = [
            'Selesai' => 'Paid',
            'Dalam Pengiriman' => 'Paid',
            'Dibatalkan' => 'Unpaid',
            'Menunggu Pembayaran' => 'Unpaid',
            'Pesanan Dibuat' => 'Unpaid',
            'Siap Dikirim' => 'Paid',
        ];

        return $statusMap[$status] ?? 'Unpaid';
    }

    private function mapDeliveryType($type)
    {
        if (stripos($type, 'pick') !== false || stripos($type, 'ambil') !== false) {
            return 'pickup';
        }

        return 'courier';
    }
}
