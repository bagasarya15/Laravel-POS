<div class="col-12 col-lg-12">
    <div class="row mt-2">
        <div class="col-6 col-lg-3 col-md-6">
            <div class="card">
                <div class="card-body px-4 py-4-5">
                    <div class="row">
                        <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                            <div class="stats-icon purple mb-2">
                                <i class="fa-solid fa-sack-dollar"></i>
                            </div>
                        </div>
                        <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                            <h6 class="text-muted font-semibold small">Total Penjualan</h6>
                            <h6 class="font-extrabold mb-0 small">Rp {{ number_format($totalOrder)}}</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6 col-lg-3 col-md-6">
            <div class="card">
                <div class="card-body px-4 py-4-5">
                    <div class="row">
                        <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                            <div class="stats-icon blue mb-2">
                                <i class="fa-solid fa-cart-flatbed"></i>
                            </div>
                        </div>
                        <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                            <h6 class="text-muted font-semibold small">Total Pembelian</h6>
                            <h6 class="font-extrabold mb-0 small">Rp {{ number_format($totalPurchase) }} </h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6 col-lg-3 col-md-6">
            <div class="card">
                <div class="card-body px-4 py-4-5">
                    <div class="row">
                        <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                            <div class="stats-icon green mb-2">
                                <i class="fa-solid fa-chart-simple"></i>
                            </div>
                        </div>
                        <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                            <h6 class="text-muted font-semibold small">Total Pengeluaran</h6>
                            <h6 class="font-extrabold mb-0 small">Rp {{ number_format($totalSpending) }} </h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6 col-lg-3 col-md-6">
            <div class="card">
                <div class="card-body px-4 py-4-5">
                    <div class="row">
                        <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                            <div class="stats-icon red mb-2">
                                <i class="fa-solid fa-chart-pie"></i>
                            </div>
                        </div>
                        <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                            <h6 class="text-muted font-semibold small">Laba Bersih</h6>
                            <h6 class="font-extrabold mb-0 small">Rp {{ number_format($netProfit) }} </h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="ms-3 mb-5"> 
            @if ($firstDate == Carbon\Carbon::now()->format('M'))    
                <small class="text-danger fst-italic">Filter Data Bulan {{ Carbon\Carbon::parse($firstDate)->translatedFormat('F Y') }}</small>
            @elseif ($firstDate == $lastDate)
                <small class="text-danger fst-italic">Filter Data  {{ Carbon\Carbon::parse($firstDate)->translatedFormat('d F Y') }}</small>
            @else
                <small class="text-danger fst-italic">Filter Data {{ Carbon\Carbon::parse($firstDate)->translatedFormat('d F Y') }} - {{ Carbon\Carbon::parse($lastDate)->translatedFormat('d F Y') }}</small>
            @endif
        </div>
    </div>
</div>