<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Tambah Supplier</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <form action="{{ route('suppliers.store') }}" method="POST">
                    @csrf
                    
                    <!-- Nama Supplier dengan placeholder Safira -->
                    <div class="mb-4">
                        <label class="block text-gray-700">Nama Supplier</label>
                        <input type="text" name="name" class="border border-gray-300 rounded w-full p-2" placeholder="Contoh: Safira" required>
                    </div>

                    <!-- Telepon -->
                    <div class="mb-4">
                        <label class="block text-gray-700">Telepon</label>
                        <input type="text" name="phone" class="border border-gray-300 rounded w-full p-2" placeholder="Contoh: 081234567890">
                    </div>

                    <!-- Alamat -->
                    <div class="mb-4">
                        <label class="block text-gray-700">Alamat</label>
                        <textarea name="address" class="border border-gray-300 rounded w-full p-2" placeholder="Contoh: Jl. Merdeka No. 10"></textarea>
                    </div>

                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Simpan</button>
                    <a href="{{ route('suppliers.index') }}" class="ml-2 text-gray-600">Batal</a>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>