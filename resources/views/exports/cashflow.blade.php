<html>

<head>
    <title>Report Cash Flow</title>
</head>

<body>
    <div id="page-content">
        <table class="table" border="1">
            <thead>
                <tr class="head-report">
                    <th rowspan="2">No <span></span></th>
                    <th rowspan="2">Tanggal<span></span></th>
                    <th rowspan="2" style="vertical-align: middle">Penanggung Jawab <span></span></th>
                    <th rowspan="2">Deskripsi<span></span></th>
                    <th colspan="2">Amount<span></span></th>
                </tr>
                <tr class="head-report">
                    <th>Bank<span></span></th>
                    <th>Cash<span></span></th>
                </tr>
            </thead>
            <?php $total_cash = 0; $total_bank = 0; ?>
            <tbody>
                @if (!empty($data))
                    @foreach ($data as $item)
                        <?php
                            $category = $item->category;
                            $bank = $item->bank_in - $item->bank_out;
                            $cash = $item->cash_in - $item->cash_out;
                            
                            $total_cash += $cash;
                            $total_bank += $bank;

                            $cash_2 = 0;
                            if ($category == 'MODAL_IN') {
                                $cash   = 0 - $item->cash_out;
                                $cash_2 = $item->cash_in - 0;
                            } elseif ($category == 'MODAL_OUT') {
                                $cash_2   = 0 - $item->cash_out;
                                $cash = $item->cash_in - 0;
                            }
                        ?>
                        <tr>
                            <td style="width:100%">{{ $loop->iteration }}</td>
                            <td style="width:100%">{{ date('Y-m-d H:i', strtotime($item->cash_date)) }}</td>
                            <td style="width:100%">{{ $item->approved_by }}</td>
                            <td style="width:100%">{{ $item->description }}</td>
                            <td style="width:100%;text-align:right;color:{{ $bank > 0 ? 'green' : 'red' }}">
                                <span>{{ number_format($bank) }}</span>
                            </td>
                            <td style="width:100%;text-align:right;color:{{ $cash > 0 ? 'green' : 'red' }}">
                                <span>{{ number_format($cash) }}</span>
                            </td>
                        </tr>
                        @if (in_array($category, ['MODAL_IN', 'MODAL_OUT']))
                        <tr>
                            <td style="width:100%">{{ $loop->iteration }}</td>
                            <td style="width:100%">{{ date('Y-m-d H:i', strtotime($item->cash_date)) }}</td>
                            <td style="width:100%">{{ $item->approved_by }}</td>
                            <td style="width:100%">{{ $item->description }}</td>
                            <td style="width:100%;text-align:right;color:{{ $bank > 0 ? 'green' : 'red' }}">
                                <span>{{ number_format($bank) }}</span>
                            </td>
                            <td style="width:100%;text-align:right;color:{{ $cash_2 > 0 ? 'green' : 'red' }}">
                                <span>{{ number_format($cash_2) }}</span>
                            </td>
                        </tr>
                        @endif
                    @endforeach
                @endif
            </tbody>
            <tfoot>
                <tr>
                    <th style="text-align:right" colspan="4">Total</th>
                    <th style="text-align:right">{{ number_format($total_bank) }}</th>
                    <th style="text-align:right">{{ number_format($total_cash) }}</th>
                </tr>
                <tr>
                    <th style="text-align:right" colspan="4">Saldo Akhir</th>
                    <th style="text-align:right" colspan="2">{{ number_format($total_bank + $total_cash) }}</th>
                </tr>
            </tfoot>
        </table>
    </div>
</body>

</html>