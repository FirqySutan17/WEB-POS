@extends('layouts.admin.master')

@section('title')
CMS | Transaction
@endsection

@push('css-internal')
<style>
    .page-wrapper.compact-wrapper .page-body-wrapper .page-body {
        background: #a12a2f !important;
    }

    .wrapper-customer {
        height: 100vh;
        display: grid;
        grid-template-columns: repeat(8, 1fr);
        width: 100%;
    }

    .wrapper-customer .box {
        grid-column: span 4;
    }

    .card {
        height: 100% !important;
    }

    .card-header {
        height: 10% !important;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #ff5c639d !important;
        color: #fff;
        font-weight: 700
    }

    .card-body {
        height: 80% !important;
        background: #fff !important;
        padding: 10px 20px !important;
    }

    .card-footer {
        background: #ff5c639d !important;
        height: 10% !important;
        margin: auto;
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
        color: #fff;
        padding: 0px 40px !important;
    }

    td,
    th,
    tr,
    table {
        border-top: 1px solid transparent;
        border-collapse: collapse;
        width: 100%
    }

    /* td.description,
        th.description {
            width: 75px;
            max-width: 75px;
        }

        td.quantity,
        th.quantity {
            width: 40px;
            max-width: 40px;
            word-break: break-all;
        }

        td.price,
        th.price {
            width: 40px;
            max-width: 40px;
            word-break: break-all;
        } */

    .centered {
        text-align: center;
        align-content: center;
    }

    .ticket {
        width: 302px;
        max-width: 302px;
    }

    img {
        max-width: 100%;
        width: 100%;
    }

    .add-note td {
        width: 50%
    }

    hr.dotted {
        border-top: 1px dashed black;
    }

    .item-order {
        width: 100%
    }

    .item-order tr {
        width: 100%
    }

    .item-order td:nth-child(1) {
        width: 70%;
    }

    .item-order td:nth-child(2) {
        width: 30%;
        text-align: right
    }

    thead,
    tbody,
    tfoot,
    th {
        background: transparent !important;
    }

    td {
        padding: 10px 0px !important;
        border-bottom: 1px solid #000 !important;
    }

    .carousel-wrap {
        height: 70% !important
    }

    .carousel-item img {
        height: 528px;
        object-fit: cover;
    }
</style>
@endpush

