<html>

<head>
    <title>Report Receive by Receive No</title>
    <link rel="icon" type="image/png" href="var:icon" sizes="16x16">
    <link rel="icon" type="image/png" href="var:icon" sizes="32x32">
    <link rel="icon" href="var:icon" type="image/x-icon" />
    <style type="text/css" media="all">
        @import url('https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');

        * {
            font-family: 'Montserrat', sans-serif;
        }

        body {
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
        }

        .cke_wordcountLimitReached {
            color: red ! important
        }

        .cke_textarea_inline {
            padding: 0px;
            height: 100%;
            overflow: auto;

            border: 1px solid gray;
            -webkit-appearance: textfield;
        }

        @page {
            margin: 20px;
            border: thin solid black;

            @bottom-center {
                content: element(footer);
            }

            @top-center {
                content: element(header);
            }

        }

        #page-header {
            display: block;
            position: running(header);
            text-align: center;
        }

        #page-footer {
            display: block;
            position: absolute;
            bottom: -20px;
            right: 0;
            color: grey
        }

        .page-number:before {
            content: counter(page);
        }

        .page-count:before {
            content: counter(pages);
        }

        .report-title {
            letter-spacing: 4px;
            font-weight: bold;
            font-size: 24px;
            text-align: center;
        }

        #table-header .border-bottom {
            border-bottom-color: #000;
            border-bottom-style: solid;
            border-bottom-width: 1px;
        }

        #table-header .border-top {
            border-top-color: #000;
            border-top-style: solid;
            border-top-width: 1px;
        }

        #table-header .border-left {
            border-left-color: #000;
            border-left-style: solid;
            border-left-width: 1px;
        }

        #table-header .border-right {
            border-right-color: #000;
            border-right-style: solid;
            border-right-width: 1px;
        }

        #table .border-double-bottom {
            border-bottom-color: black;
            border-bottom-style: double;
            border-bottom-width: 3px;
        }

        #table .border-dashed-bottom {
            border-bottom-color: black;
            border-bottom-style: dashed;
            border-bottom-width: 1px;
        }

        #table .border-dashed-top {
            border-top-color: black;
            border-top-style: dashed;
            border-top-width: 1px;
        }

        table {
            /*border-collapse: collapse;*/
            border-spacing: 0;
            width: 100%;
            border: 1px solid #fff
        }

        #table .header-table {
            border: 1px solid #000;

        }

        #table .close-header-table {
            border-color: #000;
            border-style: solid;
            border-width: 1px 1px 2px 1px;

        }

        .no-border {
            border: none;
        }

        .border-top {
            border-top-color: #000;
            border-top-style: solid;
            border-top-width: 1px;
            "

        }

        .border-bottom {
            border-bottom-color: #000;
            border-bottom-style: solid;
            border-bottom-width: 1px;
        }


        .border-left {
            border-left-color: #000;
            border-left-style: solid;
            border-left-width: 1px;
        }

        .border-right {
            border-right-color: #000;
            border-right-style: solid;
            border-right-width: 1px;
        }

        .no-border-right {
            border-left-color: #000;
            border-bottom-color: #000;
            border-top-color: #000;
            border-left-style: solid;
            border-bottom-style: solid;
            border-right-style: none;
            border-top-style: solid;
            border-left-width: 1px;
            border-bottom-width: 1px;
            border-right-width: 0px;
            border-top-width: 1px;
        }

        .no-border-left {
            border-right-color: #000;
            border-bottom-color: #000;
            border-top-color: #000;
            border-right-style: solid;
            border-bottom-style: solid;
            border-left-style: none;
            border-top-style: solid;
            border-left-width: 0px;
            border-bottom-width: 1px;
            border-right-width: 1px;
            border-top-width: 1px;
        }


        .no-border-top {
            border-left-color: #000;
            border-bottom-color: #000;
            border-right-color: #000;
            border-left-style: solid;
            border-bottom-style: solid;
            border-right-style: solid;
            border-top-style: none;
            border-left-width: 1px;
            border-bottom-width: 1px;
            border-right-width: 1px;
            border-top-width: 0px;
        }

        .no-border-bottom {
            border-left-color: #000;
            border-right-color: #000;
            border-top-color: #000;
            border-left-style: solid;
            border-bottom-style: none;
            border-right-style: solid;
            border-top-style: solid;
            border-left-width: 1px;
            border-bottom-width: 0px;
            border-right-width: 1px;
            border-top-width: 1px;
        }

        .border-solid {
            border-left-color: #000;
            border-bottom-color: #000;
            border-right-color: #000;
            border-top-color: #000;
            border-left-style: solid;
            border-bottom-style: solid;
            border-right-style: solid;
            border-top-style: solid;
            border-left-width: 1px;
            border-bottom-width: 1px;
            border-right-width: 1px;
            border-top-width: 1px;
        }

        .page-content {
            font-size: 12px;
        }

        textarea {
            resize: none;
        }

        .center {
            text-align: center;
        }

        .right {
            text-align: right;
        }

        input[name=patient_status] {
            display: none;
        }

        label.radio {
            cursor: pointer;
        }

        input:checked+label.radio {
            /*        background: red; */
            border-radius: 5px;
            border: 2px solid #73AD21;
            padding: 4px;
        }

        .checked {
            text-decoration: line-through;
        }

        .unchecked {
            text-decoration: none;
        }

        #page-header {
            display: flex;
            align-content: center;
            justify-content: center;
            align-items: center;
        }

        #page-content {
            margin-bottom: 10px
        }

        .content-header td {
            padding: 12px 10px;
            font-size: 12px;
        }

        h1 {
            padding: 0px;
            margin: 0;
            font-size: 18px;
        }

        .center-text {
            text-align: center
        }

        th,
        td {
            padding: 10px
        }

        .head-report th {
            background: #f3f2f7 !important;
        }
    </style>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>

