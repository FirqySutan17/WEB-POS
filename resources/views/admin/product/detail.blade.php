<style>
    .display-none {
        display: none !important;
    }

    .overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100vh;
        background: rgba(0, 0, 0, .8);
        z-index: 999;
        opacity: 1;
        transition: all 0.5s;
    }


    .lds-dual-ring {
        display: inline-block;

    }

    .lds-dual-ring:after {
        content: " ";
        display: block;
        width: 64px;
        height: 64px;
        margin: 5% auto;
        border-radius: 50%;
        border: 6px solid #fff;
        border-color: #fff transparent #fff transparent;
        animation: lds-dual-ring 1.2s linear infinite;

    }

    @keyframes lds-dual-ring {
        0% {
            transform: rotate(0deg);
        }

        100% {
            transform: rotate(360deg);
        }
    }

    #getDataBtn {
        background: #e2e222;
        border: 1px solid #e2e222;
        padding: 10px 20px;
    }

    .modal-dialog.modal-lg {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%) !important;
        width: 100%;
    }

    .modal-table {
        width: 100%
    }

    .modal-table th,
    .modal-table td {
        padding: 10px;
        border: 1px solid #000;
        width: 25%
    }

    .modal-table td {
        background-color: #fff !important;
        border: 1px solid #000;
    }

    .modal-table-detail {
        width: 100%
    }

    .modal-table-detail th,
    .modal-table-detail td {
        padding: 10px;
        border: 1px solid #000;
    }

    .modal-table-detail td {
        background-color: #fff !important;
        border: 1px solid #000;
    }

    .modal-table-total {
        width: 100%
    }

    .modal-table-total th,
    .modal-table-total td {
        padding: 10px;
        border: 1px solid #000;
    }

    .modal-table-total td {
        background-color: #fff !important;
        border: 1px solid #000;
    }
</style>

<!-- Modal -->
<div class="modal" id="modal-product" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">DETAIL TRANSAKSI</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="modal-table">
                    <thead>
                        <tr>
                            <th>BARCODE</th>
                            <td class="detail_clear">{{ $product->code }}</td>
                            <th>PRODUCT</th>
                            <td class="detail_clear">{{ $product->name }}</td>
                        </tr>
                        <tr>
                            <th>STORE PRICE</th>
                            <td class="detail_clear">{{ number_format($product->price_store) }}</td>
                            <th>STORE DISCOUNT</th>
                            <td class="detail_clear">{{ number_format($product->discount_store) }}</td>
                        </tr>
                        <tr>
                            <th>OL-SHOP PRICE</th>
                            <td class="detail_clear">{{ number_format($product->price_olshop) }}</td>
                            <th>OL-SHOP DISCOUNT</th>
                            <td class="detail_clear">{{ number_format($product->discount_olshop) }}</td>
                        </tr>
                        <tr>
                            <th>CATEGORY</th>
                            <td class="detail_clear">{{ $product->categories }}</td>
                            <th>Types</th>
                            <td class="detail_clear">
                                @foreach ($product->types as $category)
                                <span>{{ $category->categories }}</span>
                                @endforeach
                            </td>
                        </tr>
                        <tr>
                            <th colspan="4" class="center-text">PRICE LOG</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
                <table class="modal-table-detail">
                    <thead>

                    </thead>
                    <tbody id="transaction_detail">
                        <tr>
                            <th class="center-text">No.</th>
                            <th>Date</th>
                            <th class="center-text">Store price</th>
                            <th class="center-text">Olshop price</th>
                        </tr>
                    </tbody>

                </table>
                <table class="modal-table-total">
                    <tbody>
                        @if (count($price_logs))
                        @forelse ($price_logs as $plog)
                        <tr>
                            <td style="width: 5%;" class="center-text">{{ $loop->iteration }}</td>
                            <td style="width: 25%; vertical-align: middle">{{ $plog->created_at }}</td>
                            <td style="width: 35%; vertical-align: middle">Rp {{ number_format($product->price_store) }}
                                ( {{ $product->discount_store }} %)</td>
                            <td style="width: 35%; vertical-align: middle"> Rp {{ number_format($product->price_olshop)
                                }} ( {{ $product->discount_olshop }} %)</td>
                        </tr>
                        @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div id="loader" class="lds-dual-ring display-none overlay"></div>

<script>
    //button create post event
    $('.btn-show-product').click(function () {
        let url_show = $(this).data('url');
        console.log(url_show);
        //fetch detail post with ajax
        $.ajax({
            url: url_show,
            type: "GET",
            cache: false,
            beforeSend: function () {
                clear_detail();
                $('#loader').removeClass('display-none')
            },
            success:function(response){
                console.log(response);
                let transaction = response.transaction;
                let transaction_detail = response.details;
                //fill data to form
                fill_transaction(transaction);
                fill_transaction_detail(transaction_detail);

                //open modal
                $('#modal-product').modal('show');
            },
            complete: function () {
                $('#loader').addClass('display-none')
            },
        });
    });

</script>

<script>
    function close_modal_product() {
        $("#modal-product").modal('hide');
    }

    function clear_detail() {
        $(".detail_clear").text("");
        $(".row_clear").remove();
    }
    function fill_product(product) {
        $('#code').text(product.code);
        $('#namedate').text(product.created_at);
        $('#delivery_no').text(product.delivery_no);
        $('#pic').text(product.user.name);
        $('#sender').text(sender);
    }

    function fill_product_detail(product_detail) {
        let html = '';
        $.each(product_detail, function(i, item) {
            html += `<tr class="row_clear">`;
                html += `<td class="center-text" style="width: 5%">${i + 1}</td>`;
                html += `<td>${item.code} - ${item.name}</td>`;
                html += `<td class="center-text" style="width: 5%">${item.quantity}</td>`;
            html += `</tr>`;
        });
        $('#product_detail').append(html);
    }
    //button create post event
    $('.btn-show-product').click(function () {
        let url_show = $(this).data('url');
        console.log(url_show);
        //fetch detail post with ajax
        $.ajax({
            url: url_show,
            type: "GET",
            cache: false,
            beforeSend: function () {
                clear_detail();
                $('#loader').removeClass('display-none')
            },
            success:function(response){
                console.log(response);
                let product = response.product;
                let product_detail = response.details;
                //fill data to form
                fill_product(product);
                fill_product_detail(product_detail);

                //open modal
                $('#modal-product').modal('show');
            },
            complete: function () {
                $('#loader').addClass('display-none')
            },
        });
    });
</script>