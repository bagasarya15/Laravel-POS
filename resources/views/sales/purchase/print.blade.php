@section('title')
    Laporan Pengeluaran
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
            <a href=""><img src="{{ asset('storage/' . $store_information->image) }}" alt="Logo" width="100" class="ms-5"></a>
            <div class="m-auto">
                <h2 class="text-uppercase text-center mt-3">LAPORAN DATA PEMBELIAN</h2>
                <h6 class="text-muted" width="100" style="font-size: 12px;">{{ $store_information->address }}</h6>
            </div>
        </div>
    </div>
    
    <section class="section mt-3">
        <div class="row">
            <div class="col-lg-12">
                <div class="">
                    <div class="card-content">
                        <div class="card-body">
                            <div class="card-content">
                        <div class="card-body">
                        <div class="mb-2">
                            @if ($tglAwal == $tglAkhir)    
                                <small class="text-danger fst-italic">Laporan Pembelian  {{ Carbon\Carbon::parse($tglAwal)->translatedFormat('d F Y') }}</small>
                            @else
                                <small class="text-danger fst-italic">Laporan Pembelian {{ Carbon\Carbon::parse($tglAwal)->translatedFormat('d F Y') }} - {{ Carbon\Carbon::parse($tglAkhir)->translatedFormat('d F Y') }}</small>
                            @endif
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered mb-0">
                                <thead class="small">
                                    <tr class="small">
                                        <th>Purchase Invoice</th>
                                        <th>Tanggal Transaksi</th>
                                        <th>Dibeli Oleh</th>
                                        <th>Supplier</th>
                                        <th>Discount</th>
                                        <th>Total Pembelian</th>
                                        <th>Dibayar</th>
                                    </tr>
                                </thead>
                                <tbody class="small">
                                    @foreach ($query as $order)
                                    <tr class="small">
                                        <td><a href="{{ route('purchase.invoice', $order->purchase_order ) }}" class="text-primary text-decoration-none">{{ $order->purchase_order }}</a></td>
                                        <td>{{ $order->created_at }}</td>
                                        <td>{{ $order->purchase_by }}</td>
                                        <td>{{ $order->getSupplier->name }}</td>                                  
                                        <td>Rp {{ number_format($order->discount) }}</td>
                                        <td>Rp {{ number_format($order->total) }}</td>
                                        <td>Rp {{ number_format($order->payment) }}</td>
                                    </tr>    
                                    @endforeach
                                </tbody>
                                <tfoot class="small">
                                    <tr class="small">
                                        <th colspan="2">Subtotal : Rp {{ number_format($query->sum('total')) }}</th>
                                        <th colspan="5" >Subtotal - Discount : Rp {{ number_format($query->sum('payment'))  }}</th>
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