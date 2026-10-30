<x-app-layout>
    <div style="background-color: #e0f2fe; min-height: 100vh; padding: 30px 15px;">
        <div style="max-width: 950px; margin: 0 auto; background: #ffffff; border-radius: 20px; box-shadow: 0 4px 20px rgba(14, 165, 233, 0.15); padding: 25px; border: 1px solid #bae6fd;">
            
            <!-- Header Judul & Tombol Tambah Sejajar -->
            <div style="display: flex; justify-content: space-between; align-items: center; border-bottom: 2px solid #f0f9ff; padding-bottom: 15px; margin-bottom: 20px;">
                <div>
                    <h2 style="font-size: 20px; font-weight: bold; color: #0369a1; margin: 0;">Manajemen Supplier</h2>
                    <p style="font-size: 13px; color: #64748b; margin: 3px 0 0 0;">Kelola data mitra dan pemasok barang toko Anda.</p>
                </div>
                
                <!-- Tombol Tambah Supplier -->
                <a href="{{ url('/suppliers/create') }}" style="background-color: #0284c7; color: white; padding: 10px 18px; border-radius: 12px; font-size: 13px; font-weight: bold; text-decoration: none; box-shadow: 0 2px 5px rgba(2, 132, 199, 0.3); white-space: nowrap;">
                    + Tambah Supplier
                </a>
            </div>

            <!-- Tabel Data Supplier -->
            <div style="overflow-x-auto;">
                <table style="width: 100%; border-collapse: collapse; text-align: left;">
                    <thead>
                        <tr style="background-color: #f0f9ff; color: #0369a1; font-size: 12px; text-transform: uppercase;">
                            <th style="padding: 12px 15px; border-top-left-radius: 10px; border-bottom-left-radius: 10px; width: 50px; text-align: center;">No</th>
                            <th style="padding: 12px 15px;">Nama Supplier</th>
                            <th style="padding: 12px 15px;">No. Telepon / Kontak</th>
                            <th style="padding: 12px 15px;">Alamat</th>
                            <th style="padding: 12px 15px; border-top-right-radius: 10px; border-bottom-right-radius: 10px; text-align: center; width: 150px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody style="font-size: 14px; color: #334155;">
                        @forelse($suppliers ?? [] as $index => $supplier)
                        <tr style="border-bottom: 1px solid #f1f5f9;">
                            <td style="padding: 12px 15px; text-align: center; font-weight: bold; color: #94a3b8;">{{ $index + 1 }}</td>
                            <td style="padding: 12px 15px; font-weight: 600; color: #1e293b;">{{ $supplier->name }}</td>
                            <td style="padding: 12px 15px; color: #475569;">{{ $supplier->phone ?? '-' }}</td>
                            <td style="padding: 12px 15px; color: #475569;">{{ $supplier->address ?? '-' }}</td>
                            <td style="padding: 12px 15px; text-align: center;">
                                <div style="display: flex; gap: 8px; justify-content: center;">
                                    <a href="{{ url('/suppliers/'.$supplier->id.'/edit') }}" style="background-color: #e0f2fe; color: #0369a1; padding: 6px 12px; border-radius: 8px; font-size: 12px; font-weight: bold; text-decoration: none;">Edit</a>
                                    
                                    <form action="{{ url('/suppliers/'.$supplier->id) }}" method="POST" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" onclick="return confirm('Yakin ingin menghapus supplier ini?')" style="background-color: #fee2e2; color: #dc2626; padding: 6px 12px; border-radius: 8px; font-size: 12px; font-weight: bold; border: none; cursor: pointer;">Hapus</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" style="padding: 30px; text-align: center; color: #94a3b8; font-style: italic;">
                                Belum ada data supplier yang ditambahkan.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</x-app-layout>                                                                           