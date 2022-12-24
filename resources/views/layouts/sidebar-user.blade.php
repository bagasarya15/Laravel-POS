<section for="user">
    <li class="sidebar-item has-sub">
        <a href="#" class="sidebar-link">
            <i class="fa-solid fa-cart-shopping"></i>
            <span>Transaksi</span>
        </a>
        <ul class="submenu">
            <li class="submenu-item">
                <a href="{{ route('transaction.index') }}">Transaksi Penjualan</a>
            </li>
            <li class="submenu-item">
                <a href="{{ route('data-transaction') }}">Data Penjualan</a>
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