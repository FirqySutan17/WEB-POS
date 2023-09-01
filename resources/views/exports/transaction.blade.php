<table class="table table-bordered table-striped table-hover">
    <thead>
        <tr class="head-report">
            <th class="center-text">No <span class="dividerHr"></span></th>
            <th class="center-text">Tanggal<span class="dividerHr"></span></th>
            <th class="heightHr" style="vertical-align: middle">No. Invoice <span class="dividerHr"></span>
            </th>
            <th class="heightHr" style="vertical-align: middle">Nama Kasir <span class="dividerHr"></span>
            </th>
            <th class="heightHr center-text">Metode Pembayaran <span class="dividerHr"></span></th>
            <th class="center-text">Total Harga <span class="dividerHr"></span></th>
        </tr>
    </thead>
    <tbody>
        <?php $grand_total = 0; ?>
        @if (!empty($data))
            @foreach ($data as $item)
            <?php $grand_total += $item->total_price; ?>
                <tr>
                    <td class="center-text">{{ $loop->iteration }}</td>

                    <td class="center-text" style="vertical-align: middle">
                        {{ date('d-m-Y',strtotime($item->trans_date)) }}
                    </td>
                    <td style="vertical-align: middle">
                        {{ $item->invoice_no }}
                    </td>
                    <td style="vertical-align: middle">
                        {{ $item->name." ( ".$item->employee_id." )" }}
                    </td>
                    <td class="center-text" style="vertical-align: middle">
                        {{ $item->payment_method }}
                    </td>
                    <td class="center-text" style="vertical-align: middle;">
                        @currency($item->total_price)
                    </td>
                </tr>
            @endforeach
        @endif
    </tbody>
    <tfoot>
        <tr class="head-report">
            <th colspan="5" class="heightHr right-text">Grand Total <span class="dividerHr"></span></th>
            <th class="center-text">@currency($grand_total) <span class="dividerHr"></span></th>
        </tr>
    </tfoot>
</table>