<x-app-layout>
    <x-slot name="header">
        <div style="display: flex; justify-content: space-between; align-items: center;">
            <h2 style="font-weight: 800; font-size: 1.5rem; color: #0c4a6e;">
                {{ __('Riwayat Transaksi Penjualan (Stock-Out)') }}
            </h2>
            <a href="{{ route('sales.create') }}" style="background-color: #0284c7; color: white; padding: 10px 18px; border-radius: 10px; font-weight: bold; text-decoration: none; font-size: 14px;">
                + Mulai Transaksi Baru
            </a>
        </div>
    </x-slot>

    <div style="padding: 30px; background-color: #f8fafc; min-height: 100vh;">
        <div style="max-width: 1100px; margin: 0 auto; background: white; padding: 25px; border-radius: 16px; box-shadow: 0 4px 15px rgba(0,0,0,0.05); border: 1px solid #e2e8f0;">

            @if(session('success'))
                <div style="background-color: #dcfce7; border: 1px solid #86efac; color: #166534; padding: 12px 16px; border-radius: 10px; margin-bottom: 20px; font-size: 14px; font-weight: 600;">
                    ✓ {{ session('success') }}
                </div>
            @endif

            <table style="width: 100%; border-collapse: collapse; font-size: 0.9rem; text-align: left;">
                <thead>
                    <tr style="background-color: #f1f5f9; color: #475569; text-transform: uppercase; font-size: 0.75rem; letter-spacing: 0.05em;">
                        <th style="padding: 12px 16px; border-radius: 8px 0 0 8px;">No. Transaksi</th>
                        <th style="padding: 12px 16px;">Kasir / Staf</th>
                        <th style="padding: 12px 16px;">Tanggal Transaksi</th>
                        <th style="padding: 12px 16px;">Total Belanja</th>
                        <th style="padding: 12px 16px;">Status</th>
                        <th style="padding: 12px 16px; text-align: center; border-radius: 0 8px 8px 0;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($sales as $sale)
                        <tr style="border-bottom: 1px solid #f1f5f9;">
                            <td style="padding: 14px 16px; font-weight: 700; color: #0284c7;">
                                {{ $sale->sale_number ?? $sale->invoice_number ?? 'TRX-SALE-' . $sale->id }}
                            </td>
                            <td style="padding: 14px 16px; color: #334155;">
                                {{ $sale->user->name ?? 'Owner Admin' }}
                            </td>
                            <td style="padding: 14px 16px; color: #64748b;">
                                {{ \Carbon\Carbon::parse($sale->created_at ?? $sale->sold_at)->format('d M Y H:i') }}
                            </td>
                            <td style="padding: 14px 16px; font-weight: 700; color: #0f172a;">
                                Rp {{ number_format($sale->total_price ?? $sale->total ?? 0, 0, ',', '.') }}
                            </td>
                            <td style="padding: 14px 16px;">
                                <span style="background-color: #dcfce7; color: #15803d; padding: 4px 10px; border-radius: 20px; font-size: 0.75rem; font-weight: 700;">
                                    {{ $sale->status ?? 'completed' }}
                                </span>
                            </td>
                            <td style="padding: 14px 16px; text-align: center;">
                                <a href="{{ route('sales.show', $sale->id) }}" style="color: #0284c7; font-weight: 700; text-decoration: none; border: 1px solid #0284c7; padding: 5px 12px; border-radius: 6px; font-size: 0.8rem; transition: 0.2s;">
                                    Detail
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" style="padding: 30px; text-align: center; color: #94a3b8;">
                                Belum ada riwayat transaksi penjualan.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <div style="margin-top: 20px;">
                {{ $sales->links() }}
            </div>

        </div>
    </div>
</x-app-layout>