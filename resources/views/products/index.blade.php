<x-app-layout>
    <div style="background-color: #e0f2fe; min-height: 100vh; padding: 30px 15px;">
        <div style="max-width: 1200px; margin: 0 auto; background: #ffffff; border-radius: 20px; box-shadow: 0 4px 20px rgba(14, 165, 233, 0.15); padding: 25px; border: 1px solid #bae6fd;">
            
            <!-- Header Judul & Tombol Tambah Sejajar -->
            <div style="display: flex; justify-content: space-between; align-items: center; border-bottom: 2px solid #f0f9ff; padding-bottom: 15px; margin-bottom: 20px;">
                <div>
                    <h2 style="font-size: 20px; font-weight: bold; color: #0369a1; margin: 0;">Manajemen Produk & Stok</h2>
                    <p style="font-size: 13px; color: #64748b; margin: 3px 0 0 0;">Daftar lengkap SKU, kategori, harga beli, harga jual, dan stok barang.</p>
                </div>
                
                <!-- Tombol Tambah Produk -->
                <a href="{{ url('/products/create') }}" style="background-color: #0284c7; color: white; padding: 10px 18px; border-radius: 12px; font-size: 13px; font-weight: bold; text-decoration: none; box-shadow: 0 2px 5px rgba(2, 132, 199, 0.3); white-space: nowrap;">
                    + Tambah Produk
                </a>
            </div>

            <!-- Tabel Data Produk -->
            <div style="overflow-x: auto;">
                <table style="width: 100%; border-collapse: collapse; text-align: left;">
                    <thead>
                        <tr style="background-color: #f0f9ff; color: #0369a1; font-size: 12px; text-transform: uppercase;">
                            <th style="padding: 12px 12px; border-top-left-radius: 10px; border-bottom-left-radius: 10px; width: 40px; text-align: center;">No</th>
                            <th style="padding: 12px 12px;">SKU</th>
                            <th style="padding: 12px 12px;">Nama Produk</th>
                            <th style="padding: 12px 12px;">Kategori</th>
                            <th style="padding: 12px 12px;">Harga Beli</th>
                            <th style="padding: 12px 12px;">Harga Jual</th>
                            <th style="padding: 12px 12px; text-align: center;">Stok</th>
                            <th style="padding: 12px 12px; border-top-right-radius: 10px; border-bottom-right-radius: 10px; text-align: center; width: 140px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody style="font-size: 13px; color: #334155;">
                        @forelse($products ?? [] as $index => $product)
                        <tr style="border-bottom: 1px solid #f1f5f9;">
                            <td style="padding: 12px 12px; text-align: center; font-weight: bold; color: #94a3b8;">
                                {{ $products->firstItem() ? $products->firstItem() + $index : $index + 1 }}
                            </td>
                            <td style="padding: 12px 12px; font-weight: 600; color: #0284c7;">{{ $product->code ?? '-' }}</td>
                            <td style="padding: 12px 12px; font-weight: 600; color: #1e293b;">{{ $product->name }}</td>
                            
                            <!-- Kolom Kategori -->
                            <td style="padding: 12px 12px;">
                                <span style="background-color: #e0f2fe; color: #0369a1; padding: 4px 8px; border-radius: 20px; font-size: 11px; font-weight: 600;">
                                    {{ $product->category->name ?? '-' }}
                                </span>
                            </td>
                            
                            <td style="padding: 12px 12px; color: #64748b;">Rp {{ number_format($product->cost_price ?? 0, 0, ',', '.') }}</td>
                            <td style="padding: 12px 12px; font-weight: 600; color: #059669;">Rp {{ number_format($product->sell_price ?? 0, 0, ',', '.') }}</td>
                            <td style="padding: 12px 12px; text-align: center;">
                                <span style="background-color: {{ ($product->stock ?? 0) > 5 ? '#d1fae5' : '#fee2e2' }}; color: {{ ($product->stock ?? 0) > 5 ? '#065f46' : '#991b1b' }}; padding: 4px 8px; border-radius: 20px; font-size: 11px; font-weight: bold;">
                                    {{ $product->stock ?? 0 }} pcs
                                </span>
                            </td>
                            <td style="padding: 12px 12px; text-align: center;">
                                <div style="display: flex; gap: 6px; justify-content: center;">
                                    <a href="{{ url('/products/'.$product->id.'/edit') }}" style="background-color: #e0f2fe; color: #0369a1; padding: 5px 10px; border-radius: 6px; font-size: 11px; font-weight: bold; text-decoration: none;">Edit</a>
                                    
                                    <form action="{{ url('/products/'.$product->id) }}" method="POST" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" onclick="return confirm('Yakin ingin menghapus produk ini?')" style="background-color: #fee2e2; color: #dc2626; padding: 5px 10px; border-radius: 6px; font-size: 11px; font-weight: bold; border: none; cursor: pointer;">Hapus</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" style="padding: 30px; text-align: center; color: #94a3b8; font-style: italic;">
                                Belum ada data produk yang ditambahkan.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Link pagination -->
            @if(isset($products) && method_exists($products, 'links'))
                <div style="margin-top: 20px;">
                    {{ $products->links() }}
                </div>
            @endif

        </div>
    </div>
</x-app-layout>