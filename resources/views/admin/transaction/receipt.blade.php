<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style.css">
    <title>Receipt</title>

    <style>
        @font-face {
            font-family: 'Inconsolata', monospace;
            src: url("{{ asset('fonts/inconsolata.ttf') }}");
        }

        * {
            font-size: 11px;
            font-family: 'Inconsolata', monospace;
        }

        body {
            margin: auto;
            padding: 0;
            width: 58mm;
        }

        td,
        th,
        tr,
        table {
            border-top: 1px solid transparent;
            border-collapse: collapse;
            width: 100%
        }

        /* td.description,
        th.description {
            width: 75px;
            max-width: 75px;
        }

        td.quantity,
        th.quantity {
            width: 40px;
            max-width: 40px;
            word-break: break-all;
        }

        td.price,
        th.price {
            width: 40px;
            max-width: 40px;
            word-break: break-all;
        } */

        .centered {
            text-align: center;
            align-content: center;
        }

        .ticket {
            width: 58mm;
            padding: 5px
        }

        img {
            text-align: center;
            width: 75%;
        }

        .add-note td {
            width: 50%
        }

        hr.dotted {
            border-top: 1px dashed black;
        }

        .item-order {
            width: 100%
        }

        .item-order tr {
            width: 100%
        }

        .item-order p {
            margin: 0px
        }

        .item-order td:nth-child(1) {
            width: 60%;
        }

        .item-order td:nth-child(2) {
            width: 40%;
            text-align: right
        }

        h1 {
            font-size: 26px;
            font-weight: 800;
        }

        @media print {

            .hidden-print,
            .hidden-print * {
                display: none !important;
            }
        }
    </style>
</head>

<body>
    <div class="ticket">
        <center>
            <img style="width: 100%;" src="{{ asset('assets/images/meatmaster_logo.jpeg')}}" alt="">
        </center>
        <center>
            <h1>MEAT MASTER</h1>
        </center>
        <p class="centered">
            Ruko Kemang Pratama Raya Blok MM, Jl. Kemang Pratama Raya No.10, Bojong Rawalaumbu, Kec. Rawalumbu, Kota
            Bks, Jawa Barat
        </p>
        <p style="text-align: center"> NPWP 50.588.919.6-014.000 </p>
        <p style="text-align: center">{{ $transaction->created_at->format('d-m-Y h:m:s') }}</p>
        <hr class="dotted">
        <table class="add-note">
            <tr>
                <td>Receipt</td>
                <td style="text-align: right">
                    #{{ $transaction->receipt_no }}
                </td>
            </tr>
            <tr>
                <td>Order</td>
                <td style="text-align: right">#{{ $transaction->invoice_no }}</td>
            </tr>
            <tr>
                <td>Cashier</td>
                <td style="text-align: right">{{ $transaction->user->name }}</td>
            </tr>
        </table>
        <hr class="dotted">
        <table class="item-order">
            <tbody>
                <?php $sub_total = 0; $potongan = 0; $total_price = 0; $total_discount = 0; $sub_disc = 0; ?>
                @foreach($details as $d)
                <?php
                    $total_item_price = $d->quantity * $d->price;
                    $sub_total += $total_item_price;
                    // $discount_amount = $d->quantity * $d->discount;
                    $total_discount = $d->quantity * $d->discount;
                    $sub_disc += $total_discount;
                ?>
                <tr>
                    <td>
                        <p style="text-transform: uppercase; font-weight: 500">{{ $d->name}}</p>
                        <p>{{ $d->quantity}}x
                            {{-- @if( $d->discount > 0)
                            @currency($d->basic_price)&nbsp; &nbsp;
                            @endif --}}
                            @currency($d->basic_price) &nbsp;
                            {{-- @if( $d->discount > 0)
                            {{$d->discount}}
                            @endif --}}
                        </p>
                    </td>
                    <td>

                        @if ($d->discount > 0 && $d->is_isales == 1)
                        <p style="padding-top: 15px">@currency($total_item_price)</p>
                        <p>
                            (- @currency($total_discount))
                        </p>
                        @else
                        <p style="padding-top: 15px">@currency($total_item_price)</p>
                        @endif
                        <br>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <hr class="dotted" style="margin-top: 10px">
        <table class="item-order">
            <?php 
                $vat_amount = ($sub_total / 100) * $transaction->vat_ppn;
                $total_price = $sub_total + $vat_amount;
                $total_disc = $sub_disc;
                $grand_total = $sub_total - $sub_disc;

                $uang_cust = 0;
                if ($transaction->payment_method == 'Tunai') {
                    $uang_cust = $transaction->cash;
                    $kembalian = !empty($transaction->kembalian) ? $transaction->kembalian : $transaction->cash - $total_price;
                }
            ?>
            <tbody>
                <tr>
                    <td class="description">TOTAL</td>
                    <td class="price">@currency($total_price)</td>
                </tr>
                @if ($sub_disc > 0 && $transaction->is_isales == 1)
                <tr>
                    <td class="description">ANDA HEMAT</td>
                    <td class="price">@currency($sub_disc)</td>
                </tr>
                <tr>
                    <td class="description" style="font-weight: 700">GRAND TOTAL</td>
                    <td class="price">@currency($grand_total)</td>
                </tr>
                @else
                @endif


            </tbody>
        </table>

        @if ($transaction->payment_method == 'Tunai')
        <hr class="dotted">
        <table class="item-order">
            <tbody>
                <tr>
                    <td class="description">TUNAI</td>
                    <td class="price">@currency($transaction->cash)</td>
                </tr>
                <tr>
                    <td class="description">KEMBALI</td>
                    <td class="price">@currency($transaction->kembalian)</td>
                </tr>
            </tbody>
        </table>
        @endif

        {{--
        <hr class="dotted">
        <table class="item-order">
            <tbody>
                <tr>
                    <td class="description">PEMBAYARAN</td>
                    <td class="price">TUNAI</td>
                </tr>
                <tr>
                    <td class="description">CASH</td>
                    <td class="price">Rp 300.000</td>
                </tr>
                <tr>
                    <td class="description">KEMBALIAN</td>
                    <td class="price">Rp 80.000</td>
                </tr>
            </tbody>
        </table> --}}
        <hr class="dotted">
        <p class="centered">Thanks for your purchase!
            <br>PREMIUM FRESH CHICKEN MEAT
        </p>
    </div>
    <button id="btnPrint" class="hidden-print" style="width: 100%;
    padding: 10px;
    border-radius: 10px;
    font-weight: 700;
    margin-bottom: 20px;
}">Print</button>
    <a href="{{ route('transaction.create') }}" class="hidden-print" style="    padding: 10px 52px;
    width: 100%;
    text-align: center;
    background: red;
    text-decoration: none;
    color: #fff;
    border-radius: 10px;">Back to Transaction</button>
        <script>
            let buttonPrint = document.getElementById("btnPrint");
        buttonPrint.addEventListener("click", function() {
            window.print()
        });
        </script>
        {{-- <script>
            var lama = 1000;
        t = null;
        function printOut(){
            window.print();
            t = setTimeout("self.close()",lama);
        }
        </script> --}}
</body>

</html>