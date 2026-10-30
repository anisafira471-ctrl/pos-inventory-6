<x-app-layout>
    <div style="background-color: #e0f2fe; min-height: 100vh; padding: 30px 15px;">
        <div style="max-width: 650px; margin: 0 auto; background: #ffffff; border-radius: 20px; box-shadow: 0 4px 20px rgba(14, 165, 233, 0.15); padding: 30px; border: 1px solid #bae6fd;">
            
            <div style="border-bottom: 2px solid #f0f9ff; padding-bottom: 15px; margin-bottom: 20px;">
                <h2 style="font-size: 20px; font-weight: bold; color: #0369a1; margin: 0;">Tambah Produk Baru</h2>
                <p style="font-size: 13px; color: #64748b; margin: 3px 0 0 0;">Lengkapi data produk, kategori, dan supplier dalam satu halaman.</p>
            </div>

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

            <form action="{{ route('products.store') }}" method="POST">
                @csrf

                <!-- Nama Produk -->
                <div style="margin-bottom: 15px;">
                    <label style="display: block; font-size: 13px; font-weight: bold; color: #334155; margin-bottom: 5px;">Nama Produk</label>
                    <input type="text" name="name" value="{{ old('name') }}" required placeholder="Contoh: Sepatu Sneaker" style="width: 100%; padding: 10px 12px; border: 1px solid #bae6fd; border-radius: 10px; font-size: 14px; background-color: #f0f9ff; color: #334155; outline: none;">
                </div>

                <!-- Kategori -->
                <div style="margin-bottom: 15px;">
                    <label style="display: block; font-size: 13px; font-weight: bold; color: #334155; margin-bottom: 5px;">Kategori</label>
                    <input type="text" name="category" value="{{ old('category') }}" required placeholder="Contoh: Pakaian" style="width: 100%; padding: 10px 12px; border: 1px solid #bae6fd; border-radius: 10px; font-size: 14px; background-color: #f0f9ff; color: #334155; outline: none;">
                </div>

                <!-- Supplier (Dropdown Safira) -->
                <div style="margin-bottom: 15px;">
                    <label style="display: block; font-size: 13px; font-weight: bold; color: #334155; margin-bottom: 5px;">Supplier</label>
                    <select name="supplier_id" required style="width: 100%; padding: 10px 12px; border: 1px solid #bae6fd; border-radius: 10px; font-size: 14px; background-color: #f0f9ff; color: #334155; outline: none;">
                        <option value="">-- Pilih Supplier --</option>
                        @foreach($suppliers as $supplier)
                            <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Stok & Stok Minimum -->
                <div style="display: flex; gap: 15px; margin-bottom: 15px;">
                    <div style="flex: 1;">
                        <label style="display: block; font-size: 13px; font-weight: bold; color: #334155; margin-bottom: 5px;">Stok</label>
                        <input type="number" name="stock" value="{{ old('stock', 0) }}" required style="width: 100%; padding: 10px 12px; border: 1px solid #bae6fd; border-radius: 10px; font-size: 14px; background-color: #f0f9ff; color: #334155; outline: none;">
                    </div>
                    <div style="flex: 1;">
                        <label style="display: block; font-size: 13px; font-weight: bold; color: #334155; margin-bottom: 5px;">Stok Minimum</label>
                        <input type="number" name="minimum_stock" value="{{ old('minimum_stock', 5) }}" required style="width: 100%; padding: 10px 12px; border: 1px solid #bae6fd; border-radius: 10px; font-size: 14px; background-color: #f0f9ff; color: #334155; outline: none;">
                    </div>
                </div>

                <!-- Harga Beli & Harga Jual -->
                <div style="display: flex; gap: 15px; margin-bottom: 25px;">
                    <div style="flex: 1;">
                        <label style="display: block; font-size: 13px; font-weight: bold; color: #334155; margin-bottom: 5px;">Harga Beli (Rp)</label>
                        <input type="number" name="cost_price" value="{{ old('cost_price') }}" required placeholder="0" style="width: 100%; padding: 10px 12px; border: 1px solid #bae6fd; border-radius: 10px; font-size: 14px; background-color: #f0f9ff; color: #334155; outline: none;">
                    </div>
                    <div style="flex: 1;">
                        <label style="display: block; font-size: 13px; font-weight: bold; color: #334155; margin-bottom: 5px;">Harga Jual (Rp)</label>
                        <input type="number" name="sell_price" value="{{ old('sell_price') }}" required placeholder="0" style="width: 100%; padding: 10px 12px; border: 1px solid #bae6fd; border-radius: 10px; font-size: 14px; background-color: #f0f9ff; color: #334155; outline: none;">
                    </div>
                </div>

                <!-- Tombol Aksi -->
                <div style="display: flex; gap: 10px; align-items: center;">
                    <button type="submit" style="background-color: #0284c7; color: white; padding: 10px 20px; border-radius: 10px; font-size: 13px; font-weight: bold; border: none; cursor: pointer;">
                        Simpan
                    </button>
                    <a href="{{ route('products.index') }}" style="background-color: #f1f5f9; color: #64748b; padding: 10px 20px; border-radius: 10px; font-size: 13px; font-weight: bold; text-decoration: none;">
                        Kembali
                    </a>
                </div>
            </form>

        </div>
    </div>
</x-app-layout>