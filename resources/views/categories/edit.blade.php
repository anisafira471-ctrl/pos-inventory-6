<x-app-layout>
    <x-slot name="header">
        <h2 style="font-weight: 800; font-size: 1.5rem; color: #0c4a6e;">
            {{ __('Ubah Kategori Produk') }}
        </h2>
    </x-slot>

    <div style="background-color: #f0f9ff; min-height: 100vh; padding: 24px 0;">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div style="background-color: white; border-radius: 20px; border: 1px solid #e0f2fe; padding: 30px; box-shadow: 0 4px 12px rgba(0,0,0,0.03);">
                
                <form action="{{ route('categories.update', $category->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div style="margin-bottom: 25px;">
                        <label style="display: block; font-weight: 700; color: #0369a1; margin-bottom: 8px; font-size: 0.9rem;">Nama Kategori</label>
                        <input type="text" name="name" value="{{ old('name', $category->name) }}" required style="width: 100%; padding: 10px 14px; border: 1px solid #bae6fd; border-radius: 10px; font-size: 0.95rem; outline: none;">
                    </div>

                    <div style="display: flex; justify-content: flex-end; gap: 12px;">
                        <a href="{{ route('categories.index') }}" style="background-color: #f1f5f9; color: #475569; font-weight: 700; padding: 10px 20px; border-radius: 10px; text-decoration: none; font-size: 0.875rem;">Batal</a>
                        <button type="submit" style="background: linear-gradient(135deg, #0284c7 0%, #2563eb 100%); color: white; font-weight: 700; padding: 10px 24px; border-radius: 10px; border: none; font-size: 0.875rem; cursor: pointer; box-shadow: 0 4px 12px rgba(2, 132, 199, 0.3);">Simpan Perubahan</button>
                    </div>

                </form>

            </div>
        </div>
    </div>
</x-app-layout>