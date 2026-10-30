<x-app-layout>
    <x-slot name="header">
        <h2 style="font-weight: 800; font-size: 1.5rem; color: #0c4a6e;">
            {{ __('Transaksi Penjualan Baru') }}
        </h2>
    </x-slot>

    <div style="padding: 30px; background-color: #f8fafc; min-height: 100vh;">
        <div style="max-width: 900px; margin: 0 auto; background: white; padding: 30px; border-radius: 20px; box-shadow: 0 4px 15px rgba(0,0,0,0.05); border: 1px solid #e2e8f0;">

            @if ($errors->any())
                <div style="background-color: #fee2e2; border: 1px solid #fca5a5; color: #991b1b; padding: 12px 15px; border-radius: 10px; margin-bottom: 20px; font-size: 14px;">
                    <strong>Terjadi Kesalahan:</strong>
                    <ul style="margin: 5px 0 0 15px; padding: 0;">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('sales.store') }}" method="POST">
                @csrf

                <div style="margin-bottom: 20px;">
                    <h3 style="font-size: 1.1rem; font-weight: bold; color: #0369a1; margin-bottom: 4px;">Daftar Item Barang</h3>
                    <p style="font-size: 0.85rem; color: #64748b;">Pilih produk dari gudang dan tentukan jumlah barang yang ingin dibeli.</p>
                </div>

                <!-- Container Baris Produk -->
                <div id="item-container" style="display: flex; flex-direction: column; gap: 12px; margin-bottom: 20px;">
                    <!-- Diisi otomatis oleh JavaScript -->
                </div>

                <!-- Tombol Tambah Baris -->
                <div style="margin-bottom: 25px;">
                    <button type="button" id="add-item" style="background-color: #f1f5f9; color: #0284c7; border: 1px dashed #0284c7; padding: 10px 16px; border-radius: 10px; font-weight: bold; cursor: pointer; font-size: 0.875rem;">
                        + Tambah Barang Lagi
                    </button>
                </div>

                <!-- Tombol Aksi -->
                <div style="display: flex; gap: 10px; border-top: 1px solid #e2e8f0; padding-top: 20px;">
                    <button type="submit" style="background-color: #0284c7; color: white; padding: 12px 24px; border-radius: 10px; font-weight: bold; border: none; cursor: pointer; font-size: 14px;">
                        Proses & Simpan Transaksi
                    </button>
                    <a href="{{ route('dashboard') }}" style="background-color: #f1f5f9; color: #64748b; padding: 12px 24px; border-radius: 10px; font-weight: bold; text-decoration: none; font-size: 14px; display: inline-block;">
                        Batal
                    </a>
                </div>
            </form>

        </div>
    </div>

    <!-- Script JavaScript Murni -->
    <script>
        let rowIndex = 0;
        const productsData = @json($products ?? []);

        function generateOptions() {
            let optionsHtml = '<option value="">-- Pilih Barang di Gudang --</option>';
            if (Array.isArray(productsData)) {
                productsData.forEach(function(product) {
                    let price = product.sell_price || product.price || 0;
                    let priceFormatted = new Intl.NumberFormat('id-ID').format(price);
                    optionsHtml += `<option value="${product.id}">${product.name} (Stok: ${product.stock} | Rp ${priceFormatted})</option>`;
                });
            }
            return optionsHtml;
        }

        function addRow() {
            let container = document.getElementById('item-container');
            let newRow = document.createElement('div');
            newRow.className = 'item-row';
            newRow.style.cssText = 'display: flex; gap: 15px; align-items: flex-end; background: #f8fafc; padding: 15px; border-radius: 12px; border: 1px solid #e2e8f0;';
            
            newRow.innerHTML = `
                <div style="flex-grow: 2;">
                    <label style="display: block; font-size: 0.8rem; font-weight: 700; color: #475569; margin-bottom: 6px;">Pilih Produk</label>
                    <select name="items[${rowIndex}][product_id]" required style="width: 100%; padding: 10px; border: 1px solid #cbd5e1; border-radius: 8px; background: white; font-size: 0.9rem;">
                        ${generateOptions()}
                    </select>
                </div>
                <div style="flex-grow: 1;">
                    <label style="display: block; font-size: 0.8rem; font-weight: 700; color: #475569; margin-bottom: 6px;">Jumlah (Qty)</label>
                    <input type="number" name="items[${rowIndex}][quantity]" value="1" min="1" required style="width: 100%; padding: 10px; border: 1px solid #cbd5e1; border-radius: 8px; background: white; text-align: center; font-size: 0.9rem;">
                </div>
                <div>
                    <button type="button" style="background-color: #fee2e2; color: #dc2626; border: none; padding: 10px 14px; border-radius: 8px; font-weight: bold; cursor: pointer;" onclick="removeRow(this)">Hapus</button>
                </div>
            `;
            container.appendChild(newRow);
            rowIndex++;
        }

        document.addEventListener('DOMContentLoaded', function() {
            addRow();
        });

        document.getElementById('add-item').addEventListener('click', function() {
            addRow();
        });

        function removeRow(button) {
            let rows = document.querySelectorAll('.item-row');
            if (rows.length > 1) {
                button.closest('.item-row').remove();
            } else {
                alert('Minimal harus ada 1 barang dalam transaksi.');
            }
        }
    </script>
</x-app-layout>