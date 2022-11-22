@extends('layouts.main')

@section('menu-heading')
    Pengaturan
@endsection

@section('title')
    Kelola Toko
@endsection

@section('content')
<section id="multiple-column-form">
    @include('layouts.sweet-alert')
    <div class="row match-height">
        <div class="col-12">
            <div class="card">
                <div class="card-content">
                    <div class="card-body">
                        <ul class="list-group">
                        @foreach ($settings as $settings)
                            <a href="{{ route('settings.show', $settings->id) }}" class="card-link mb-4"> <i class="fas fa-eye"></i> Lihat Detail</a> 
                            <div class="table-responsive">
                                <table class="table table-lg">
                                    <thead>
                                        <tr>
                                            <th>Nama Toko</th>
                                            <th>Nama Pemilik Toko</th>
                                            <th>Alamat</th>
                                            <th>Nomor Tlp</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="text-bold-500">{{ $settings->name }}</td>
                                            <td class="text-bold-500">{{ $settings->owner_name }}</td>
                                            <td class="text-bold-500">{{ $settings->address }}</td>
                                            <td class="text-bold-500">{{ $settings->number_phone }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <a href="{{ route('settings.show', $settings->id) }}" class="card-link mt-4"><small>Terakhir Update {{ $settings->updated_at->diffForHumans() }}</small></a>
                        @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
