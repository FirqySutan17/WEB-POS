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
<div class="modal fade" id="modal-edit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                            <th>NO. INVOICE</th>
                            <td class="detail_clear" id="invoice_no"></td>
                            <th>NO. RECEIPT</th>
                            <td class="detail_clear" id="receipt_no"></td>
                        </tr>
                        <tr>
                            <th>KASIR</th>
                            <td class="detail_clear" id="cashier_name"></td>
                            <th>TANGGAL</th>
                            <td class="detail_clear" id="transaction_date"></td>
                        </tr>
                        <tr>
                            <th>PEMBAYARAN</th>
                            <td class="detail_clear" id="payment_method"></td>
                            <th>STATUS</th>
                            <td class="detail_clear" id="status"></td>
                        </tr>
                        <tr>
                            <th colspan="4" class="center-text">TRANSAKSI</th>
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
                            <th>Produk</th>
                            <th class="center-text">Harga</th>
                            <th class="center-text">(%)</th>
                            <th class="center-text">Qty</th>
                            <th style="text-align: right">Total</th>
                        </tr>
                    </tbody>

                </table>
                <table class="modal-table-total">
                    <tbody>
                        <tr>
                            <th style="width: 75%">SUB TOTAL</th>
                            <td class="footer_clear" id="sub_price" style="width: 25%;text-align: right">Rp 100.000</td>
                        </tr>
                        <tr>
                            <th style="width: 75%">(%)</th>
                            <td class="footer_clear" id="discount" style="width: 25%;text-align: right">Rp 100.000</td>
                        </tr>
                        <tr>
                            <th style="width: 75%">VAT</th>
                            <td class="footer_clear" id="vat" style="width: 25%;text-align: right">Rp 100.000</td>
                        </tr>
                        <tr>
                            <th style="width: 75%">GRAND TOTAL</th>
                            <td class="footer_clear" id="grand_total" style="width: 25%;text-align: right">Rp 100.000</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div id="loader" class="lds-dual-ring display-none overlay"></div>

<script>
    function clear_detail() {
        $(".detail_clear").text("");
        $(".row_clear").remove();
        $(".footer_clear").text(formatRupiah("0"));
    }

    function formatRupiah(angka, prefix)
    {
        var number_string = angka.replace(/[^,\d]/g, '').toString(),
            split    = number_string.split(','),
            sisa     = split[0].length % 3,
            rupiah     = split[0].substr(0, sisa),
            ribuan     = split[0].substr(sisa).match(/\d{3}/gi);
            
        if (ribuan) {
            separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }
        
        rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
        return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
    }

    function fill_transaction(transaction) {
        let vat_amount  = parseInt({{ config('app.vat_amount') }});
        let sub_price   = parseInt(transaction.sub_price);
        let vat         = sub_price * (vat_amount / 100);
        let grand_total = sub_price + vat;

        $('#invoice_no').text(transaction.invoice_no);
        $('#receipt_no').text(transaction.receipt_no);
        $('#cashier_name').text(transaction.user.name);
        $('#transaction_date').text(transaction.trans_date);
        $('#payment_method').text(transaction.payment_method);
        $('#status').text(transaction.status);

        $('#sub_price').text(formatRupiah(transaction.sub_price.toString()));
        $('#vat').text(formatRupiah(vat.toString()));
        $('#grand_total').text(formatRupiah(grand_total.toString()));
    }

    function fill_transaction_detail(transaction_detail) {
        let html = '';
        let total_discount_amount = 0;
        $.each(transaction_detail, function(i, item) {
            let html_price = formatRupiah(item.price.toString());
            let total_price = item.price * item.quantity;
            let discount_amount = 0;
            if (item.discount > 0) {
                discount_amount = item.basic_price - item.price;
                total_discount_amount += discount_amount;
                html_price = `
                    <s>${formatRupiah(item.basic_price.toString())}</s>
                    <br/>
                    ${formatRupiah(item.price.toString())}
                `;
            }
            html += `<tr class="row_clear">`;
                html += `<td>${i + 1}</td>`;
                html += `<td>${item.code} - ${item.name}</td>`;
                html += `<td>${html_price}</td>`;
                html += `<td>${item.discount}</td>`;
                html += `<td>${item.quantity}</td>`;
                html += `<td>${formatRupiah(total_price.toString())}</td>`;
            html += `</tr>`;
        });
        $('#discount').text(formatRupiah(total_discount_amount.toString()));
        $('#transaction_detail').append(html);
    }

    //button create post event
    $('.btn-show-post').click(function () {
        let url_show = $(this).data('url');
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
                $('#modal-edit').modal('show');
            },
            complete: function () {
                $('#loader').addClass('display-none')
            },
        });
    });

</script>