<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $order->no_order }}</title>
    <link rel="stylesheet"  href="{{ asset('assets/extensions/bootstrap-5/css/bootstrap.min.css') }}">
    <style>  
        .sheet {
            margin: 0;
            overflow: hidden;
            position: relative;
            box-sizing: border-box;
            page-break-after: always;
        }

        body.struk .sheet { 
            width : 80mm;
        }
        body.struk .sheet{ 
            padding : 1mm; 
        }

        @media screen {
            body { background: #e0e0e0;font-family: monospace; }
            .sheet {
                background: white;
                box-shadow: 0 .5mm 2mm rgba(0,0,0,.3);
                margin: 5mm;
            }

            table {
                margin-left: 5px;
            }
        }

        @media print {
            body { font-family: monospace; }
            body.struk                 { width: 58mm; text-align: left;}
            body.struk .sheet          { padding: 2mm; }
            .txt-left { text-align: left;}
            .txt-center { text-align: center;}
            .txt-right { text-align: right;}
        }
    </style>
</head>
<body class="struk" onload="window.print()">
    <section class="sheet">
        <table cellpadding="0" cellspacing="0">
            <tr>
                <td>{{ $store_information->name }}</td>
            </tr>
            <tr>
                <td>{{ $store_information->address }}</td>
            </tr>
            <tr>
                <td>Telp: {{ $store_information->number_phone}}</td>
            </tr>
        </table>

        <tr><td> {{ str_repeat('=', 33) }} </td></tr>

        <table cellpadding="0" cellspacing="0" >
            <tr>
                <td>No Invoice <span style="margin-left:22px">:</span> {{ $order->no_order }}</td>
            </tr>
            <tr>
                <td>Tgl-Transaksi : {{ $order->created_at}}</td>
            </tr>
            <tr>
                <td>Kasir <span style="margin-left:58px">:</span> {{ $order->cashier_name}}</td>
            </tr>
            <tr>
                <td>Customer <span style="margin-left:36px">:</span> {{ $order->member->name}}</td>
            </tr> 
        </table>

        <tr><td> {{ str_repeat('=', 33) }} </td></tr>

        <table class="table table-borderless">
            <thead>
                <tr>
                    <th>Produk</th>
                    <th>Qty</th>
                    <th>Harga/Pcs</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($order->productOrder as $data)
                    <tr>
                        <td>{{ $data->getProduct->name }}</td>
                        <td>{{ $data->qty }}</td>
                        <td>Rp {{ number_format($data->getProduct->price_sell) }}</td>
                        <td>Rp {{ number_format($data->total) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <tr><td> {{ str_repeat('=', 33) }} </td></tr>

        <table style="font-size: 13px">
            <tr>
                <td>Subtotal <span style="margin-left:30px">Rp {{ number_format($order->sub_total) }}</span></td>
            </tr>
            <tr>
                <td>Total <span style="margin-left: 52px">Rp {{ number_format($order->total) }}</span> </td>
            </tr>
            <tr>
                <td>Tunai <span style="margin-left: 52px">Rp {{ number_format($order->payment) }}</span></td>
            </tr>
            <tr>
                <td>Kembalian <span style="margin-left: 23px">Rp {{ number_format($order->change_money) }}</span></td>
            </tr>
        </table>

        <tr><td> {{ str_repeat('=', 33) }} </td></tr>

        <h5 style="font-size: 13px; margin-left:32%" class="tetx-center">Terima Kasih</h5>
        
    </section>
    <script src="{{ asset('assets/extensions/bootstrap-5/js/bootstrap.min.js') }}"></script>
</body>
</html>