<x-app-layout>
    <div style="background-color: #e0f2fe; min-height: 100vh; padding: 30px 15px;">
        <div style="max-width: 850px; margin: 0 auto; background: #ffffff; border-radius: 20px; box-shadow: 0 4px 20px rgba(14, 165, 233, 0.15); padding: 30px; border: 1px solid #bae6fd;">
            
            <div style="border-bottom: 2px solid #f0f9ff; padding-bottom: 15px; margin-bottom: 20px;">
                <h2 style="font-size: 20px; font-weight: bold; color: #0369a1; margin: 0;">Form Pembelian Stok (Restock)</h2>
                <p style="font-size: 13px; color: #64748b; margin: 3px 0 0 0;">Catat pembelian barang dari supplier untuk menambah stok gudang.</p>
            </div>

            @if ($errors->any())
                <div style="background-color: #fee2e2; border: 1px solid #fca5a5; color: #991b1b; padding: 12px 15px; border-radius: 10px; font-size: 13px; margin-bottom: 20px;">
                    <strong>Terjadi Kesalahan:</strong>
                    <ul style="margin: 5px 0 0 15px; padding: 0;">
                        @foreach ($errors->all() as$error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('purchases.store') }}" method="POST">
                @csrf

                <div style="margin-bottom: 20px;">
                    <label style="display: block; font-size: 13px; font-weight: bold; color: #334155; margin-bottom: 5px;">Pilih Supplier</label>
                    <select name="supplier_id" required style="width: 100%; padding: 10px 12px; border: 1px solid #bae6fd; border-radius: 10px; font-size: 14px; background-color: #f0f9ff; color: #334155; outline: none;">
                        <option value="">-- Pilih Supplier --</option>
                        @foreach($suppliers as$s)
                            <option value="{{ $s->id }}">{{ $s->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div id="items-container">
                    <div class="item-row" style="display: flex; gap: 10px; align-items: center; margin-bottom: 15px;">
                        <div style="flex: 2;">
                            <label style="display: block; font-size: 12px; font-weight: bold; color: #334155; margin-bottom: 4px;">Produk</label>
                            <select name="items[0][product_id]" required style="width: 100%; padding: 10px; border: 1px solid #bae6fd; border-radius: 10px; font-size: 13px; background-color: #f0f9ff; color: #334155; outline: none;">
                                <option value="">-- Pilih Produk --</option>
                                @foreach($products as$p)
                                    <option value="{{ $p->id }}">{{ $p->name }} (SKU: {{$p->code }})</option>
                                @endforeach
                            </select>
                        </div>
                        <div style="flex: 1;">
                            <label style="display: block; font-size: 12px; font-weight: bold; color: #334155; margin-bottom: 4px;">Qty</label>
                            <input type="number" name="items[0][quantity]" value="1" min="1" required style="width: 100%; padding: 10px; border: 1px solid #bae6fd; border-radius: 10px; font-size: 13px; background-color: #f0f9ff; color: #334155; outline: none;">
                        </div>
                        <div style="flex: 1.5;">
                            <label style="display: block; font-size: 12px; font-weight: bold; color: #334155; margin-bottom: 4px;">Harga Beli Satuan</label>
                            <input type="number" name="items[0][cost_price]" value="0" min="0" required style="width: 100%; padding: 10px; border: 1px solid #bae6fd; border-radius: 10px; font-size: 13px; background-color: #f0f9ff; color: #334155; outline: none;">
                        </div>
                    </div>
                </div>

                <div style="margin-bottom: 25px;">
                    <button type="button" id="add-item-btn" style="background-color: #e0f2fe; color: #0369a1; padding: 8px 14px; border-radius: 8px; font-size: 12px; font-weight: bold; border: 1px solid #bae6fd; cursor: pointer;">
                        + Tambah Barang Lain
                    </button>
                </div>

                <div style="display: flex; gap: 10px; align-items: center; border-top: 2px solid #f0f9ff; padding-top: 20px;">
                    <button type="submit" style="background-color: #0284c7; color: white; padding: 10px 22px; border-radius: 10px; font-size: 13px; font-weight: bold; border: none; cursor: pointer; box-shadow: 0 2px 5px rgba(2, 132, 199, 0.3);">
                        Simpan Pembelian & Update Stok
                    </button>
                    <a href="{{ route('purchases.index') }}" style="background-color: #f1f5f9; color: #64748b; padding: 10px 20px; border-radius: 10px; font-size: 13px; font-weight: bold; text-decoration: none;">
                        Batal
                    </a>
                </div>
            </form>

        </div>
    </div>

    <script>
        let itemIndex = 1;
        document.getElementById('add-item-btn').addEventListener('click', function() {
            const container = document.getElementById('items-container');
            const row = document.createElement('div');
            row.className = 'item-row';
            row.style = 'display: flex; gap: 10px; align-items: center; margin-bottom: 15px;';
            row.innerHTML = `
                <div style="flex: 2;">
                    <select name="items[${itemIndex}][product_id]" required style="width: 100%; padding: 10px; border: 1px solid #bae6fd; border-radius: 10px; font-size: 13px; background-color: #f0f9ff; color: #334155; outline: none;">
                        <option value="">-- Pilih Produk --</option>
                        @foreach($products as $p)
                            <option value="{{ $p->id }}">{{ $p->name }} (SKU: {{ $p->code }})</option>
                        @endforeach
                    </select>
                </div>
                <div style="flex: 1;">
                    <input type="number" name="items[${itemIndex}][quantity]" value="1" min="1" required style="width: 100%; padding: 10px; border: 1px solid #bae6fd; border-radius: 10px; font-size: 13px; background-color: #f0f9ff; color: #334155; outline: none;">
                </div>
                <div style="flex: 1.5;">
                    <input type="number" name="items[${itemIndex}][cost_price]" value="0" min="0" required style="width: 100%; padding: 10px; border: 1px solid #bae6fd; border-radius: 10px; font-size: 13px; background-color: #f0f9ff; color: #334155; outline: none;">
                </div>
                <div>
                    <button type="button" onclick="this.parentElement.parentElement.remove()" style="background-color: #fee2e2; color: #dc2626; border: none; padding: 10px; border-radius: 8px; cursor: pointer; font-weight: bold;">✕</button>
                </div>
            `;
            container.appendChild(row);
            itemIndex++;
        });
    </script>
</x-app-layout>