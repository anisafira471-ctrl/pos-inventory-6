<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class SaleController extends Controller
{
    /**
     * Tampilkan daftar transaksi penjualan.
     */
    public function index()
    {
        $sales = Sale::with(['user', 'items.product'])
            ->latest('sold_at')
            ->paginate(10);

        return view('sales.index', compact('sales'));
    }

    /**
     * Tampilkan form kasir / transaksi penjualan baru.
     */
    public function create()
    {
        $products = Product::where('stock', '>', 0)->get();
        return view('sales.create', compact('products'));
    }

    /**
     * Simpan transaksi penjualan baru menggunakan DB::transaction (Atomik).
     */
    public function store(Request $request)
    {
        $request->validate([
            'items' => 'required|array|min:1',
            'items.*.product_id' => 'required|exists:products,id',
            'items.*.quantity' => 'required|integer|min:1',
        ]);

        try {
            DB::transaction(function () use ($request) {
                // 1. Buat header Penjualan
                $sale = Sale::create([
                    'user_id' => auth()->id(),
                    'sale_number' => 'SALE-' . date('Ymd') . '-' . strtoupper(substr(uniqid(), -4)),
                    'total' => 0,
                    'status' => 'completed',
                    'sold_at' => now(),
                ]);

                $total = 0;

                // 2. Loop setiap item barang
                foreach ($request->items as $itemData) {
                    // Lock data produk untuk mencegah race condition / overselling
                    $product = Product::lockForUpdate()->findOrFail($itemData['product_id']);
                    $qty = (int) $itemData['quantity'];

                    // Validasi kecukupan stok
                    if ($product->stock < $qty) {
                        throw ValidationException::withMessages([
                            'items' => "Stok untuk produk {$product->name} tidak mencukupi (Tersedia: {$product->stock}, Diminta: {$qty})."
                        ]);
                    }

                    // Ambil harga jual dari database, bukan dari input browser
                    $unitPrice = $product->sell_price ?? $product->price ?? 0;
                    
                    // Hitung subtotal dengan operator perkalian yang benar
                    $subtotal = $unitPrice * $qty;

                    // Buat detail item penjualan
                    $sale->items()->create([
                        'product_id' => $product->id,
                        'quantity' => $qty,
                        'unit_price' => $unitPrice,
                        'subtotal' => $subtotal,
                    ]);

                    // Kurangi stok produk secara otomatis
                    $product->decrement('stock', $qty);

                    $total += $subtotal;
                }

                // Update total bayar pada header penjualan
                $sale->update(['total' => $total]);
            });

            return redirect()->route('sales.index')->with('success', 'Transaksi penjualan berhasil disimpan dan stok otomatis berkurang!');
        } catch (\Exception $e) {
            return back()->withInput()->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Tampilkan detail transaksi penjualan.
     */
    public function show($id)
    {
        $sale = Sale::with(['user', 'items.product'])->findOrFail($id);
        return view('sales.show', compact('sale'));
    }
}