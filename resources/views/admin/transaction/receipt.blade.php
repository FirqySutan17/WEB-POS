<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style.css">
    <title>Receipt example</title>

    <style>
        * {
            font-size: 12px;
            font-family: 'Times New Roman';
        }

        body {
            margin: 0;
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

        .item-order td:nth-child(1) {
            width: 70%;
        }

        .item-order td:nth-child(2) {
            width: 30%;
            text-align: right
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
            <img src="{{ asset('images/logo-placeholder.png')}}" alt="Logo">
        </center>
        <p class="centered">
            Jl. Gatot Subroto No.Kav. 38, RT.6/RW.1, Kuningan Bar., Kec. Mampang Prpt., Jakarta, Daerah Khusus
            Ibukota Jakarta 12710
        </p>
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
                <td>Order INV</td>
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
                <?php $sub_total = 0; $potongan = 0; $total_price = 0; $total_discount = 0; ?>
                @foreach($details as $d)
                <?php
                    $total_item_price = $d->quantity * $d->price;
                    $sub_total += $total_item_price;
                    $discount_amount = $d->discount > 0 ? $d->basic_price - $d->price : 0;
                    $total_discount += $discount_amount * $d->quantity;
                ?>
                <tr>
                    <td>
                        <p style="font-weight: 600">{{ $d->name}}</p>
                        <p>{{ $d->quantity}}x &nbsp; &nbsp;
                            @if( $d->discount > 0)
                            <s>@currency($d->basic_price)</s>&nbsp; &nbsp;
                            @endif
                            @currency($d->price)&nbsp; &nbsp;
                            @if( $d->discount > 0)
                            Disc {{$d->discount}}%
                            @endif
                        </p>
                    </td>
                    <td>

                        @if ($d->discount > 0)
                        <p style="padding-top: 15px">@currency($total_item_price)</p>
                        <p>
                            (@currency($total_discount))
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
        <hr class="dotted">
        <table class="item-order">
            <?php 
                $vat_amount = ($sub_total / 100) * $transaction->vat_ppn;
                $total_price = $sub_total + $vat_amount;

                $uang_cust = 0;
                if ($transaction->payment_method == 'Tunai') {
                    $uang_cust = $transaction->cash;
                    $kembalian = !empty($transaction->kembalian) ? $transaction->kembalian : $transaction->cash - $total_price;
                }
            ?>
            <tbody>
                <tr>
                    <td class="description">SUB TOTAL</td>
                    <td class="price">@currency($sub_total)</td>
                </tr>
                <tr>
                    <td class="description">DISC TOTAL</td>
                    <td class="price">@currency($total_discount)</td>
                </tr>
                <tr>
                    <td class="description">GRAND TOTAL</td>
                    <td class="price">@currency($total_price)</td>
                </tr>

                @if ($transaction->payment_method == 'Tunai')
                <tr>
                    <td class="description">TUNAI</td>
                    <td class="price">Rp {{ number_format($transaction->cash) }}</td>
                </tr>
                <tr>
                    <td class="description">KEMBALIAN</td>
                    <td class="price">Rp {{ number_format($transaction->kembalian) }}</td>
                </tr>
                @endif
            </tbody>
        </table>

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
            <br>CHICKEN SHOP
        </p>
    </div>
    <button id="btnPrint" class="hidden-print">Print</button>
    <a href="{{ route('transaction.create') }}" class="hidden-print">Back to Transaction</button>
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