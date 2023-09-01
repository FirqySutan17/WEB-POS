<table class="table table-bordered table-hover">
    <thead>
        <tr class="head-report">
            <th rowspan="2" class="center-text">No <span class="dividerHr"></span></th>
            <th rowspan="2" class="center-text">Receive Code<span class="dividerHr"></span></th>
            <th rowspan="2" class="center-text">Receive Date<span class="dividerHr"></span></th>
            <th rowspan="2" class="center-text">Delivery No<span class="dividerHr"></span></th>
            <th rowspan="2" class="center-text">PIC<span class="dividerHr"></span></th>
            <th colspan="2" class="heightHr center-text">Product <span class="dividerHr"></span>
            </th>
        </tr>
        <tr class="head-report">
            <th class="heightHr center-text">Product Name <span
                    class="dividerHr"></span>
            </th>
            <th class="heightHr center-text">Qty<span
                class="dividerHr"></span>
            </th>
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
                        {{ $item['code'] }}
                    </td>
                    <td rowspan="{{ $rowspan }}" class="center-text">
                        {{ $item['receive_date'] }}
                    </td>
                    <td rowspan="{{ $rowspan }}" class="center-text">
                        {{ $item['delivery_no'] }}
                    </td>
                    <td rowspan="{{ $rowspan }}" class="center-text">
                        {{ $item['pic'] }}
                    </td>
                    <td colspan="2">

                    </td>
                </tr>
                @foreach ($item['details'] as $rcv)
                    <tr>
                        <td class="center-text">{{ $rcv['product'] }}</td>
                        <td class="center-text">{{ $rcv['quantity'] }}</td>
                    </tr>
                @endforeach
            @endforeach
        @endif
    </tbody>
</table>