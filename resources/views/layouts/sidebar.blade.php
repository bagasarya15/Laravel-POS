<div class="sidebar-wrapper active">
    <div class="sidebar-header position-relative">
        <div class="d-flex justify-content-between align-items-center" >
            <div class="logo">
                <a href="{{ '/' }}">
                    <h1 class="fs-5 mt-3 mx-1 fw-bolder"><i class="fa-solid fa-code"></i> {{ $getTitle->name }}</h1>
                </a>
            </div>

            {{-- Toogle Access --}}
            @can('admin')
            @include('layouts.toogle-theme')
            @endcan

            @can('sub-admin')
                @include('layouts.non-toogle')
            @endcan

            @can('user')
                @include('layouts.non-toogle')
            @endcan
            {{-- End Toogle Access --}}

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
            <section for="admin"> 
                {{-- <li class="sidebar-item active">
                    <a href="{{ ('/') }}" class="sidebar-link">
                        <i class="bi bi-grid-fill"></i>
                        <span>Dashboard</span>
                    </a>
                </li> --}}
                
                <li class="sidebar-item has-sub">
                    <a href="#" class="sidebar-link">
                        <i class="bi bi-grid-fill"></i>
                        <span>Dashboard</span>
                    </a>
                    <ul class="submenu">
                        <li class="submenu-item">
                            <a href="{{ route('dashboard') }}">Statistics</a>
                        </li>
                        <li class="submenu-item">
                            <a href="{{ route('system-info.index') }}">Informasi Update</a>
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
                            <a href="">Pembelian</a>
                        </li>
                        <li class="submenu-item">
                            <a href="">Penjualan</a>
                        </li>
                        <li class="submenu-item">
                            <a href="">Transaksi Baru</a>
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
                            <a href="{{ route('product.reports') }}" target="_blank">Laporan Data Produk</a>
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
                            <a href="{{ route('settings.index') }}">Kelola Toko</a>
                        </li>
                        <li class="submenu-item">
                            <a href="{{ route('user-access.index') }}">Role Akses</a>
                        </li>
                        <li class="submenu-item">
                            <a href="{{ route('logout') }}" class="btn-logout">Logout</a>
                        </li>
                    </ul>
                </li>
            </section>
            @endcan

            @can('sub-admin')
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
                        <li class="submenu-item">
                            <a href="{{ route('system-info.index') }}">Informasi Update</a>
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
                            <a href="">Pembelian</a>
                        </li>
                        <li class="submenu-item">
                            <a href="">Penjualan</a>
                        </li>
                        <li class="submenu-item">
                            <a href="">Transaksi Baru</a>
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
                            <a href="{{ route('product.reports') }}" target="_blank">Laporan Data Produk</a>
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
                            <a href="{{ route('settings.index') }}">Kelola Toko</a>
                        </li>
                        <li class="submenu-item">
                            <a href="{{ route('logout') }}" class="btn-logout">Logout</a>
                        </li>
                    </ul>
                </li>
            </section>
            @endcan
            
            @can('user')
            <section for="user">

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
            @endcan
        </ul>
    </div>
</div>