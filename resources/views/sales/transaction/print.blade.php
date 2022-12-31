@section('title')
    Laporan Pengeluaran
@endsection

<!DOCTYPE html>
<html lang="id">
<head>
    @include('helper.report_css')
    <title>{{ $store_information->name }} | @yield('title')</title>
</head>
<body onload="window.print()">
    <div class="mt-2 ms-1">
        <div class="d-flex">
            <a href=""><img src="{{ asset('storage/' . $store_information->image) }}" alt="Logo" width="100" class="ms-5"></a>
            <div class="m-auto">
                <h2 class="text-uppercase text-center mt-3">LAPORAN DATA PENJUALAN</h2>
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
                            <div class="mb-2">
                                @if ($firstDate == $lastDate)    
                                    <small class="text-danger fst-italic">Laporan Penjualan  {{ Carbon\Carbon::parse($firstDate)->translatedFormat('d F Y') }}</small>
                                @else
                                    <small class="text-danger fst-italic">Laporan Penjualan {{ Carbon\Carbon::parse($firstDate)->translatedFormat('d F Y') }} - {{ Carbon\Carbon::parse($lastDate)->translatedFormat('d F Y') }}</small>
                                @endif
                            </div>
                        <div class="table-responsive">
                            <table class="table table-bordered mb-0">
                                <thead style="font-size: 13px" class="small">
                                    <tr class="small">
                                        <th>No</th>
                                        <th>No Invoice</th>
                                        <th>Kasir</th>
                                        <th>Tanggal Transaksi</th>
                                        <th>Customer</th>
                                        <th>Subtotal</th>
                                        <th>Discount</th>
                                        <th>Total</th>
                                        <th>Dibayar</th>
                                        <th>Kembalian</th>
                                    </tr>
                                </thead>
                                <tbody style="font-size: 13px" class="small">
                                    @php
                                        $i = 1;    
                                    @endphp
                                    @foreach ($query as $order)
                                    <tr>
                                        <td> {{  $i++ }}</td>
                                        <td ><a href="{{ route('transaction.invoice', $order->no_order) }}" target="__blank" class="text-primary text-decoration-none">{{ $order->no_order }}</a></td>
                                        <td>{{ $order->cashier_name }}</td>
                                        <td>{{ $order->created_at }}</td>
                                        <td>{{ $order->member->name }}</td>
                                        <td>Rp {{ number_format($order->sub_total) }}</td>
                                        <td>Rp {{ number_format($order->discount) }}</td>
                                        <td>Rp {{ number_format($order->total) }}</td>
                                        <td>Rp {{ number_format($order->payment) }}</td>
                                        <td>Rp {{ number_format($order->change_money) }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                                <tfoot class="small">
                                    <tr class="small">
                                        <th colspan="5">Total Potongan Discount : Rp {{ number_format($query->sum('discount')) }}</th>
                                        <th colspan="5">Total Penjualan : Rp {{ number_format($query->sum('total'))  }}</th>
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