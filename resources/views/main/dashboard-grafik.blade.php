<div class="col-md-6">
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

<div class="col-md-6">
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table dataTable1 table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Stok Tersisa Sedikit</th>
                        </tr>
                    </thead>
                    <tbody style="font-size: 13px">
                        @php
                            $no = 1;    
                        @endphp
                        @foreach ($products as $item)
                            @if ($item->stok <= 10)
                                <tr class="small">
                                    <td class="text-muted">{{ $no++ }}</td>
                                    <td class="text-muted">
                                        {{  $item->name . ' tersisa ' . $item->stok . ' segera lakukan re-stok' }}
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>