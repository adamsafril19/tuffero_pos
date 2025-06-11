<?php

namespace Modules\Product\Http\Controllers;

use Illuminate\Http\Request;
use Modules\Product\Entities\Variation;
use Modules\Product\Entities\Product;
use Illuminate\Routing\Controller;
use Modules\Product\DataTables\VariationDataTable;

class VariationController extends Controller
{
    public function index(VariationDataTable $dataTable)
    {
        return $dataTable->render('product::variations.index');
    }

    public function create()
    {
        return view('product::variations.create', [
            'products' => Product::all()
        ]);
    }

    public function store(Request $request)
    {
        // Validasi sesuai kolom di migration
        $validated = $request->validate([
            'name'       => 'required|string|max:255',
            'product_id' => 'required|exists:products,id',
            'price'      => 'required|numeric|min:0',
            'stock'      => 'required|integer|min:0',
        ]);

        Variation::create($validated);

        return redirect()->route('products.variations.index')
                         ->with('success', 'Variation created successfully');
    }

    public function edit(Variation $variation)
    {
        return view('product::variations.edit', [
            'variation' => $variation,
            'products' => Product::all()
        ]);
    }

    public function update(Request $request, Variation $variation)
    {
        // Validasi sama seperti di store
        $validated = $request->validate([
            'name'       => 'required|string|max:255',
            'product_id' => 'required|exists:products,id',
            'price'      => 'required|numeric|min:0',
            'stock'      => 'required|integer|min:0',
        ]);

        $variation->update($validated);

        return redirect()->route('products.variations.index')
                         ->with('success', 'Variation updated successfully');
    }

    public function destroy(Variation $variation)
    {
        $variation->delete();
        return redirect()->route('products.variations.index')
            ->with('success', 'Variation deleted successfully');
    }
}
