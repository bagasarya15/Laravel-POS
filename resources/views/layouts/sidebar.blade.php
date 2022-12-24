<div class="sidebar-wrapper active">
    <div class="sidebar-header position-relative">
        <div class="d-flex justify-content-between align-items-center" >
            <div class="logo">
                <a href="{{ '/' }}">
                    <h4 class="fs-5 mt-3  fw-bolder"><i class="fa-solid fa-code"></i> <span class="small">  {{ $store_information->name }} </span></h4>
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
            {{-- Sidebar Menu Access --}}
            <li class="sidebar-title">Menu</li>
            
            @can('admin')
                @include('layouts.sidebar-admin')
            @endcan

            @can('sub-admin')
                @include('layouts.sidebar-sub')
            @endcan
            
            @can('user')
                @include('layouts.sidebar-user')
            @endcan
            {{-- End Sidebar Menu Access --}}
        </ul>
    </div>
</div>