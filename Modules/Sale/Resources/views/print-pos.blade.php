<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice {{ $sale->id }}</title>
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@400;500;700&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-size: 12px;
            line-height: 18px;
            font-family: 'Ubuntu', sans-serif;
        }

        body {
            background-color: #f5f5f5;
            padding: 20px;
            display: flex;
            justify-content: center;
        }

        .invoice-container {
            max-width: 800px;
            width: 100%;
            background: white;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 30px;
            position: relative;
        }

        .company-header {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
            border-bottom: 2px solid #3498db;
            padding-bottom: 15px;
        }

        .logo {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, #3498db, #2c3e50);
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 15px;
            color: white;
            font-weight: bold;
            font-size: 14px;
            text-align: center;
            padding: 5px;
        }

        .company-info {
            flex-grow: 1;
        }

        .company-name {
            font-size: 22px;
            font-weight: 700;
            color: #2c3e50;
            margin-bottom: 5px;
        }

        .company-address {
            font-size: 12px;
            color: #555;
            margin-bottom: 3px;
        }

        .invoice-title {
            text-align: center;
            font-size: 24px;
            font-weight: 700;
            color: #2c3e50;
            margin: 25px 0;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .invoice-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 25px;
        }

        .invoice-table th {
            background-color: #3498db;
            color: white;
            font-weight: 500;
            text-align: center;
            padding: 10px 5px;
            border: 1px solid #2980b9;
        }

        .invoice-table td {
            padding: 8px 5px;
            border: 1px dashed #ddd;
            text-align: center;
        }

        .sub-header-row th {
            background-color: #2980b9;
        }

        .purchase-order {
            margin-top: 30px;
            padding: 15px;
            border: 1px dashed #3498db;
            border-radius: 5px;
            background-color: #f8f9fa;
        }

        .po-title {
            text-align: center;
            font-size: 18px;
            font-weight: 700;
            color: #2c3e50;
            margin-bottom: 15px;
        }

        .po-info {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
        }

        .po-section {
            width: 48%;
        }

        .po-row {
            display: flex;
            margin-bottom: 5px;
        }

        .po-label {
            width: 100px;
            font-weight: 500;
        }

        .signature-section {
            display: flex;
            justify-content: space-between;
            margin-top: 40px;
            padding-top: 20px;
            border-top: 2px dashed #3498db;
        }

        .signature-box {
            width: 45%;
        }

        .signature-title {
            font-weight: 700;
            margin-bottom: 40px;
        }

        .note-section {
            margin-top: 20px;
            padding: 10px;
            border: 1px dashed #3498db;
            border-radius: 5px;
        }

        .note-title {
            font-weight: 700;
            margin-bottom: 5px;
        }

        .footer {
            text-align: center;
            margin-top: 30px;
            color: #7f8c8d;
            font-size: 11px;
            padding-top: 10px;
            border-top: 1px solid #ecf0f1;
        }

        .highlight {
            background-color: #f1f8ff;
        }

        .text-left {
            text-align: left;
        }

        .text-right {
            text-align: right;
        }

        .total-row td {
            font-weight: 700;
            background-color: #e3f2fd;
        }
    </style>
