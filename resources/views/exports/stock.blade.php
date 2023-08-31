<table class="table table-striped table-hover">
    <thead>
        <tr class="head-report">
            <th class="center-text">No <span class="dividerHr"></span></th>
            <th>Item <span class="dividerHr"></span></th>
            <th class="heightHr center-text">Begin <span class="dividerHr"></span></th>
            <th class="heightHr center-text">In <span class="dividerHr"></span></th>
            <th class="heightHr center-text">Out <span class="dividerHr"></span></th>
            <th class="heightHr center-text">End <span class="dividerHr"></span></th>
        </tr>
    </thead>
    <tbody>
        @if (!empty($data))
        @foreach ($data as $item)
        <tr>
            <td style="width: 5%;" class="center-text">{{ $loop->iteration }}</td>
            <td style="width: 50%; vertical-align: middle">
                {{ $item->name." - ".$item->code }}
            </td>
            <td class="center-text" style="width: 10%; vertical-align: middle">{{
                number_format($item->qty_begin) }}</td>
            <td class="center-text" style="width: 10%; vertical-align: middle">
                {{ number_format($item->qty_in) }}
            </td>
            <td class="center-text" style="width: 10%; vertical-align: middle">
                {{ number_format($item->qty_out) }}
            </td>
            <td class="center-text" style="width: 10%; vertical-align: middle">
                {{ number_format($item->qty_end) }}
            </td>
        </tr>
        @endforeach
        @endif

    </tbody>
</table>