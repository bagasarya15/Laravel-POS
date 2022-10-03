<div class="sidebar-wrapper active">
    <div class="sidebar-header position-relative">
        <div class="d-flex justify-content-between align-items-center" >
            <div class="logo">
                <a href="{{ 'dashboard' }}">
                    <h1 class="fs-5 mt-3 mx-1 fw-bolder"><i class="fa-solid fa-code"></i> Lara-Pos</h1>
                </a>
            </div>
            @include('layouts.toogle-theme')
            <div class="sidebar-toggler x">
                <a
                    href="#"
                    class="sidebar-hide d-xl-none d-block"
                    ><i class="bi bi-x bi-middle"></i
                ></a>
            </div>
        </div>
    </div>
    <div class="sidebar-menu">
        <ul class="menu">
            <li class="sidebar-title">Menu</li>
            @can('admin')
            <li class="sidebar-item active">
                <a href="{{ ('dashboard') }}" class="sidebar-link">
                    <i class="bi bi-grid-fill"></i>
                    <span>Dashboard</span>
                </a>
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
                    <span>Transaksi Penjualan</span>
                </a>
                <ul class="submenu">
                    <li class="submenu-item">
                        <a href="{{ route('transaction.index') }}">Kasir</a>
                    </li>
                    <li class="submenu-item">
                        <a href="{{ route('transaction.new') }}">Transaksi Baru</a>
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
                        <a href="#">Coming Soon</a>
                    </li>
                </ul>
            </li>

            <li class="sidebar-item has-sub">
                <a href="#" class="sidebar-link">
                    <i class="fas fa-shipping-fast"></i>
                    <span>Pesan Antar</span>
                </a>
                <ul class="submenu">
                    <li class="submenu-item">
                        <a href="#">Coming Soon</a>
                    </li>
                </ul>
            </li>
            @endcan

            @can('sub-admin')
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
                    <i class="fa-solid fa-cart-shopping"></i>
                    <span>Transaksi Penjualan</span>
                </a>
                <ul class="submenu">
                    <li class="submenu-item">
                        <a href="#">Kasir</a>
                    </li>
                    <li class="submenu-item">
                        <a href="#">Kasir</a>
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
                        <a href="#">Coming Soon</a>
                    </li>
                </ul>
            </li>

            <li class="sidebar-item has-sub">
                <a href="#" class="sidebar-link">
                    <i class="fad fa-person-dolly"></i>
                    <span>Pesan Antar</span>
                </a>
                <ul class="submenu">
                    <li class="submenu-item">
                        <a href="#">Coming Soon</a>
                    </li>
                </ul>
            </li>
            @endcan
            
            @can('user')
            <li class="sidebar-item has-sub">
                <a href="#" class="sidebar-link">
                    <i class="fad fa-person-dolly"></i>
                    <span>Pesan Antar</span>
                </a>
                <ul class="submenu">
                    <li class="submenu-item">
                        <a href="#">Coming Soon</a>
                    </li>
                </ul>
            </li>    
            @endcan

            <li class="sidebar-title">Pengaturan</li>
            <li class="sidebar-item has-sub">
                <a href="#" class="sidebar-link">
                    <i class="fa-solid fa-user-gear"></i>
                    <span>Kelola Akun</span>
                </a>
                <ul class="submenu">
                    <li class="submenu-item">
                        <a href="{{ route('user.index') }}">Profile</a>
                    </li>
                </ul>
            </li>
            
            <li class="sidebar-item">
                <a href="{{ route('logout') }}" class="sidebar-link btn-logout">
                    <i class="fa-solid fa-arrow-right-from-bracket"></i>
                    <span>Logout</span>
                </a>
            </li>
        </ul>
    </div>
</div>