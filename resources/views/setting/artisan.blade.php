@extends('layouts.main')

@section('menu-heading')
    Pengaturan
@endsection

@section('title')
    Artisan Call
@endsection

@section('content')
    @include('layouts.sweet-alert')
    <section class="section">
        <div class="card">
            <div class="card-body table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Artisan Call</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                                $i = 1;
                            @endphp
                        <tr>
                            <td>{{ $i++ }}</td>
                            <td><a href="/route-cache" class="btn btn-sm btn-primary w-75"> Clear Route Cache</a></td>
                        </tr>    
                        <tr>
                            <td>{{ $i++ }}</td>
                            <td><a href="/config-cache" class="btn btn-sm btn-danger w-75"> Clear Config Cache</a></td>
                        </tr>    
                        <tr>
                            <td>{{ $i++ }}</td>
                            <td><a href="/clear-cache" class="btn btn-sm btn-warning w-75"> Clear Cache</a></td>
                        </tr>    
                        <tr>
                            <td>{{ $i++ }}</td>
                            <td><a href="/view-cache" class="btn btn-sm btn-success w-75"> Clear View Cache</a></td>
                        </tr>    
                        <tr>
                            <td>{{ $i++ }}</td>
                            <td><a href="/storage-link" class="btn btn-sm btn-info w-75 ask-storage"> Create Storage:link</a></td>
                        </tr>    
                    </tbody>
                </table>
            </div>
        </div>
    </section>

    @push('script')
        <script>
            $(".ask-storage").on("click", function (e) {
                e.preventDefault();
                let form = $(this).parents("form");
                Swal.fire({
                    title: "Konfirmasi membuat storage:link",
                    text: "Ingin membuat storage:link ?",
                    icon: "info",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Ya ",
                    cancelButtonText: "Batal",
                }).then((result) => {
                    if (result.value) {
                        document.location.href = '/storage-link' ;
                    }
                });
            });
        </script>
    @endpush
@endsection
