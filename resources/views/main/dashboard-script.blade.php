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