<x-app-layout>
    <div style="background-color: #e0f2fe; min-height: 100vh; padding: 30px 15px;">
        <div style="max-width: 1100px; margin: 0 auto; background: #ffffff; border-radius: 20px; box-shadow: 0 4px 20px rgba(14, 165, 233, 0.15); padding: 25px; border: 1px solid #bae6fd;">
            
            <div style="display: flex; justify-content: space-between; align-items: center; border-bottom: 2px solid #f0f9ff; padding-bottom: 15px; margin-bottom: 20px;">
                <div>
                    <h2 style="font-size: 20px; font-weight: bold; color: #0369a1; margin: 0;">Riwayat Pembelian Stok (Supplier)</h2>
                    <p style="font-size: 13px; color: #64748b; margin: 3px 0 0 0;">Daftar pengadaan barang masuk yang menambah inventaris.</p>
                </div>
                
                <a href="{{ route('purchases.create') }}" style="background-color: #0284c7; color: white; padding: 10px 18px; border-radius: 12px; font-size: 13px; font-weight: bold; text-decoration: none; box-shadow: 0 2px 5px rgba(2, 132, 199, 0.3);">
                    + Pembelian Baru
                </a>
            </div>

            @if(session('success'))
                <div style="background-color: #d1fae5; border: 1px solid #a7f3d0; color: #065f46; padding: 12px 15px; border-radius: 10px; font-size: 13px; margin-bottom: 20px; font-weight: bold;">
                    ✓ {{ session('success') }}
                </div>
            @endif

            <div style="overflow-x: auto;">
                <table style="width: 100%; border-collapse: collapse; text-align: left;">
                    <thead>
                        <tr style="background-color: #f0f9ff; color: #0369a1; font-size: 12px; text-transform: uppercase;">
                            <th style="padding: 12px; border-top-left-radius: 10px; border-bottom-left-radius: 10px; width: 40px; text-align: center;">No</th>
                            <th style="padding: 12px;">No. PO</th>
                            <th style="padding: 12px;">Supplier</th>
                            <th style="padding: 12px;">Admin / Staff</th>
                            <th style="padding: 12px;">Tanggal</th>
                            <th style="padding: 12px; border-top-right-radius: 10px; border-bottom-right-radius: 10px; text-align: right;">Total Biaya</th>
                        </tr>
                    </thead>
                    <tbody style="font-size: 13px; color: #334155;">
                        @forelse($purchases as $index => $purchase)
                        <tr style="border-bottom: 1px solid #f1f5f9;">
                            <td style="padding: 12px; text-align: center; font-weight: bold; color: #94a3b8;">{{ $purchases->firstItem() + $index }}</td>
                            <td style="padding: 12px; font-weight: bold; color: #0284c7;">{{ $purchase->purchase_number }}</td>
                            <td style="padding: 12px; font-weight: 600; color: #1e293b;">{{ $purchase->supplier->name ?? '-' }}</td>
                            <td style="padding: 12px; color: #64748b;">{{ $purchase->user->name ?? '-' }}</td>
                            <td style="padding: 12px; color: #64748b;">{{ \Carbon\Carbon::parse($purchase->purchased_at)->format('d M Y H:i') }}</td>
                            <td style="padding: 12px; font-weight: bold; color: #059669; text-align: right;">Rp {{ number_format($purchase->total, 0, ',', '.') }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" style="padding: 30px; text-align: center; color: #94a3b8; font-style: italic;">
                                Belum ada transaksi pembelian stok.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div style="margin-top: 20px;">
                {{ $purchases->links() }}
            </div>

        </div>
    </div>
</x-app-layout>