@section('content')
<div class="container" style="max-width: 1078px">
    <div class="wrapper-customer">
        <div class="box">
            <div class="card">
                <div class="card-header">
                    <h2 style="text-align: center">MEAT STORE</h2>
                </div>
                <div class="card-body">
                    <div class="list-product" style="height: 100%; overflow-y: auto">
                        <table class="item-order">
                            <tbody>
                                <tr>
                                    <td>
                                        <p style="font-weight: 600; margin-bottom: 0px; font-size: 16px">Lorem Ipsum
                                            Dolor
                                        </p>
                                        <p>3x &nbsp; @10.000 &nbsp; &nbsp; Disc 5%</p>
                                    </td>
                                    <td>
                                        <p style="margin-bottom: 0px; font-size: 16px">Rp 30.000</p>
                                        <p>(- Rp 1.500)</p>
                                    </td>
                                </tr>

                                <tr>
                                    <td>
                                        <p style="font-weight: 600; margin-bottom: 0px; font-size: 16px">Lorem Ipsum
                                            Dolor
                                        </p>
                                        <p>3x &nbsp; @10.000 &nbsp; &nbsp;</p>
                                    </td>
                                    <td>
                                        <p style="margin-bottom: 0px; font-size: 16px">Rp 30.000</p>

                                    </td>
                                </tr>

                                <tr>
                                    <td>
                                        <p style="font-weight: 600; margin-bottom: 0px; font-size: 16px">Lorem Ipsum
                                            Dolor
                                        </p>
                                        <p>3x &nbsp; @10.000 &nbsp; &nbsp;</p>
                                    </td>
                                    <td>
                                        <p style="margin-bottom: 0px; font-size: 16px">Rp 30.000</p>

                                    </td>
                                </tr>

                                <tr>
                                    <td>
                                        <p style="font-weight: 600; margin-bottom: 0px; font-size: 16px">Lorem Ipsum
                                            Dolor
                                        </p>
                                        <p>3x &nbsp; @10.000 &nbsp; &nbsp;</p>
                                    </td>
                                    <td>
                                        <p style="margin-bottom: 0px; font-size: 16px">Rp 30.000</p>

                                    </td>
                                </tr>

                                <tr>
                                    <td>
                                        <p style="font-weight: 600; margin-bottom: 0px; font-size: 16px">Lorem Ipsum
                                            Dolor
                                        </p>
                                        <p>3x &nbsp; @10.000 &nbsp; &nbsp;</p>
                                    </td>
                                    <td>
                                        <p style="margin-bottom: 0px; font-size: 16px">Rp 30.000</p>

                                    </td>
                                </tr>

                                <tr>
                                    <td>
                                        <p style="font-weight: 600; margin-bottom: 0px; font-size: 16px">Lorem Ipsum
                                            Dolor
                                        </p>
                                        <p>3x &nbsp; @10.000 &nbsp; &nbsp;</p>
                                    </td>
                                    <td>
                                        <p style="margin-bottom: 0px; font-size: 16px">Rp 30.000</p>

                                    </td>
                                </tr>

                                <tr>
                                    <td>
                                        <p style="font-weight: 600; margin-bottom: 0px; font-size: 16px">Lorem Ipsum
                                            Dolor
                                        </p>
                                        <p>3x &nbsp; @10.000 &nbsp; &nbsp;</p>
                                    </td>
                                    <td>
                                        <p style="margin-bottom: 0px; font-size: 16px">Rp 30.000</p>

                                    </td>
                                </tr>

                                <tr>
                                    <td>
                                        <p style="font-weight: 600; margin-bottom: 0px; font-size: 16px">Lorem Ipsum
                                            Dolor
                                        </p>
                                        <p>3x &nbsp; @10.000 &nbsp; &nbsp;</p>
                                    </td>
                                    <td>
                                        <p style="margin-bottom: 0px; font-size: 16px">Rp 30.000</p>

                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                </div>
                <div class="card-footer">
                    Jl. Gatot Subroto No.Kav. 38, RT.6/RW.1, Kuningan Bar., Kec. Mampang Prpt., Jakarta, Daerah Khusus
                    Ibukota Jakarta 12710
                </div>
            </div>
        </div>
        <div class="box">
            <div class="carousel-wrap">
                <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="{{ asset('images/banner-png.png')}}" class="d-block w-100" alt="">
                        </div>
                        <div class="carousel-item">
                            <img src="{{ asset('images/feed4.jpg')}}" class="d-block w-100" alt="">
                        </div>
                        <div class="carousel-item">
                            <img src="{{ asset('images/feed7.jpg')}}" class="d-block w-100" alt="">
                        </div>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls"
                        data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls"
                        data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>

            <div class="card-header" style="height: 30% !important; background: #fff !important; color: #000">
                <table class="item-order">
                    <tbody>
                        <tr>
                            <td style="border-bottom: none !important; padding: 10px">
                                <p style="font-weight: 600; margin-bottom: 0px; font-size: 18px">Sub total
                                </p>
                            </td>
                            <td>
                                <p style="margin-bottom: 0px; font-size: 18px">Rp 120.000</p>
                            </td>
                        </tr>

                        <tr>
                            <td style="border-bottom: none !important">
                                <p style="font-weight: 600; margin-bottom: 0px; font-size: 18px">Sub discount(%)
                                </p>
                            </td>
                            <td>
                                <p style="margin-bottom: 0px; font-size: 18px">Rp 1.500</p>

                            </td>
                        </tr>

                        <tr>
                            <td style="border-bottom: none !important">
                                <p style="font-weight: 600; margin-bottom: 0px; font-size: 18px; ">
                                    Grand total
                                </p>
                            </td>
                            <td style="border-bottom: none !important">
                                <p style="margin-bottom: 0px; font-size: 26px;font-weight: 600">Rp 118.500</p>

                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection