<div style="width: 220px; background-color: #ffffff; border-right: 1px solid #e2e8f0; display: flex; flex-direction: column; position: fixed; top: 0; bottom: 0; left: 0; z-index: 50;">
    
    <!-- Logo / Judul Aplikasi -->
    <div style="padding: 24px 20px; border-bottom: 1px solid #f1f5f9; display: flex; align-items: center; gap: 10px;">
        <div style="background-color: #0284c7; color: white; padding: 8px; border-radius: 10px; font-weight: bold;">📦</div>
        <div>
            <h1 style="font-size: 1rem; font-weight: 800; color: #0f172a; margin: 0;">POS Inventory</h1>
            <span style="font-size: 0.75rem; color: #64748b;">Sistem Gudang Toko</span>
        </div>
    </div>

    <!-- Menu Navigasi Utama -->
    <div style="padding: 20px 15px; display: flex; flex-direction: column; gap: 6px; flex-grow: 1; overflow-y: auto;">
        
        <div style="font-size: 0.7rem; font-weight: 700; color: #94a3b8; text-transform: uppercase; margin-bottom: 5px; padding-left: 10px;">Menu Utama</div>

        <!-- Dashboard -->
        <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" style="display: flex; align-items: center; gap: 12px; padding: 10px 14px; border-radius: 10px; font-weight: 600; font-size: 0.875rem; text-decoration: none; {{ request()->routeIs('dashboard') ? 'background-color: #e0f2fe; color: #0284c7;' : 'color: #64748b;' }}">
            📊 Dashboard
        </x-nav-link>

         <!-- Produk -->
        <x-nav-link :href="route('products.index')" :active="request()->routeIs('products.*')" style="display: flex; align-items: center; gap: 12px; padding: 10px 14px; border-radius: 10px; font-weight: 600; font-size: 0.875rem; text-decoration: none; {{ request()->routeIs('products.*') ? 'background-color: #e0f2fe; color: #0284c7;' : 'color: #64748b;' }}">
            📦 Produk
        </x-nav-link>

        <!-- Kategori -->
        <x-nav-link :href="route('categories.index')" :active="request()->routeIs('categories.*')" style="display: flex; align-items: center; gap: 12px; padding: 10px 14px; border-radius: 10px; font-weight: 600; font-size: 0.875rem; text-decoration: none; {{ request()->routeIs('categories.*') ? 'background-color: #e0f2fe; color: #0284c7;' : 'color: #64748b;' }}">
            🏷️ Kategori
        </x-nav-link>

        <!-- Supplier -->
        <x-nav-link :href="route('suppliers.index')" :active="request()->routeIs('suppliers.*')" style="display: flex; align-items: center; gap: 12px; padding: 10px 14px; border-radius: 10px; font-weight: 600; font-size: 0.875rem; text-decoration: none; {{ request()->routeIs('suppliers.*') ? 'background-color: #e0f2fe; color: #0284c7;' : 'color: #64748b;' }}">
            🚚 Supplier
        </x-nav-link>
        
        <div style="font-size: 0.7rem; font-weight: 700; color: #94a3b8; text-transform: uppercase; margin: 15px 0 5px 0; padding-left: 10px;">Transaksi Penjualan</div>

        <!-- Transaksi Baru -->
        <x-nav-link :href="route('sales.create')" :active="request()->routeIs('sales.create')" style="display: flex; align-items: center; gap: 12px; padding: 10px 14px; border-radius: 10px; font-weight: 600; font-size: 0.875rem; text-decoration: none; {{ request()->routeIs('sales.create') ? 'background-color: #e0f2fe; color: #0284c7;' : 'color: #64748b;' }}">
            🛒 Transaksi Baru
        </x-nav-link>

        <!-- Riwayat Penjualan (Ditambahkan di sini) -->
        <x-nav-link :href="route('sales.index')" :active="request()->routeIs('sales.index')" style="display: flex; align-items: center; gap: 12px; padding: 10px 14px; border-radius: 10px; font-weight: 600; font-size: 0.875rem; text-decoration: none; {{ request()->routeIs('sales.index') ? 'background-color: #e0f2fe; color: #0284c7;' : 'color: #64748b;' }}">
            📋 Riwayat Penjualan
        </x-nav-link>

    </div>

    <!-- Profil User & Logout -->
    <div style="padding: 15px; border-top: 1px solid #f1f5f9; background-color: #f8fafc;">
        <div style="display: flex; align-items: center; justify-content: space-between;">
            <div>
                <div style="font-size: 0.85rem; font-weight: 700; color: #0f172a;">{{ Auth::user()->name }}</div>
                <div style="font-size: 0.75rem; color: #64748b;">{{ Auth::user()->email }}</div>
            </div>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" style="background: none; border: none; cursor: pointer; color: #ef4444; font-size: 1.1rem;" title="Keluar">
                    🚪
                </button>
            </form>
        </div>
    </div>

</div>