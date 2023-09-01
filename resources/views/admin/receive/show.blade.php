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
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="modal-table">
                    <thead>
                        <tr>
                            <th>KODE RECEIVE</th>
                            <td>#</td>
                            <th>TANGGAL/WAKTU</th>
                            <td>#</td>
                        </tr>
                        <tr>
                            <th>PENERIMA</th>
                            <td></td>
                            <th>PENGIRIM</th>
                            <td></td>
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
                    <tbody>
                        <tr>
                            <th class="center-text">No.</th>
                            <th>Produk</th>
                            <th class="center-text">Qty</th>
                            <th style="text-align: right">Total</th>
                        </tr>

                        <tr>
                            <td class="center-text" style="width: 5%">1</td>
                            <td style="width: 90%">LOREM IPSUM DOLOR SIT AMET</td>
                            <td class="center-text" style="width: 5%">10</td>
                        </tr>

                        <tr>
                            <td class="center-text" style="width: 5%">2</td>
                            <td style="width: 90%">LOREM IPSUM DOLOR SIT AMET</td>
                            <td class="center-text" style="width: 5%">10</td>
                        </tr>

                        <tr>
                            <td class="center-text" style="width: 5%">3</td>
                            <td style="width: 90%">LOREM IPSUM DOLOR SIT AMET</td>
                            <td class="center-text" style="width: 5%">10</td>
                        </tr>
                    </tbody>

                </table>
            </div>
        </div>
    </div>
</div>

<div id="loader" class="lds-dual-ring display-none overlay"></div>

<script>
    //button create post event
    $('.btn-show-receive').click(function () {

        // let invoice_no = $(this).data('id');
        let url_show = $(this).data('url');
        // url_show.replace(":id", invoice_no);
        console.log(url_show);
        //fetch detail post with ajax
        $.ajax({
            url: url_show,
            type: "GET",
            cache: false,
            beforeSend: function () {
                $('#loader').removeClass('display-none')
            },
            success:function(response){
                console.log(response);
                //fill data to form
                $('#invoice_no').val(response.receive.receive_code);

                //open modal
                $('#modal-receive').modal('show');
            },
            complete: function () {
                $('#loader').addClass('display-none')
            },
        });
    });

</script>