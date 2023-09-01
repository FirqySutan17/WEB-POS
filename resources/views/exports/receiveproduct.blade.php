<table class="table table-bordered table-hover">
    <thead>
        <tr class="head-report">
            <th rowspan="2" class="center-text">No <span class="dividerHr"></span></th>
            <th rowspan="2" class="center-text">Product <span class="dividerHr"></span></th>
            <th colspan="5" class="heightHr center-text">Receive <span class="dividerHr"></span>
            </th>
        </tr>
        <tr class="head-report">
            <th class="heightHr center-text">Qty<span
                class="dividerHr"></span>
            </th>
            <th class="center-text">PIC<span class="dividerHr"></span></th>
            <th class="center-text">Delivery No<span class="dividerHr"></span></th>
            <th class="center-text">Receive Date<span class="dividerHr"></span></th>
            <th class="center-text">Receive Code<span class="dividerHr"></span></th>
        </tr>
    </thead>
    <tbody>
        @if (!empty($data))
            @foreach ($data as $item)
            <?php $rowspan = 1 + count($item['details']) ?>
                <tr>
                    <td rowspan="{{ $rowspan }}" class="center-text">
                        {{ $loop->iteration }}
                    </td>
                    <td rowspan="{{ $rowspan }}" class="center-text">
                        {{ $item['product'] }}
                    </td>
                    <td colspan="5">

                    </td>
                </tr>
                @foreach ($item['details'] as $rcv)
                    <tr>
                        <td class="center-text">{{ $rcv['quantity'] }}</td>
                        <td class="center-text">{{ $rcv['pic'] }}</td>
                        <td class="center-text">{{ $rcv['delivery_no'] }}</td>
                        <td class="center-text">{{ $rcv['receive_date'] }}</td>
                        <td class="center-text">{{ $rcv['receive_code'] }}</td>
                    </tr>
                @endforeach
            @endforeach
        @endif
    </tbody>
</table>