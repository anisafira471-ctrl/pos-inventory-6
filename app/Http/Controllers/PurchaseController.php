<?php

namespace App\Http\Controllers;

use App\Models\Purchase;
use App\Models\Product;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class PurchaseController extends Controller
{
    public function index()
    {
        $purchases = Purchase::with(['user', 'supplier', 'items.product'])
            ->latest('purchased_at')
            ->paginate(10);

        return view('purchases.index', compact('purchases'));
    }

    public function create()
    {
        $suppliers = Supplier::all();
        $products = Product::all();
        return view('purchases.create', compact('suppliers', 'products'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'supplier_id' => 'required|exists:suppliers,id',
            'items' => 'required|array|min:1',
            'items.*.product_id' => 'required|exists:products,id',
            'items.*.quantity' => 'required|integer|min:1',
            'items.*.cost_price' => 'required|numeric|min:0',
        ]);

        try {
            DB::transaction(function () use ($request) {
                $purchase = Purchase::create([
                    'user_id' => auth()->id(),
                    'supplier_id' => $request->supplier_id,
                    'purchase_number' => 'PO-' . date('Ymd') . '-' . strtoupper(substr(uniqid(), -4)),
                    'total' => 0,
                    'purchased_at' => now(),
                ]);

                $total = 0;

                foreach ($request->items as $itemData) {
                    $product = Product::lockForUpdate()->findOrFail($itemData['product_id']);
                    $qty = (int) $itemData['quantity'];
                    $costPrice = (float) $itemData['cost_price'];
                    $subtotal = $costPrice * $qty;

                    // Simpan detail item pembelian
                    $purchase->items()->create([
                        'product_id' => $product->id,
                        'quantity' => $qty,
                        'cost_price' => $costPrice,
                        'subtotal' => $subtotal,
                    ]);

                    // Tambah stok produk secara otomatis di database
                    $product->increment('stock', $qty);
                    
                    // Update harga beli produk jika ada perubahan
                    $product->update(['cost_price' => $costPrice]);

                    $total += $subtotal;
                }

                $purchase->update(['total' => $total]);
            });

            return redirect()->route('purchases.index')->with('success', 'Transaksi pembelian berhasil disimpan dan stok bertambah otomatis!');
        } catch (\Exception $e) {
            return back()->withInput()->withErrors(['error' => $e->getMessage()]);
        }
    }
}