<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Supplier;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // 1. Menampilkan daftar produk (Diurutkan berdasarkan ID secara ascending agar SKU teratur)
    public function index(Request $request)
    {
        $products = Product::with(['category', 'supplier'])
            ->when($request->search, fn ($q, $s) => $q->where('name', 'like', "%{$s}%"))
            ->orderBy('id', 'asc')
            ->paginate(10)
            ->withQueryString();

        return view('products.index', compact('products'));
    }

    // 2. Menampilkan form tambah produk
    public function create()
    {
        $categories = Category::all();
        $suppliers = Supplier::all(); 
        
        return view('products.create', compact('categories', 'suppliers'));
    }

    // 3. Menyimpan produk baru beserta kategori, supplier, validasi harga, dan SKU terurut
    public function store(Request $request)
    {
        $request->validate([
            'name'          => 'required|string|max:255',
            'category'      => 'required|string|max:255',
            'supplier_id'   => 'required|exists:suppliers,id',
            'stock'         => 'required|integer|min:0',
            'minimum_stock' => 'nullable|integer|min:0',
            'cost_price'    => 'required|numeric|min:0',
            'sell_price'    => 'required|numeric|gt:cost_price',
        ], [
            'sell_price.gt' => 'Harga jual harus lebih besar dari harga beli (tidak boleh rugi / sama persis).',
        ]);

        $category = Category::firstOrCreate([
            'name' => $request->category
        ]);

        $nextId = Product::max('id') + 1;
        $formattedCode = 'PROD-' . str_pad($nextId, 3, '0', STR_PAD_LEFT);

        Product::create([
            'category_id'   => $category->id,
            'supplier_id'   => $request->supplier_id,
            'code'          => $formattedCode,
            'name'          => $request->name,
            'stock'         => $request->stock,
            'minimum_stock' => $request->minimum_stock ?? 5,
            'cost_price'    => $request->cost_price,
            'sell_price'    => $request->sell_price,
        ]);

        return redirect()->route('products.index')->with('success', 'Produk berhasil disimpan!');
    }

    // 4. Menampilkan form edit produk (BARU DITAMBAHKAN)
    public function edit($id)
    {
        $product = Product::with(['category', 'supplier'])->findOrFail($id);
        $categories = Category::all();
        $suppliers = Supplier::all();

        return view('products.edit', compact('product', 'categories', 'suppliers'));
    }

    // 5. Menyimpan perubahan data produk hasil edit (BARU DITAMBAHKAN)
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $request->validate([
            'name'          => 'required|string|max:255',
            'category'      => 'required|string|max:255',
            'supplier_id'   => 'required|exists:suppliers,id',
            'stock'         => 'required|integer|min:0',
            'minimum_stock' => 'nullable|integer|min:0',
            'cost_price'    => 'required|numeric|min:0',
            'sell_price'    => 'required|numeric|gt:cost_price',
        ], [
            'sell_price.gt' => 'Harga jual harus lebih besar dari harga beli (tidak boleh rugi / sama persis).',
        ]);

        $category = Category::firstOrCreate([
            'name' => $request->category
        ]);

        $product->update([
            'category_id'   => $category->id,
            'supplier_id'   => $request->supplier_id,
            'name'          => $request->name,
            'stock'         => $request->stock,
            'minimum_stock' => $request->minimum_stock ?? 5,
            'cost_price'    => $request->cost_price,
            'sell_price'    => $request->sell_price,
        ]);

        return redirect()->route('products.index')->with('success', 'Produk berhasil diperbarui!');
    }

    // 6. Menghapus data produk
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return redirect()->route('products.index')->with('success', 'Produk berhasil dihapus!');
    }
}