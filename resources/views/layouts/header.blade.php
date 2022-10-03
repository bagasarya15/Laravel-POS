<header class="mb-3">
    <nav class="navbar navbar-expand navbar-light navbar-top">
        <div class="container-fluid">
            <a href="#" class="burger-btn d-block">
                <i class="bi bi-justify fs-3"></i>
            </a>

            <button
                class="navbar-toggler"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent"
                aria-expanded="false"
                aria-label="Toggle navigation"
            >
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-lg-0">
                    
                <div class="dropdown">
                    <a href="#" data-bs-toggle="dropdown" aria-expanded="false">
                        <div class="user-menu d-flex">
                            <div class="user-name text-end me-3">
                                <h6 class="mb-0 text-gray-600">{{ auth()->user()->name }}</h6>
                                <p class="mb-0 text-sm text-gray-600">
                                    @ {{ auth()->user()->username }}
                                </p>
                            </div>
                            <div class="user-img d-flex align-items-center">
                                <div class="avatar avatar-md">
                                    <img src="{{ asset('storage/'.auth()->user()->image) }}" />
                                </div>
                            </div>
                        </div>
                    </a>
                    <ul
                        class="dropdown-menu dropdown-menu-end"
                        aria-labelledby="dropdownMenuButton"
                        style="min-width: 11rem"
                    >
                        <li>
                            <h6 class="dropdown-header">Hello, {{ auth()->user()->name }}</h6>
                        </li>
                        <li>
                            <a class="dropdown-item" href="{{ route('user.index') }}"
                                ><i class="icon-mid bi bi-person me-2"></i> My
                                Profile</a
                            >
                        </li>
                        <li>
                            <hr class="dropdown-divider" />
                        </li>
                        <li>
                            <a class="dropdown-item btn-logout" href="{{ route('logout') }}"
                                ><i
                                    class="icon-mid bi bi-box-arrow-left me-2"
                                ></i>
                                Logout</a
                            >
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
</header>
