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
            width: 219px;
            max-width: 219px;
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
        <p style="text-align: center">23/08/2023 08:30:00</p>
        <hr class="dotted">
        <table class="add-note">
            <tr>
                <td>Receipt</td>
                <td style="text-align: right">#RCP00001</td>
            </tr>
            <tr>
                <td>Order INV</td>
                <td style="text-align: right">#INV00001</td>
            </tr>
            <tr>
                <td>Cashier</td>
                <td style="text-align: right">John Doe</td>
            </tr>
        </table>
        <hr class="dotted">
        <table class="item-order">
            <tbody>
                <tr>
                    <td>
                        <p style="font-weight: 600">Lorem Ipsum Dolor 500gr</p>
                        <p>2x &nbsp; &nbsp; @60.000&nbsp; &nbsp; Disc 10%</p>
                    </td>
                    <td>Rp 120.000</td>
                </tr>
                <tr>
                    <td>
                        <p style="font-weight: 600">Lorem Ipsum Dolor 500gr</p>
                        <p>2x &nbsp; &nbsp; @20.000</p>
                    </td>
                    <td>Rp 40.000</td>
                </tr>
                <tr>
                    <td>
                        <p style="font-weight: 600">Lorem Ipsum Dolor 500gr</p>
                        <p>2x &nbsp; &nbsp; @20.000</p>
                    </td>
                    <td>Rp 40.000</td>
                </tr>

            </tbody>
        </table>
        <hr class="dotted">
        <table class="item-order">
            <tbody>
                <tr>
                    <td class="description">SUB TOTAL</td>
                    <td class="price">Rp 200.000</td>
                </tr>
                <tr>
                    <td class="description">VAT 10%</td>
                    <td class="price">Rp 20.000</td>
                </tr>
                <tr>
                    <td class="description">DISC 0%</td>
                    <td class="price">Rp 0</td>
                </tr>
                <tr>
                    <td class="description">GRAND TOTAL</td>
                    <td class="price">Rp 220.000</td>
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