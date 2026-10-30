<x-app-layout>
    <x-slot name="header">
        <div style="display: flex; justify-content: space-between; align-items: center;">
            <h2 style="font-weight: 800; font-size: 1.5rem; color: #0c4a6e;">
                {{ __('Dashboard POS Inventory') }}
            </h2>
            <span style="background-color: #e0f2fe; color: #0369a1; padding: 6px 16px; border-radius: 20px; font-weight: 600; font-size: 0.85rem; border: 1px solid #bae6fd;">
                ● System Active
            </span>
        </div>
    </x-slot>

    <div style="background-color: #f0f9ff; min-height: 100vh; padding: 24px 0;">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            <!-- Hero Banner Biru Soft Gradient -->
            <div style="background: linear-gradient(135deg, #0284c7 0%, #2563eb 100%); border-radius: 20px; padding: 28px; color: white; box-shadow: 0 10px 25px -5px rgba(2, 132, 199, 0.3); display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 16px;">
                <div>
                    <span style="background: rgba(255,255,255,0.2); padding: 4px 12px; border-radius: 8px; font-size: 0.75rem; font-weight: 600;">
                        Selamat Datang
                    </span>
                    <h3 style="font-size: 1.75rem; font-weight: 800; margin-top: 6px; margin-bottom: 4px;">
                        Halo, {{ Auth::user()->name }}! 👋
                    </h3>
                    <p style="color: #e0f2fe; font-size: 0.9rem;">
                        Kelola inventaris dan pantau stok barang toko kamu di sini.
                    </p>
                </div>
                <div>
                    <a href="{{ route('products.create') }}" style="background-color: white; color: #0284c7; font-weight: 700; padding: 10px 20px; border-radius: 12px; text-decoration: none; font-size: 0.875rem; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1); display: inline-block;">
                        + Tambah Produk Baru
                    </a>
                </div>
            </div>

            <!-- Kartu Statistik (5 Grid) -->
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 16px;">
                
                <!-- Card 1: Total Produk (Klik -> Halaman Produk) -->
                <a href="{{ route('products.index') }}" style="text-decoration: none; display: block;">
                    <div style="background-color: white; border-radius: 16px; padding: 20px; border-left: 6px solid #0284c7; box-shadow: 0 4px 12px rgba(0,0,0,0.03); border-top: 1px solid #e0f2fe; border-right: 1px solid #e0f2fe; border-bottom: 1px solid #e0f2fe; transition: transform 0.2s;" onmouseover="this.style.transform='translateY(-3px)'" onmouseout="this.style.transform='translateY(0)'">
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <div>
                                <p style="font-size: 0.75rem; font-weight: 700; text-transform: uppercase; color: #0284c7; letter-spacing: 0.5px;">Total Produk</p>
                                <h4 style="font-size: 1.85rem; font-weight: 800; color: #0f172a; margin-top: 4px;">{{ \App\Models\Product::count() }}</h4>
                                <span style="font-size: 0.75rem; color: #64748b;">Item terdaftar &rarr;</span>
                            </div>
                            <div style="background-color: #e0f2fe; color: #0284c7; padding: 12px; border-radius: 12px; font-size: 1.5rem;">📦</div>
                        </div>
                    </div>
                </a>

                <!-- Card 2: Total Kategori (Klik -> Halaman Kategori) -->
                <a href="{{ route('categories.index') }}" style="text-decoration: none; display: block;">
                    <div style="background-color: white; border-radius: 16px; padding: 20px; border-left: 6px solid #2563eb; box-shadow: 0 4px 12px rgba(0,0,0,0.03); border-top: 1px solid #dbeafe; border-right: 1px solid #dbeafe; border-bottom: 1px solid #dbeafe; transition: transform 0.2s;" onmouseover="this.style.transform='translateY(-3px)'" onmouseout="this.style.transform='translateY(0)'">
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <div>
                                <p style="font-size: 0.75rem; font-weight: 700; text-transform: uppercase; color: #2563eb; letter-spacing: 0.5px;">Total Kategori</p>
                                <h4 style="font-size: 1.85rem; font-weight: 800; color: #0f172a; margin-top: 4px;">{{ \App\Models\Category::count() }}</h4>
                                <span style="font-size: 0.75rem; color: #64748b;">Kelompok barang &rarr;</span>
                            </div>
                            <div style="background-color: #dbeafe; color: #2563eb; padding: 12px; border-radius: 12px; font-size: 1.5rem;">🏷️</div>
                        </div>
                    </div>
                </a>

                <!-- Card 3: Total Supplier (Klik -> Halaman Supplier) -->
                <a href="{{ route('suppliers.index') }}" style="text-decoration: none; display: block;">
                    <div style="background-color: white; border-radius: 16px; padding: 20px; border-left: 6px solid #8b5cf6; box-shadow: 0 4px 12px rgba(0,0,0,0.03); border-top: 1px solid #f3e8ff; border-right: 1px solid #f3e8ff; border-bottom: 1px solid #f3e8ff; transition: transform 0.2s;" onmouseover="this.style.transform='translateY(-3px)'" onmouseout="this.style.transform='translateY(0)'">
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <div>
                                <p style="font-size: 0.75rem; font-weight: 700; text-transform: uppercase; color: #7c3aed; letter-spacing: 0.5px;">Total Supplier</p>
                                <h4 style="font-size: 1.85rem; font-weight: 800; color: #0f172a; margin-top: 4px;">{{ \App\Models\Supplier::count() }}</h4>
                                <span style="font-size: 0.75rem; color: #64748b;">Mitra toko &rarr;</span>
                            </div>
                            <div style="background-color: #f3e8ff; color: #7c3aed; padding: 12px; border-radius: 12px; font-size: 1.5rem;">🚚</div>
                        </div>
                    </div>
                </a>

                <!-- Card 4: Akumulasi Stok -->
                <div style="background-color: white; border-radius: 16px; padding: 20px; border-left: 6px solid #06b6d4; box-shadow: 0 4px 12px rgba(0,0,0,0.03); border-top: 1px solid #cffaff; border-right: 1px solid #cffaff; border-bottom: 1px solid #cffaff;">
                    <div style="display: flex; justify-content: space-between; align-items: center;">
                        <div>
                            <p style="font-size: 0.75rem; font-weight: 700; text-transform: uppercase; color: #0891b2; letter-spacing: 0.5px;">Akumulasi Stok</p>
                            <h4 style="font-size: 1.85rem; font-weight: 800; color: #0f172a; margin-top: 4px;">{{ \App\Models\Product::sum('stock') }}</h4>
                            <span style="font-size: 0.75rem; color: #64748b;">Total unit gudang</span>
                        </div>
                        <div style="background-color: #cffaff; color: #0891b2; padding: 12px; border-radius: 12px; font-size: 1.5rem;">📊</div>
                    </div>
                </div>

                <!-- Card 5: Nilai Aset Modal -->
                <div style="background-color: white; border-radius: 16px; padding: 20px; border-left: 6px solid #4f46e5; box-shadow: 0 4px 12px rgba(0,0,0,0.03); border-top: 1px solid #e0e7ff; border-right: 1px solid #e0e7ff; border-bottom: 1px solid #e0e7ff;">
                    <div style="display: flex; justify-content: space-between; align-items: center;">
                        <div>
                            <p style="font-size: 0.75rem; font-weight: 700; text-transform: uppercase; color: #4f46e5; letter-spacing: 0.5px;">Nilai Aset Modal</p>
                            @php
                                $totalAsset = \App\Models\Product::all()->sum(function($p) {
                                    return $p->stock * ($p->cost_price ?? 0);
                                });
                            @endphp
                            <h4 style="font-size: 1.15rem; font-weight: 800; color: #0f172a; margin-top: 4px;">Rp {{ number_format($totalAsset, 0, ',', '.') }}</h4>
                            <span style="font-size: 0.75rem; color: #64748b;">Modal barang</span>
                        </div>
                        <div style="background-color: #e0e7ff; color: #4f46e5; padding: 12px; border-radius: 12px; font-size: 1.5rem;">💰</div>
                    </div>
                </div>

            </div>

            <!-- Tabel Produk Terbaru & Stok Menipis -->
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 24px;">
                
                <!-- Tabel Produk -->
                <div style="background-color: white; border-radius: 20px; border: 1px solid #e0f2fe; overflow: hidden; box-shadow: 0 4px 12px rgba(0,0,0,0.02);">
                    <div style="padding: 16px 20px; background-color: #f0f9ff; border-bottom: 1px solid #e0f2fe; display: flex; justify-content: space-between; align-items: center;">
                        <h4 style="font-weight: 700; color: #0369a1; font-size: 0.95rem;">✨ Produk Terbaru</h4>
                        <a href="{{ route('products.index') }}" style="color: #0284c7; font-size: 0.8rem; font-weight: 700; text-decoration: none;">Lihat Semua &rarr;</a>
                    </div>
                    <div style="padding: 16px; overflow-x: auto;">
                        <table style="width: 100%; border-collapse: collapse; text-align: left; font-size: 0.875rem;">
                            <thead>
                                <tr style="border-bottom: 2px solid #f1f5f9; color: #0284c7; font-weight: 700; font-size: 0.75rem; text-transform: uppercase;">
                                    <th style="padding: 10px;">Nama Produk</th>
                                    <th style="padding: 10px;">Kategori</th>
                                    <th style="padding: 10px;">Harga Jual</th>
                                    <th style="padding: 10px; text-align: center;">Stok</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse(\App\Models\Product::with('category')->latest()->take(5)->get() as $product)
                                <tr style="border-bottom: 1px solid #f8fafc;">
                                    <td style="padding: 12px 10px; font-weight: 600; color: #1e293b;">{{ $product->name }}</td>
                                    <td style="padding: 12px 10px;">
                                        <span style="background-color: #e0f2fe; color: #0369a1; padding: 4px 10px; border-radius: 8px; font-size: 0.75rem; font-weight: 600;">
                                            {{ $product->category->name ?? '-' }}
                                        </span>
                                    </td>
                                    <td style="padding: 12px 10px; color: #334155; font-weight: 600;">Rp {{ number_format($product->sell_price ?? 0, 0, ',', '.') }}</td>
                                    <td style="padding: 12px 10px; text-align: center; font-weight: 700; color: #0284c7;">{{ $product->stock }}</td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4" style="text-align: center; padding: 20px; color: #94a3b8;">Belum ada produk.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Box Stok Menipis -->
                <div style="background-color: white; border-radius: 20px; border: 1px solid #fef3c7; overflow: hidden; box-shadow: 0 4px 12px rgba(0,0,0,0.02);">
                    <div style="padding: 16px 20px; background-color: #fffbeb; border-bottom: 1px solid #fef3c7;">
                        <h4 style="font-weight: 700; color: #b45309; font-size: 0.95rem;">⚠️ Stok Menipis (&lt; 5)</h4>
                    </div>
                    <div style="padding: 16px;">
                        @forelse(\App\Models\Product::where('stock', '<', 5)->take(4)->get() as $lowStock)
                        <div style="display: flex; justify-content: space-between; align-items: center; padding: 10px 0; border-bottom: 1px solid #f1f5f9;">
                            <div>
                                <h5 style="font-size: 0.85rem; font-weight: 700; color: #1e293b; margin: 0;">{{ $lowStock->name }}</h5>
                                <span style="font-size: 0.75rem; color: #d97706;">Sisa: {{ $lowStock->stock }} unit</span>
                            </div>
                            <a href="{{ route('products.index') }}" style="background-color: #fffbeb; color: #b45309; border: 1px solid #fef3c7; padding: 4px 10px; border-radius: 8px; font-size: 0.75rem; font-weight: 700; text-decoration: none;">Cek</a>
                        </div>
                        @empty
                        <div style="text-align: center; padding: 20px; color: #94a3b8; font-size: 0.85rem;">
                            🎉 Semua stok produk aman!
                        </div>
                        @endforelse
                    </div>
                </div>

            </div>

        </div>
    </div>
</x-app-layout>