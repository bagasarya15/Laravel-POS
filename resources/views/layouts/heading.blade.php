<div class="page-title">
    <div class="card">
        <div class="d-flex justify-content-end mt-2 me-2">
            <div class="avatar avatar-xl">
                <img class="mb-2 ml-3" src="{{ asset('storage/'.auth()->user()->image) }}" width="40" alt="Foto Profil">
            </div>
            <div class="mx-2 name">
                <h5 class="font-bold">{{ auth()->user()->name }}</h5>
                <h6 class="text-muted mb-0">@ {{ auth()->user()->username }}</h6>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-md-6 order-md-1 order-last">
            <h3>@yield('title')</h3>
        </div>
        <div class="col-12 col-md-6 order-md-2 order-first">
            <nav aria-label="breadcrumb" class="breadcrumb-header d-flex justify-content-end">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item text-primary">@yield('menu-heading')</li>
                    <li class="breadcrumb-item active" aria-current="page">@yield('title')</li>
                </ol>
            </nav>
        </div>
    </div>
</div>