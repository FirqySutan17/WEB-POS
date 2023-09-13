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
                <button onclick="close_modal_product()" type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="modal-table">
                    <thead>
                        <tr>
                            <th>BARCODE</th>
                            <td class="detail_clear" id="detail_code"></td>
                            <th>PRODUCT</th>
                            <td class="detail_clear" id="detail_name"></td>
                        </tr>
                        <tr>
                            <th>STORE PRICE</th>
                            <td class="detail_clear" id="detail_price_store"></td>
                            <th>STORE DISCOUNT</th>
                            <td class="detail_clear" id="detail_discount_store"></td>
                        </tr>
                        <tr>
                            <th>OL-SHOP PRICE</th>
                            <td class="detail_clear" id="detail_price_olshop"></td>
                            <th>OL-SHOP DISCOUNT</th>
                            <td class="detail_clear" id="detail_discount_olshop"></td>
                        </tr>
                        <tr>
                            <th>CATEGORY</th>
                            <td class="detail_clear" id="detail_categories"></td>
                            <th>Types</th>
                            <td class="detail_clear" id="detail_types"></td>
                        </tr>
                        <tr>
                            <th colspan="4" class="center-text">PRICE LOG</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
                <table class="modal-table-total">
                    <thead>
                        <tr>
                            <th class="center-text">Date</th>
                            <th class="center-text">Store Price</th>
                            <th class="center-text">Olshop Price</th>
                            <th class="center-text">PPN</th>
                        </tr>
                    </thead>
                    <tbody id="price_logs">
                        {{-- @if (count($price_logs))
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
                        @endif --}}
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
                let product = response.product;
                let types = response.types;
                let price_logs = response.price_logs;
                // //fill data to form
                fill_product(product);
                fill_types(types);
                fill_price_logs(price_logs);

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
        $("#price_logs").empty();
    }
    function fill_product(product) {
        $('#detail_code').text(product.code);
        $('#detail_name').text(product.name);
        $('#detail_price_store').text(product.price_store);
        $('#detail_price_olshop').text(product.price_olshop);
        $('#detail_discount_store').text(product.discount_store);
        $('#detail_categories').text(product.categories);
    }

    function fill_types(types) {
        let html = '';
        if (types.length > 0) {
            
            $.each(types, function(i, item) {
                if (i == 0) {
                    html = item.categories;
                } else {
                    html += ", " + item.categories;
                }
            });
        }
        $('#detail_types').text(html);
    }

    function fill_price_logs(price_logs) {
        let html = '';
        $.each(price_logs, function(i, item) {
            html += `<tr class="row_clear">`;
                html += `<td class="center-text" style="width: 5%">${item.created_at}</td>`;
                html += `<td>${item.price_store} (${item.discount_store == null ? 0 : item.discount_store} %)</td>`;
                html += `<td>${item.price_olshop} (${item.discount_olshop == null ? 0 : item.discount_olshop} %)</td>`;
                html += `<td class="center-text" style="width: 5%">${item.is_vat == 1 ? "YES" : "NO"}</td>`;
            html += `</tr>`;
        });
        $('#price_logs').html(html);
    }
</script>