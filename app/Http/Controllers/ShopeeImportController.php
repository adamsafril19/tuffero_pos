<?php

namespace App\Http\Controllers;

use App\Imports\ShopeeOrderImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ShopeeImportController extends Controller
{
    public function index()
    {
        return view('shopee.import');
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls',
        ]);

        try {
            Excel::import(new ShopeeOrderImport, $request->file('file'));

            return redirect()->route('sales.index')->with('success', 'Data pesanan Shopee berhasil diimport!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}
