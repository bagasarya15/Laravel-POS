@extends('layouts.main')

@section('menu-heading')
    Dashboard
@endsection

@section('title')
    Statistics
@endsection

@section('content')

@include('layouts.sweet-alert')   

<div class="page-content">
    <div class="row">
        <div class="col">
            <form action="{{ route('dashboard-search') }}" class="d-inline-flex ms-3">
                <input type="text" class="form-control" name="firstDate" placeholder="Tanggal Awal" onfocus="(this.type='date')" >
                
                <input type="text" class="form-control ms-2" name="lastDate" placeholder="Tanggal Akhir" onfocus="(this.type='date')">
                <button type="submit" class="btn btn-sm btn-primary ms-2"><i class="fa-solid fa-magnifying-glass"></i></button>
            </form>
        </div>
    </div>

    <section class="row">
        @include('main.dashboard-statistic')
    </section>

    <section class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                <h4>Grafik Penjualan, Pembelian & Pengeluaran</h4>
                </div>
                <div class="card-body">
                    <div id="chart">
                        
                    </div>
                </div>
            </div>
            </div>
        </div>
    </section>

    <section class="row">
        @include('main.dashboard-table')
    </section>
</div>

    @push('script')
        <script>
        
        var options = {
            series: [{
            name: 'Penjualan',
            data: [{{ $totalOrder }}]
            }, {
            name: 'Pembelian',
            data: [{{ $totalPurchase }}]
            }, {
            name: 'Pengeluaran',
            data: [{{ $totalSpending }}]
            }],
            chart: {
            type: 'bar',
            height: 350
            },
            plotOptions: {
            bar: {
                horizontal: false,
                columnWidth: '50%',
                endingShape: 'rounded'
            },
            },
            dataLabels: {
            enabled: false
            },
            stroke: {
            show: true,
            width: 35,
            colors: ['transparent']
            },
            xaxis: {
            categories: ['{{ Carbon\Carbon::parse($firstDate)->translatedFormat('d F Y') }} - {{ Carbon\Carbon::parse($lastDate)->translatedFormat('d F Y') }}'],
            },
            yaxis: {
            title: {
                text: '( IDR ) '
            }
            },
            fill: {
            opacity: 1
            },
            tooltip: {
            y: {
                formatter: function (val) {
                return "IDR " + val 
                }
            }
            }
            };

        var chart = new ApexCharts(document.querySelector("#chart"), options);
        chart.render();
        </script>
    @endpush
@endsection

