<table class="table table-bordered table-striped table-hover">
    <thead>
        <tr class="head-report">
            <th rowspan="2" class="center-text">No</th>
            <th rowspan="2" class="heightHr center-text">Produk</th>
            <th colspan="5" class="heightHr center-text">Detail</th>
        </tr>
        <tr class="head-report">
            <th class="heightHr center-text">Harga/@</th>
            <th class="heightHr center-text">Qty</th>
            <th class="heightHr center-text">(%)</th>
            <th class="heightHr center-text">Tanggal</th>
            <th class="heightHr center-text">No Invoice</th>
        </tr>
    </thead>
    <tbody>
        @if (!empty($data))
            @foreach ($data as $item)
                <?php $rowspan = 1 + count($item['details']); ?>
                <tr>
                    <td rowspan="{{ $rowspan }}" class="center-text">{{ $loop->iteration }}</td>
                    <td rowspan="{{ $rowspan }}" class="center-text">{{ $item['code']." | ".$item['name'] }}</td>
                    <td colspan="5">

                    </td>
                </tr>
                @foreach ($item['details'] as $inv)
                    <tr>
                        <td class="center-text"> 
                            @if ($inv['discount'] > 0)
                                <s> @currency($inv['price'])</s> <br>
                            @endif
                            @currency($inv['price'])
                        </td>
                        <td class="center-text">{{ $inv['quantity'] }}</td>
                        <td class="center-text">{{ $inv['discount'] }}</td>
                        <td class="center-text">{{ $inv['trans_date'] }}</td>
                        <td class="center-text">{{ $inv['invoice_no'] }}</td>
                    </tr>
                @endforeach
            @endforeach
        @endif
    </tbody>
</table>