<div class="row">
    <div class="col">
        <div class="flex">
            @if (auth()->user()->email == null)
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <small>Segera lengkapi profile untuk keamanan akun anda ! <a href="{{ route('user.index') }}">klik disini</a></small>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
        </div>
    </div>
</div>