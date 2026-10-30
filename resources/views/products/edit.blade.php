<x-app-layout>
    <div style="background-color: #e0f2fe; min-height: 100vh; padding: 30px 15px;">
        <div style="max-width: 650px; margin: 0 auto; background: #ffffff; border-radius: 20px; box-shadow: 0 4px 20px rgba(14, 165, 233, 0.15); padding: 30px; border: 1px solid #bae6fd;">
            
            <!-- Judul Form -->
            <div style="border-bottom: 2px solid #f0f9ff; padding-bottom: 15px; margin-bottom: 20px;">
                <h2 style="font-size: 20px; font-weight: bold; color: #0369a1; margin: 0;">Edit Produk</h2>
                <p style="font-size: 13px; color: #64748b; margin: 3px 0 0 0;">Perbarui data SKU, harga, kategori, supplier, dan stok barang inventaris Anda.</p>
            </div>

            <!-- Notifikasi Error Validasi -->
            @if ($errors->any())
                <div style="background-color: #fee2e2; border: 1px solid #fca5a5; color: #991b1b; padding: 12px 15px; border-radius: 10px; font-size: 13px; margin-bottom: 20px;">
                    <strong>Terjadi Kesalahan:</strong>
                    <ul style="margin: 5px 0 0 15px; padding: 0;">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Form Input Edit -->
            <form action="{{ route('products.update', $product->id) }}" method="POST">
                @csrf
                @method('PUT')

                <!-- Nama Produk -->
                <div style="margin-bottom: 15px;">
                    <label style="display: block; font-size: 13px; font-weight: bold; color: #334155; margin-bottom: 5px;">Nama Produk</label>
                    <input type="text" name="name" value="{{ old('name', $product->name) }}" required style="width: 100%; padding: 10px 12px; border: 1px solid #bae6fd; border-radius: 10px; font-size: 14px; background-color: #f0f9ff; color: #334155; outline: none;">
                </div>

                <!-- Kategori (Menyesuaikan input teks seperti saat tambah produk) -->
                <div style="margin-bottom: 15px;">
                    <label style="display: block; font-size: 13px; font-weight: bold; color: #334155; margin-bottom: 5px;">Kategori</label>
                    <input type="text" name="category" value="{{ old('category', optional($product->category)->name) }}" required style="width: 100%; padding: 10px 12px; border: 1px solid #bae6fd; border-radius: 10px; font-size: 14px; background-color: #f0f9ff; color: #334155; outline: none;">
                </div>

                <!-- Supplier (Dropdown Safira) -->
                <div style="margin-bottom: 15px;">
                    <label style="display: block; font-size: 13px; font-weight: bold; color: #334155; margin-bottom: 5px;">Supplier</label>
                    <select name="supplier_id" required style="width: 100%; padding: 10px 12px; border: 1px solid #bae6fd; border-radius: 10px; font-size: 14px; background-color: #f0f9ff; color: #334155; outline: none;">
                        <option value="">-- Pilih Supplier --</option>
                        @foreach($suppliers ?? [] as $supplier)
                            <option value="{{ $supplier->id }}" {{ (old('supplier_id', $product->supplier_id) == $supplier->id) ? 'selected' : '' }}>
                                {{ $supplier->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- SKU / Kode Produk (Readonly agar format PROD tetap terjaga konsisten) -->
                <div style="margin-bottom: 15px;">
                    <label style="display: block; font-size: 13px; font-weight: bold; color: #334155; margin-bottom: 5px;">SKU / Kode Produk (Otomatis)</label>
                    <input type="text" name="code" value="{{ old('code', $product->code) }}" readonly style="width: 100%; padding: 10px 12px; border: 1px solid #cbd5e1; border-radius: 10px; font-size: 14px; background-color: #e2e8f0; color: #64748b; outline: none; cursor: not-allowed;">
                </div>

                <!-- Harga Beli (cost_price) & Harga Jual (sell_price) -->
                <div style="display: flex; gap: 15px; margin-bottom: 15px;">
                    <div style="flex: 1;">
                        <label style="display: block; font-size: 13px; font-weight: bold; color: #334155; margin-bottom: 5px;">Harga Beli (Rp)</label>
                        <input type="number" name="cost_price" value="{{ old('cost_price', $product->cost_price) }}" required style="width: 100%; padding: 10px 12px; border: 1px solid #bae6fd; border-radius: 10px; font-size: 14px; background-color: #f0f9ff; color: #334155; outline: none;">
                    </div>
                    <div style="flex: 1;">
                        <label style="display: block; font-size: 13px; font-weight: bold; color: #334155; margin-bottom: 5px;">Harga Jual (Rp)</label>
                        <input type="number" name="sell_price" value="{{ old('sell_price', $product->sell_price) }}" required style="width: 100%; padding: 10px 12px; border: 1px solid #bae6fd; border-radius: 10px; font-size: 14px; background-color: #f0f9ff; color: #334155; outline: none;">
                    </div>
                </div>

                <!-- Stok -->
                <div style="margin-bottom: 25px;">
                    <label style="display: block; font-size: 13px; font-weight: bold; color: #334155; margin-bottom: 5px;">Stok</label>
                    <input type="number" name="stock" value="{{ old('stock', $product->stock) }}" required style="width: 100%; padding: 10px 12px; border: 1px solid #bae6fd; border-radius: 10px; font-size: 14px; background-color: #f0f9ff; color: #334155; outline: none;">
                </div>

                <!-- Tombol Aksi -->
                <div style="display: flex; gap: 10px; align-items: center;">
                    <button type="submit" style="background-color: #0284c7; color: white; padding: 10px 20px; border-radius: 10px; font-size: 13px; font-weight: bold; border: none; cursor: pointer; box-shadow: 0 2px 5px rgba(2, 132, 199, 0.3);">
                        Update Produk
                    </button>
                    <a href="{{ route('products.index') }}" style="background-color: #f1f5f9; color: #64748b; padding: 10px 20px; border-radius: 10px; font-size: 13px; font-weight: bold; text-decoration: none;">
                        Batal
                    </a>
                </div>
            </form>

        </div>
    </div>
</x-app-layout>