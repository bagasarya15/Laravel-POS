@section('title')
    Laporan Data Produk
@endsection

<!DOCTYPE html>
<html lang="en">
<head>
    @include('helpers.helpers-head')
</head>
<body onload="window.print()">
    <div class="card mt-3 mx-3">
        <div class="d-flex">
            <a href=""><img src="{{ asset('storage/logo/logo.png') }}" alt="Logo" width="100" class="ms-5"></a>
            <div class="m-auto">
                <h2 class="text-uppercase text-center mt-3">LAPORAN DATA PRODUK</h2>
                <h6 class="text-muted" width="100" style="font-size: 12px;">Kp.Rawageni, Perumahan Griya Sari Permai RT05 / RW02 Blok C11, Kel.Ratu Jaya, Kec.Cipayung, Kota Depok</h6>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <section class="section mx-3">
            <div class="row" id="table-bordered">
                <div class="col-12">
                    <div class="card">
                        <div class="card-content">
                            <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered mb-0">
                                    <thead>
                                        <tr>
                                            <th>Kode Produk</th>
                                            <th>Nama Produk</th>
                                            <th>Kategori</th>
                                            <th>Total Stok</th>
                                            <th>Harga Beli</th>
                                            <th>Harga Jual</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($product as $product)
                                        <tr>
                                            <td>{{ $product->code_product }}</td>
                                            <td>{{ $product->name }}</td>
                                            <td>{{ $product->category->name }}</td>
                                            <td>{{ $product->stok }}</td>
                                            <td>Rp {{ number_format($product->price_buy) }}</td>
                                            <td>Rp {{ number_format($product->price_sell) }}</td>
                                        </tr>
                                        @php
                                            $jumlahStok = $product->sum('stok');
                                            $totalStok  = $product->stok;
                                            $totalBeli  = $product->price_buy * $totalStok; 
                                            $totalJual  = $product->price_sell * $totalStok;
                                        @endphp
                                        @endforeach 
                                    </tbody>
                                    <tfoot>
                                        <th class="font-weight-bold"> Total </th>
                                        <th colspan="2"></th>
                                        <th class="font-weight-bold"> {{ number_format($totalStok) }}</th>
                                        <th class="font-weight-bold">Rp {{ number_format($totalBeli) }}</th>
                                        <th class="font-weight-bold">Rp {{ number_format($totalJual) }}</th>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</body>
@include('helpers.helpers-script')
</html>