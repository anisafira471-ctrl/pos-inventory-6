<x-app-layout>
    <x-slot name="header">
        <div style="display: flex; justify-content: space-between; align-items: center;">
            <h2 style="font-weight: 800; font-size: 1.5rem; color: #0c4a6e;">
                {{ __('Detail Transaksi: ') }} <span style="color: #0284c7;">{{ $sale->sale_number ?? $sale->invoice_number ?? 'TRX-SALE-' . $sale->id }}</span>
            </h2>
            <a href="{{ route('sales.index') }}" style="background-color: #64748b; color: white; padding: 10px 18px; border-radius: 10px; font-weight: bold; text-decoration: none; font-size: 14px;">
                ← Kembali ke Riwayat
            </a>
        </div>
    </x-slot>

    <div style="padding: 30px; background-color: #f8fafc; min-height: 100vh;">
        <div style="max-width: 900px; margin: 0 auto; background: white; padding: 30px; border-radius: 16px; box-shadow: 0 4px 15px rgba(0,0,0,0.05); border: 1px solid #e2e8f0;">

            <!-- Header Nota -->
            <div style="display: flex; justify-content: space-between; border-bottom: 2px dashed #e2e8f0; padding-bottom: 20px; margin-bottom: 20px;">
                <div>
                    <h3 style="font-size: 1.2rem; font-weight: 800; color: #0f172a; margin-bottom: 5px;">NOTA PENJUALAN</h3>
                    <p style="font-size: 0.85rem; color: #64748b; margin: 0;">Tanggal: {{ \Carbon\Carbon::parse($sale->created_at ?? $sale->sold_at)->format('d M Y H:i') }}</p>
                    <p style="font-size: 0.85rem; color: #64748b; margin: 0;">Kasir: {{ $sale->user->name ?? 'Owner Admin' }}</p>
                </div>
                <div style="text-align: right;">
                    <span style="background-color: #dcfce7; color: #15803d; padding: 6px 14px; border-radius: 20px; font-size: 0.85rem; font-weight: 800; text-transform: uppercase;">
                        {{ $sale->status ?? 'completed' }}
                    </span>
                </div>
            </div>

            <!-- Tabel Barang yang Dibeli -->
            <table style="width: 100%; border-collapse: collapse; font-size: 0.9rem; margin-bottom: 25px;">
                <thead>
                    <tr style="background-color: #f8fafc; color: #475569; text-transform: uppercase; font-size: 0.75rem;">
                        <th style="padding: 10px; text-align: left;">Produk</th>
                        <th style="padding: 10px; text-align: center;">Harga Satuan</th>
                        <th style="padding: 10px; text-align: center;">Jumlah (Qty)</th>
                        <th style="padding: 10px; text-align: right;">Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    @php $items = $sale->items ?? $sale->details ?? []; @endphp
                    @forelse($items as $item)
                        <tr style="border-bottom: 1px solid #f1f5f9;">
                            <td style="padding: 12px 10px; font-weight: 600; color: #1e293b;">
                                {{ $item->product->name ?? $item->product_name ?? 'Produk' }}
                            </td>
                            <td style="padding: 12px 10px; text-align: center; color: #64748b;">
                                Rp {{ number_format($item->price ?? $item->unit_price ?? 0, 0, ',', '.') }}
                            </td>
                            <td style="padding: 12px 10px; text-align: center; font-weight: 700; color: #0284c7;">
                                {{ $item->quantity ?? $item->qty ?? 1 }}
                            </td>
                            <td style="padding: 12px 10px; text-align: right; font-weight: 700; color: #0f172a;">
                                Rp {{ number_format(($item->price ?? $item->unit_price ?? 0) * ($item->quantity ?? $item->qty ?? 1), 0, ',', '.') }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" style="padding: 20px; text-align: center; color: #94a3b8;">
                                Rincian barang tidak ditemukan.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <!-- Total Akhir -->
            <div style="background-color: #f0f9ff; padding: 20px; border-radius: 12px; display: flex; justify-content: space-between; align-items: center; border: 1px solid #bae6fd;">
                <span style="font-size: 1.1rem; font-weight: 700; color: #0369a1;">Total Belanja:</span>
                <span style="font-size: 1.5rem; font-weight: 800; color: #0284c7;">
                    Rp {{ number_format($sale->total_price ?? $sale->total ?? 0, 0, ',', '.') }}
                </span>
            </div>

            <!-- Tombol Cetak / Print -->
            <div style="margin-top: 25px; text-align: right;">
                <button onclick="window.print()" style="background-color: #0f172a; color: white; padding: 10px 20px; border: none; border-radius: 8px; font-weight: 700; cursor: pointer; font-size: 0.9rem;">
                    🖨️ Cetak / Print Struk
                </button>
            </div>

        </div>
    </div>
</x-app-layout>