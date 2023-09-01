<table class="table table-bordered table-hover">
    <thead>
        <tr class="head-report">
            <th rowspan="2" class="center-text">No <span class="dividerHr"></span></th>
            <th rowspan="2" class="center-text">Tanggal<span class="dividerHr"></span></th>
            <th colspan="5" class="heightHr center-text">Receive <span
                    class="dividerHr"></span>

            </th>
        </tr>
        <tr class="head-report">
            <th class="heightHr center-text">Receive No <span
                    class="dividerHr"></span>
            </th>
            <th class="heightHr center-text">Delivery No<span
                class="dividerHr"></span>
            </th>
            <th class="heightHr center-text">PIC<span
                    class="dividerHr"></span>
            </th>
            <th class="heightHr center-text">Total Product<span
                    class="dividerHr"></span>
            </th>
            <th class="heightHr center-text">Total Qty<span
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
                        {{ $item['receive_date'] }}
                    </td>

                    <td colspan="5">

                    </td>
                </tr>
                @foreach ($item['details'] as $rcv)
                    <tr>
                        <td>{{ $rcv['code'] }}</td>
                        <td>{{ $rcv['delivery_no'] }}</td>
                        <td class="center-text">{{ $rcv['pic'] }}</td>
                        <td class="center-text">{{ $rcv['total_product'] }}</td>
                        <td class="center-text">{{ $rcv['total_qty'] }}</td>
                    </tr>
                @endforeach
            @endforeach
        @endif
    </tbody>
</table>