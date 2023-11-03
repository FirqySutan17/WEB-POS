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

        @font-face {
            font-family: 'idabarcode';
            src: url("{{ asset('fonts/idabarcode.ttf') }}");
        }

        * {
            font-size: 11px;
            font-family: 'Inconsolata', monospace;
        }

        body {
            margin: 0 auto;
            padding: 0;
            width: 7.68cm;
            position: relative;
        }

        .barcode-line {
            font-family: 'idabarcode';
            font-size: 20px
        }

        .item-name {
            font-size: 16px
        }



        button,
        a {
            width: 100%;
            padding: 10px;
            font-size: 12px;
            text-align: center;
            margin: 5px;

        }

        button {
            margin-top: 350px
        }

        td,
        th,
        tr,
        table {
            border-top: 1px solid transparent;
            border-collapse: collapse;
            width: 100%
        }

        .centered {
            text-align: center;
            align-content: center;
        }

        .ticket {
            width: 7.68cm;
            height: 2.50cm;
            text-align: center;
            padding: 5px;
            margin: auto 0;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, 10%)
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
        <table class="item-order">
            <tbody>
                <tr>
                    <td class="barcode-line">
                        !{{ $product->code }}!
                    </td>
                </tr>
                <tr>
                    <td class="item-name">
                        {{ $product->name }}
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <button id="btnPrint" class="hidden-print">Print</button>
    <a href="{{ route('product.index') }}" class="hidden-print">Back to Product</a>
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