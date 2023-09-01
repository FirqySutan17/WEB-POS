<table class="table table-bordered table-striped table-hover">
    <thead>
        <tr class="head-report">
            <th rowspan="2">No</th>
            <th rowspan="2">No. Invoice</th>
            <th rowspan="2">Tangga</th>
            <th rowspan="2">Kasir</th>
            <th rowspan="2">Pembayaran</th>
            <th colspan="4">Item </th>
        </tr>
        <tr class="head-report">
            <th>Produk</th>
            <th>Harga/@</th>
            <th>Qty</th>
            <th>(%)</th>
        </tr>
    </thead>
    <tbody>
        @if (!empty($data))
            @foreach ($data as $item)
            <?php $rowspan = 1 + count($item['products']) ?>
                <tr>
                    <td rowspan="{{ $rowspan }}">
                        {{ $loop->iteration }}
                    </td>
                    <td rowspan="{{ $rowspan }}">
                        {{ $item['invoice_no'] }}
                    </td>
                    <td rowspan="{{ $rowspan }}">
                        {{ $item['trans_date'] }}
                    </td>
                    <td rowspan="{{ $rowspan }}">
                        {{ $item['pic'] }}
                    </td>
                    <td rowspan="{{ $rowspan }}">
                        {{ $item['payment_method'] }}
                    </td>
                    <td colspan="4"></td>
                </tr>
                @foreach ($item['products'] as $product)
                    <tr>
                        <td>
                            {{ $product['name'] }}
                        </td>
                        <td> 
                            @if ($product['discount'] > 0)
                                <s> @currency($product['price'])</s> <br>
                            @endif
                            @currency($product['price'])
                        </td>
                        <td>{{ $product['quantity'] }}</td>
                        <td>{{ $product['discount'] }}</td>
                    </tr>
                @endforeach
            @endforeach
        @endif
    </tbody>
</table>