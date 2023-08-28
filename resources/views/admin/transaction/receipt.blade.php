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
            width: 302px;
            max-width: 302px;
        }

        img {
            max-width: 100%;
            width: 100%;
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
        <img src="{{ asset('images/logo-placeholder.png')}}" alt="Logo">
        <p class="centered">
            Jl. Gatot Subroto No.Kav. 38, RT.6/RW.1, Kuningan Bar., Kec. Mampang Prpt., Jakarta, Daerah Khusus
            Ibukota Jakarta 12710
        </p>
        <p style="text-align: center">{{ $transaction[0]->created_at->format('d-m-Y h:m:s') }}</p>
        <hr class="dotted">
        <table class="add-note">
            <tr>
                <td>Receipt</td>
                <td style="text-align: right">
                    #{{ $transaction[0]->receipt_no }}
                </td>
            </tr>
            <tr>
                <td>Order INV</td>
                <td style="text-align: right">#{{ $transaction[0]->invoice_no }}</td>
            </tr>
            <tr>
                <td>Cashier</td>
                <td style="text-align: right">{{ $transaction[0]->user->name }}</td>
            </tr>
        </table>
        <hr class="dotted">
        <table class="item-order">
            <tbody>
                <?php $sub_total = 0; ?>
                <?php $potongan = 0; ?>
                <?php $total_price = 0; ?>
                @foreach($details as $d)
                <?php
                $total_item_price = $d->quantity * $d->price;
                $sub_total += $total_item_price;
                $potongan = ($sub_total / 100) * $transaction[0]->vat_ppn;
                $total_price = $sub_total + $potongan;
                ?>
                <tr>
                    <td>
                        <p style="font-weight: 600">{{ $d->name}}</p>
                        <p>{{ $d->quantity}}x &nbsp; &nbsp; @currency($d->price)&nbsp; &nbsp;
                            @if( $d->discount == 0)

                            @else
                            Disc {{$d->discount}}%
                            @endif
                        </p>
                    </td>
                    <td>@currency($total_item_price)</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <hr class="dotted">
        <table class="item-order">
            <tbody>
                <tr>
                    <td class="description">SUB TOTAL</td>
                    <td class="price">@currency($sub_total)</td>
                </tr>
                <tr>
                    <td class="description">VAT {{ $transaction[0]->vat_ppn }}%</td>
                    <td class="price">@currency($potongan)</td>
                </tr>
                <tr>
                    <td class="description">DISC 0%</td>
                    <td class="price">Rp 0</td>
                </tr>
                <tr>
                    <td class="description">GRAND TOTAL</td>
                    <td class="price">@currency($total_price)</td>
                </tr>
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
    {{-- <button id="btnPrint" class="hidden-print">Print</button> --}}
    <script src="script.js"></script>
</body>

</html>