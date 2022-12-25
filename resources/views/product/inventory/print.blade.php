@section('title')
    Laporan Data Produk
@endsection

<!DOCTYPE html>
<html lang="en">
<head>
    @include('helper.report_css')
    <title>{{ $store_information->name }} | @yield('title')</title>
</head>
<body onload="window.print()">
    <div class="mt-2 ms-1">
        <div class="d-flex">
            <a href="{{ route('product.print') }}"><img src="{{ asset('storage/' . $store_information->image) }}" alt="Logo" width="100" class="ms-5"></a>
            <div class="m-auto">
                <h2 class="text-uppercase text-center mt-3">LAPORAN DATA PRODUK</h2>
                <h6 class="text-muted" width="100" style="font-size: 12px;">{{ $store_information->address }}</h6>
            </div>
        </div>
    </div>
    
    <section class="section mx-3 mt-3">
        <div class="row">
            <div class="col-lg-12">
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
                                    @endforeach 
                                    
                                    @php
                                        $totalBeli = $product->sum('price_buy')  * $product->stok;
                                        $totalJual = $product->sum('price_sell') * $product->stok; 
                                        $subtotal   = $totalJual - $totalBeli;
                                    @endphp
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th class="font-weight-bold"> Total : Rp {{ number_format($subtotal) }}  </th>
                                        <th colspan="2"></th>
                                        <th class="font-weight-bold"> {{ number_format($product->sum('stok')) }}</th>
                                        <th class="font-weight-bold">Rp {{ number_format($totalBeli) }}</th>
                                        <th class="font-weight-bold">Rp {{ number_format($totalJual)}}</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @include('helper.report_script')
</body>
</html>