<section for="sub-admin">
    <li class="sidebar-item has-sub">
        <a href="#" class="sidebar-link">
            <i class="bi bi-grid-fill"></i>
            <span>Dashboard</span>
        </a>
        <ul class="submenu">
            <li class="submenu-item">
                <a href="{{ route('dashboard') }}">Statistics</a>
            </li>
        </ul>
    </li>

    <li class="sidebar-item has-sub">
        <a href="#" class="sidebar-link">
            <i class="fa-solid fa-box-open"></i>
            <span>Produk</span>
        </a>
        <ul class="submenu">
            <li class="submenu-item">
                <a href="{{ route('category.index') }}">Kategori Produk</a>
            </li>
            <li class="submenu-item">
                <a href="{{ route('product.index') }}">Data Produk</a>
            </li>
        </ul>
    </li>

    <li class="sidebar-item has-sub">
        <a href="#" class="sidebar-link">
            <i class="fas fa-shipping-fast"></i>
            <span>Supplier</span>
        </a>
        <ul class="submenu">
            <li class="submenu-item">
                <a href="{{ route('supplier.index') }}">Data Supplier</a>
            </li>
        </ul>
    </li>

    <li class="sidebar-item has-sub">
        <a href="#" class="sidebar-link">
            <i class="fa-solid fa-users"></i>
            <span>Member</span>
        </a>
        <ul class="submenu">
            <li class="submenu-item">
                <a href="{{ route('member.index') }}">Data Member</a>
            </li>
        </ul>
    </li>

    <li class="sidebar-item has-sub">
        <a href="#" class="sidebar-link">
            <i class="fa-solid fa-cart-shopping"></i>
            <span>Transaksi</span>
        </a>
        <ul class="submenu">
            <li class="submenu-item">
                <a href="{{ route('spending.index') }}">Pengeluaran</a>
            </li>
            <li class="submenu-item">
                <a href="{{ route('purchase.index') }}">Pembelian</a>
            </li>
            <li class="submenu-item">
                <a href="{{ route('transaction.index') }}">Transaksi Penjualan</a>
            </li>
            <li class="submenu-item">
                <a href="{{ route('data-purchase') }}">Data Pembelian</a>
            </li>
            <li class="submenu-item">
                <a href="{{ route('data-transaction') }}">Data Penjualan</a>
            </li>
        </ul>
    </li>

    <li class="sidebar-item has-sub">
        <a href="#" class="sidebar-link">
            <i class="fa-solid fa-chart-pie"></i>
            <span>Laporan</span>
        </a>
        <ul class="submenu">
            <li class="submenu-item">
                <a href="{{ route('product.print') }}" target="_blank">Laporan Data Produk</a>
            </li>
            <li class="submenu-item">
                <a href="{{ route('spending.reports') }}">Laporan Data Pengeluaran</a>
            </li>
            <li class="submenu-item">
                <a href="{{ route('purchase.reports') }}">Laporan Data Pembelian</a>
            </li>
            <li class="submenu-item">
                <a href="{{ route('transaction.reports') }}">Laporan Data Penjualan</a>
            </li>
            <li class="submenu-item">
                <a href="{{ route('finance.reports') }}">Laporan Data Keuangan</a>
            </li>
        </ul>
    </li>

    <li class="sidebar-item has-sub">
        <a href="#" class="sidebar-link">
            <i class="fas fa-user-gear"></i>
            <span>Pengaturan</span>
        </a>
        <ul class="submenu">
            <li class="submenu-item">
                <a href="{{ route('user.index') }}">Profile Saya</a>
            </li>
            <li class="submenu-item">
                <a href="{{ route('logout') }}" class="btn-logout">Logout</a>
            </li>
        </ul>
    </li>
</section>