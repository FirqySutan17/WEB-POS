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
<div class="modal fade" id="modal-receive" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">DETAIL TRANSAKSI</h5>
                <button onclick="close_modal_receive()" type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="modal-table">
                    <thead>
                        <tr>
                            <th>KODE RECEIVE</th>
                            <td class="detail_clear" id="receive_code">#</td>
                            <th>TANGGAL/WAKTU</th>
                            <td class="detail_clear" id="receive_date">#</td>
                        </tr>
                        <tr>
                            <th>PENERIMA</th>
                            <td class="detail_clear" id="pic"></td>
                            <th>PENGIRIM</th>
                            <td class="detail_clear" id="sender"></td>
                        </tr>
                        <tr>
                            <th>DELIVERY NO</th>
                            <td colspan="3" class="detail_clear" id="delivery_no">#</td>
                        </tr>
                        <tr>
                            <th colspan="4" class="center-text">RECEIVE</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
                <table class="modal-table-detail">
                    <thead>

                    </thead>
                    <tbody id="receive_detail">
                        <tr>
                            <th class="center-text">No.</th>
                            <th>Produk</th>
                            <th class="center-text">Qty</th>
                            <th class="center-text">Unit Price</th>
                            <th class="center-text">Amount</th>
                        </tr>
                    </tbody>

                </table>
            </div>
        </div>
    </div>
</div>

<div id="loader" class="lds-dual-ring display-none overlay"></div>

<script>
    function close_modal_receive() {
        $("#modal-receive").modal('hide');
    }

    function clear_detail() {
        $(".detail_clear").text("");
        $(".row_clear").remove();
    }
    function fill_receive(receive) {
        let sender = "From Warehouse";
        if (receive.is_warehouse == 0 || receive.driver != null) {
            sender = receive.driver + " | " + receive.driver_phone + " | " + receive.plat_no;
        }
        $('#receive_code').text(receive.receive_code);
        $('#receive_date').text(receive.created_at);
        $('#delivery_no').text(receive.delivery_no);
        $('#pic').text(receive.user.name);
        $('#sender').text(sender);
    }

    function fill_receive_detail(receive_detail) {
        let html = '';
        $.each(receive_detail, function(i, item) {
            html += `<tr class="row_clear">`;
                html += `<td class="center-text" style="width: 5%">${i + 1}</td>`;
                html += `<td>${item.code} - ${item.name}</td>`;
                html += `<td class="center-text" style="width: 5%">${item.quantity}</td>`;
                html += `<td class="center-text" style="width: 5%">${item.unit_price}</td>`;
                html += `<td class="center-text" style="width: 5%">${item.amount}</td>`;
            html += `</tr>`;
        });
        $('#receive_detail').append(html);
    }
    //button create post event
    $('.btn-show-receive').click(function () {
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
                let receive = response.receive;
                let receive_detail = response.details;
                //fill data to form
                fill_receive(receive);
                fill_receive_detail(receive_detail);

                //open modal
                $('#modal-receive').modal('show');
            },
            complete: function () {
                $('#loader').addClass('display-none')
            },
        });
    });

</script>