<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Invoice</title>
    <style>
        .container {
            width: 300px;
        }
        .header {
            margin: 0;
            text-align: center;
        }
        h2, p {
            margin: 0;
        }
        .flex-container-1 {
            display: flex;
            margin-top: 10px;
        }

        .flex-container-1 > div {
            text-align : left;
        }
        .flex-container-1 .right {
            text-align : right;
            width: 200px;
        }
        .flex-container-1 .left {
            width: 100px;
        }
        .flex-container {
            width: 300px;
            display: flex;
        }

        .flex-container > div {
            -ms-flex: 1;  /* IE 10 */
            flex: 1;
        }
        ul {
            display: contents;
        }
        ul li {
            display: block;
        }
        hr {
            border-style: dashed;
        }
        a {
            text-decoration: none;
            text-align: center;
            padding: 10px;
            background: #00e676;
            border-radius: 5px;
            color: white;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="container">
        @include('layouts.sweet-alert')
        <div class="header" style="margin-bottom: 30px;">
            <h2>{{ $getTitle->name }}</h2>
            <small>{{ $getTitle->address }}
            </small>
        </div>
        <hr>
        <div class="flex-container-1">
            <div class="left">
                <ul>
                    <li>No Order</li>
                    <li>Kasir</li>
                    <li>Customer</li>
                    <li>Tanggal</li>
                </ul>
            </div>
            <div class="right">
                <ul>
                    <li> {{ $order->no_order }} </li>
                    <li> {{ $order->cashier_name }} </li>
                    <li> {{ $order->member->name }} </li>
                    <li> {{ date('Y-m-d : H:i:s', strtotime($order->created_at)) }} </li>
                </ul>
            </div>
        </div>
        <hr>
        <div class="flex-container" style="margin-bottom: 10px; text-align:right;">
            <div style="text-align: left;">Nama Product</div>
            <div>Harga/Qty</div>
            <div>Total</div>
        </div>
        @foreach ($order->productOrder as $item)
            <div class="flex-container" style="text-align: right;">
                {{-- @php
                    if(!empty($item->getProduct->name)) {
                        $arr_name = explode(' ', $item->getProduct->name);
                        $name = $arr_name[0];
                    } elseif ($item->getProduct->name != '') {
                            $name = $item->getProduct->name;
                    } else {
                        $name = 'there';
                    }
                @endphp --}}
                <div style="text-align: left;">{{ $item->qty }}x {{ $item->getProduct->name }}</div>
                <div>Rp {{ number_format($item->getProduct->price_sell) }} </div>
                <div>Rp {{ number_format($item->total) }} </div>
            </div>
        @endforeach
        <hr>
        <div class="flex-container" style="text-align: right; margin-top: 10px;">
            <div></div>
            <div>
                <ul>
                    <li>Sub Total</li>
                    <li>Diskon</li>
                    <li>Total</li>
                    <li>Tunai</li>
                    <li>Kembalian</li>
                </ul>
            </div>
            <div style="text-align: right;">
                <ul>
                    <li>Rp {{ number_format($order->sub_total) }} </li>
                    <li>Rp {{ number_format($order->discount) }}</li>
                    <li>Rp {{ number_format($order->total) }}</li>
                    <li>Rp {{ number_format($order->payment) }}</li>
                    <li>Rp {{ number_format($order->change_money) }}</li>
                </ul>
            </div>
        </div>
        <hr>
        <div class="header" style="margin-top: 50px;">
            <h3>Terimakasih</h3>
            <p>Silahkan berkunjung kembali</p>
        </div>
    </div>
</body>
</html>