</head>
<body>
    <div class="invoice-container">
        <div class="company-header">
            <div class="logo">LOGO</div>
            <div class="company-info">
                {{-- Company Name & Address from settings --}}
                <div class="company-name">{{ $settings->company_name }}</div>
                <div class="company-address">{{ $settings->company_address }}</div>
            </div>
        </div>

        <div class="invoice-title">INVOICE #{{ $sale->id }}</div>

        <table class="invoice-table">
            <thead>
                <tr>
                    <th rowspan="2">No</th>
                    <th colspan="2">Waktu Pengiriman</th>
                    <th colspan="2">Deskripsi</th>
                    <th rowspan="2">QTY</th>
                    <th rowspan="2">Harga Satuan (Rp)</th>
                    <th rowspan="2">Sub Total (Rp)</th>
                    <th rowspan="2">Keterangan</th>
                </tr>
                <tr class="sub-header-row">
                    <th>Tanggal</th>
                    <th>Jam</th>
                    <th>Nama Barang</th>
                    <th>Variasi</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $totalAll = 0;
                @endphp
                @foreach($sale->saleDetails as $index => $detail)
                    @php
                        // Compute sub total: (unit_price * quantity) - discount
                        $subTotal = ($detail->unit_price * $detail->quantity) - $detail->product_discount_amount;
                        $totalAll += $subTotal;
                        $scheduledAt = $detail->scheduled_at ?? ($sale->shipment->scheduled_at ?? null);
                    @endphp
                    <tr @if($index % 2 == 1) class="highlight" @endif>
                        <td>{{ $index + 1 }}</td>
                        {{-- Waktu Pengiriman belum ada di DB, leave blank --}}
                        <td>
                            @if($scheduledAt)
                                {{ \Carbon\Carbon::parse($scheduledAt)->format('d-m-Y') }}
                            @endif
                        </td>
                        <td>
                            @if($scheduledAt)
                                {{ \Carbon\Carbon::parse($scheduledAt)->format('H:i') }}
                            @endif
                        </td>
                        <td class="text-left">{{ $detail->product->product_name }}</td>
                        {{-- Variasi tidak tersedia, leave blank --}}
                        <td></td>
                        <td>{{ $detail->quantity }}</td>
                        <td class="text-right">{{ number_format($detail->unit_price, 0, ',', '.') }}</td>
                        <td class="text-right">{{ number_format($subTotal, 0, ',', '.') }}</td>
                        {{-- Keterangan diambil dari header sale --}}
                        <td>{{ $sale->note }}</td>
                    </tr>
                @endforeach
                <tr class="total-row">
                    <td colspan="6" class="text-right">TOTAL</td>
                    <td class="text-right">-</td>
                    <td class="text-right">{{ number_format($totalAll, 0, ',', '.') }}</td>
                    <td></td>
                </tr>
            </tbody>
        </table>

        <div class="purchase-order">
            <div class="po-title">PURCHASE ORDER</div>
            <div class="po-info">
                <div class="po-section">
                    <div class="po-row">
                        <div class="po-label">Nama</div>
                        <div>: {{ $sale->customer->customer_name }}</div>
                    </div>
                    <div class="po-row">
                        <div class="po-label">Alamat</div>
                        <div>: {{ $sale->customer->address }}</div>
                    </div>
                </div>
                <div class="po-section">
                    <div class="po-row">
                        <div class="po-label">Tanggal</div>
                        {{-- Use invoice creation date --}}
                        <div>: {{ $sale->created_at->format('d M Y') }}</div>
                    </div>
                    <div class="po-row">
                        <div class="po-label">PIC Toko</div>
                        <div>:</div> {{-- kosong --}}
                    </div>
                </div>
            </div>
        </div>

        <div class="signature-section">
            <div class="signature-box">
                <div class="signature-title">Prepared By,</div>
                <div>_________________________</div>
                <div style="margin-top: 5px;"></div>
            </div>
            <div class="signature-box">
                <div class="signature-title">Approved By,</div>
                <div>_________________________</div>
                <div style="margin-top: 5px;"></div>
            </div>
        </div>

        <div class="note-section">
            <div class="note-title">Note :</div>
            <div>• Pembayaran dapat dilakukan melalui transfer bank (BCA 1234567890 a/n {{ $settings->company_name }})</div>
            <div>• Invoice ini valid hingga 30 hari setelah tanggal diterbitkan</div>
            <div>• Barang yang sudah dibeli tidak dapat dikembalikan</div>
        </div>

        <div class="footer">
            <div>Terima kasih atas kerjasamanya</div>
            <div>{{ $settings->company_website ?? '' }} | CS: {{ $settings->company_cs ?? '' }}</div>
        </div>
    </div>
</body>
</html>