<body>
    <div id="page-header">
        <table>
            <tr>
                <th style="font-size: 24px">REPORT RECEIVE <br> by Receive No</th>
            </tr>
            <tr>
                <td style="text-align: center">{{ $sdate }} - {{ $edate }}</td>
            </tr>
        </table>
    </div>
    <div id="page-content">
        <table class="table " border="1">
            <thead>
                <tr class="head-report">
                    <th rowspan="2" class="center-text">No <span class="dividerHr"></span></th>
                    <th rowspan="2" class="center-text">Receive No<span class="dividerHr"></span></th>
                    <th rowspan="2" class="center-text">Receive Date<span class="dividerHr"></span></th>
                    <th rowspan="2" class="center-text">PIC<span class="dividerHr"></span></th>
                    <th colspan="4" class="heightHr center-text" style="vertical-align: middle">Product <span
                            class="dividerHr"></span>
                    </th>
                </tr>
                <tr class="head-report">
                    <th class="heightHr center-text" style="vertical-align: middle">Product Name <span
                            class="dividerHr"></span>
                    </th>
                    <th class="heightHr center-text" style="vertical-align: middle">Qty<span
                            class="dividerHr"></span>
                    </th>
                    <th class="heightHr center-text" style="vertical-align: middle">Unit Price<span
                            class="dividerHr"></span>
                    </th>
                    <th class="heightHr center-text" style="vertical-align: middle">Amount<span
                            class="dividerHr"></span>
                    </th>
                </tr>
            </thead>
            <tbody>
                <?php $total_qty = 0; $total_amount = 0; ?>
                @if (!empty($data))
                @foreach ($data as $item)
                <?php $rowspan = 1 + count($item['details']) ?>
                <div class="rt-invoice">
                    <tr>
                        <td rowspan="{{ $rowspan }}" class="center-text">
                            {{ $loop->iteration }}
                        </td>
                        <td rowspan="{{ $rowspan }}" class="center-text" style="vertical-align: middle">
                            {{ $item['code'] }}
                        </td>
                        <td rowspan="{{ $rowspan }}" class="center-text" style="vertical-align: middle">
                            {{ $item['receive_date'] }}
                        </td>
                        <td rowspan="{{ $rowspan }}" class="center-text" style="vertical-align: middle">
                            {{ $item['pic'] }}
                        </td>
                        <td colspan="2" style="vertical-align: middle; padding: 0px">

                        </td>
                        {{-- <td rowspan="3" class="center-text" style="vertical-align: middle;">
                            Rp 270.000
                        </td> --}}
                    </tr>
                    @foreach ($item['details'] as $rcv)
                    <?php $amount = str_replace(".", "", $rcv['amount']); ?>
                    <tr>
                        <td style="vertical-align:middle">{{ $rcv['product'] }}</td>
                        <td style="text-align:right; vertical-align:middle">{{ number_format($rcv['quantity']) }}</td>
                        <td style="text-align:right; vertical-align:middle">{{ number_format($rcv['unit_price']) }}</td>
                        <td style="text-align:right; vertical-align:middle">{{ number_format($amount) }}</td>
                    </tr>
                    <?php $total_qty += $rcv['quantity']; $total_amount += $amount; ?>
                    @endforeach
                </div>
                @endforeach
                @endif
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="5" style="text-align: right">Total</td>
                    <td class="center-text"><strong>{{ $total_qty }}</strong></td>
                    <td></td>
                    <td style="vertical-align: middle; text-align: right"><strong>{{ number_format($total_amount) }}</strong></td>
                </tr>
            </tfoot>
        </table>
    </div>
    {{-- <div id="page-footer">
        <p style="text-transform: uppercase">04-09-2023 12:00:00/{{ Auth::user()->name }}/{{
            Auth::user()->employee_id }}</p>
    </div> --}}

    <script>
        const d = new Date();
        document.getElementById("demo").innerHTML = d;
    </script>
</body>

</html>