@extends('layouts.admin.master')

@section('title')
CMS | Account Code
@endsection

@push('css')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/select2.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/sweetalert2.css') }}">
<style>
    .table th {
        background: transparent !important;
    }

    .table thead {
        position: sticky;
        top: 0
    }

    .table-account {
        overflow-y: auto;
        height: 531px;
    }

    .table td {
        background: #fff !important;
        border: 1px solid #000 !important
    }

    .select-product-custom.select2-container .select2-selection--single {
        height: 50px !important;
    }

    .select-product-custom.select2-container .select2-selection--single .select2-selection__rendered {
        margin-top: 8px;
    }

    .select-product-custom.select2-container .select2-selection--single {
        border-radius: 5px 5px 0px 0px !important;
        border: 2px solid #a12a2f;
        border-color: #a12a2f !important;
    }

    .select-product-custom.select2-container--bootstrap4 .select2-selection--single .select2-selection__placeholder {
        line-height: calc(1.5em + .75rem);
        color: #a12a2f;
        font-size: 14px;
    }

    .form-check {
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
    }
</style>
@endpush

@section('content')
@component('components.breadcrumb')
@slot('breadcrumb_title')
{{-- <h3>Account Code</h3> --}}
@endslot
{{-- {{ Breadcrumbs::render('add_code') }} --}}
@endcomponent

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <form action="" method="POST" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="card _card">
                    <div class="card-body _card-body">
                        <div class="row d-flex align-items-stretch">
                            <div class="col-4">
                                <h3 style="font-size: 24px;
                                margin-bottom: 0;
                                font-weight: 600;
                                text-transform: capitalize;">Account Code</h3>
                            </div>
                            <div class="col-8">
                                <div
                                    style="width: 100%; display: flex; align-items: center; justify-content: flex-end;">
                                    <a style="width: 15%; margin-right: 5px; padding: 10px 0px"
                                        class="btn btn-outline-primary _btn-primary px-4"
                                        href="{{ route('purchase-order.index') }}">Back</a>
                                    <button style="width: 15%; margin-left: 5px; padding: 10px 0px" type="submit"
                                        class="btn btn-primary _btn-primary px-4">
                                        Update
                                    </button>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="table-responsive table-account" style="margin-top: 20px">
                                    <table class="table table-bordered table-width">
                                        <thead>
                                            <tr>
                                                <th style="text-align: center">Account</th>
                                                <th style="text-align: center">Lvl</th>
                                                <th style="text-align: center">Account Name</th>
                                                <th style="text-align: center">Structure</th>
                                                <th style="text-align: center">Remark</th>
                                                <th style="text-align: center">In</th>
                                                <th style="text-align: center">D/C</th>
                                                <th style="text-align: center">Dept</th>
                                                <th style="text-align: center">Vendor</th>
                                                <th style="text-align: center">Bank</th>
                                                <th style="text-align: center">Bank Account</th>
                                                <th style="text-align: center">Goods</th>
                                                <th style="text-align: center">Remain</th>
                                                <th style="text-align: center">Budget</th>
                                                <th style="text-align: center">Currency</th>
                                                <th style="text-align: center">Emp</th>
                                                <th style="text-align: center">Date1</th>
                                                <th style="text-align: center">Date2</th>
                                                <th style="text-align: center">Qty</th>
                                                <th style="text-align: center">Qty Unit</th>
                                                <th style="text-align: center">Rate</th>
                                                <th style="text-align: center">Amt1</th>
                                                <th style="text-align: center">Amt2</th>
                                                <th style="text-align: center">Invest</th>
                                                <th style="text-align: center">Othno</th>
                                                <th style="text-align: center">Bs Group1</th>
                                                <th style="text-align: center">Bs Group2</th>
                                                <th style="text-align: center">Account Type</th>
                                                <th style="text-align: center">Moc Group1</th>
                                                <th style="text-align: center">Moc Group2</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td style="text-align: center; vertical-align: middle">1000-00-00</td>
                                                <td style="text-align: center; vertical-align: middle">1</td>
                                                <td style="vertical-align: middle">ASSETS</td>
                                                <td style="vertical-align: middle">ASSETS</td>
                                                <td style="text-align: center; vertical-align: middle"></td>
                                                <td style="text-align: center; vertical-align: middle">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value=""
                                                            id="checkboxIn" name="in">
                                                    </div>
                                                </td>
                                                <td style="text-align: center; vertical-align: middle">
                                                    <div class="form-group" style="margin-bottom: 0px">
                                                        <select id="inputState" class="form-control"
                                                            style="text-align: center">
                                                            <option value="D">D</option>
                                                            <option value="C">C</option>
                                                        </select>
                                                    </div>
                                                </td>
                                                <td style="text-align: center; vertical-align: middle">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value=""
                                                            id="checkboxDept" name="dept">
                                                    </div>
                                                </td>
                                                <td style="text-align: center; vertical-align: middle">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value=""
                                                            id="checkboxVendor" name="vendor">
                                                    </div>
                                                </td>
                                                <td style="text-align: center; vertical-align: middle">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value=""
                                                            id="checkboxBank" name="bank">
                                                    </div>
                                                </td>
                                                <td style="text-align: center; vertical-align: middle">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value=""
                                                            id="checkboxBankAccount" name="bank_account">
                                                    </div>
                                                </td>
                                                <td style="text-align: center; vertical-align: middle">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value=""
                                                            id="checkboxGoods" name="goods">
                                                    </div>
                                                </td>
                                                <td style="text-align: center; vertical-align: middle">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value=""
                                                            id="checkboxRemain" name="remain">
                                                    </div>
                                                </td>
                                                <td style="text-align: center; vertical-align: middle">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value=""
                                                            id="checkboxBudget" name="budget">
                                                    </div>
                                                </td>
                                                <td style="text-align: center; vertical-align: middle">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value=""
                                                            id="checkboxCurrency" name="currency">
                                                    </div>
                                                </td>
                                                <td style="text-align: center; vertical-align: middle">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value=""
                                                            id="checkboxEmp" name="emp">
                                                    </div>
                                                </td>
                                                <td style="text-align: center; vertical-align: middle">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value=""
                                                            id="checkboxDate1" name="date1">
                                                    </div>
                                                </td>
                                                <td style="text-align: center; vertical-align: middle">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value=""
                                                            id="checkboxDate2" name="date2">
                                                    </div>
                                                </td>
                                                <td style="text-align: center; vertical-align: middle">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value=""
                                                            id="checkboxQty" name="qty">
                                                    </div>
                                                </td>
                                                <td style="text-align: center; vertical-align: middle">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value=""
                                                            id="checkboxQtyUnit" name="qty_unit">
                                                    </div>
                                                </td>
                                                <td style="text-align: center; vertical-align: middle">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value=""
                                                            id="checkboxRate" name="rate">
                                                    </div>
                                                </td>
                                                <td style="text-align: center; vertical-align: middle">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value=""
                                                            id="checkboxAmt1" name="amt1">
                                                    </div>
                                                </td>
                                                <td style="text-align: center; vertical-align: middle">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value=""
                                                            id="checkboxAmt2" name="amt2">
                                                    </div>
                                                </td>
                                                <td style="text-align: center; vertical-align: middle">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value=""
                                                            id="checkboxInvest" name="invest">
                                                    </div>
                                                </td>
                                                <td style="text-align: center; vertical-align: middle">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value=""
                                                            id="checkboxOthno" name="othno">
                                                    </div>
                                                </td>
                                                <td style="vertical-align: middle">ASSETS</td>
                                                <td style="vertical-align: middle">01. QUICK ASSET</td>
                                                <td style="vertical-align: middle">CASH</td>
                                                <td style="vertical-align: middle"></td>
                                                <td style="vertical-align: middle"></td>
                                            </tr>
                                            <tr>
                                                <td style="text-align: center; vertical-align: middle">1000-00-00</td>
                                                <td style="text-align: center; vertical-align: middle">1</td>
                                                <td style="vertical-align: middle">ASSETS</td>
                                                <td style="vertical-align: middle">ASSETS</td>
                                                <td style="text-align: center; vertical-align: middle"></td>
                                                <td style="text-align: center; vertical-align: middle">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value=""
                                                            id="checkboxIn" name="in">
                                                    </div>
                                                </td>
                                                <td style="text-align: center; vertical-align: middle">
                                                    <div class="form-group" style="margin-bottom: 0px">
                                                        <select id="inputState" class="form-control"
                                                            style="text-align: center">
                                                            <option value="D">D</option>
                                                            <option value="C">C</option>
                                                        </select>
                                                    </div>
                                                </td>
                                                <td style="text-align: center; vertical-align: middle">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value=""
                                                            id="checkboxDept" name="dept">
                                                    </div>
                                                </td>
                                                <td style="text-align: center; vertical-align: middle">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value=""
                                                            id="checkboxVendor" name="vendor">
                                                    </div>
                                                </td>
                                                <td style="text-align: center; vertical-align: middle">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value=""
                                                            id="checkboxBank" name="bank">
                                                    </div>
                                                </td>
                                                <td style="text-align: center; vertical-align: middle">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value=""
                                                            id="checkboxBankAccount" name="bank_account">
                                                    </div>
                                                </td>
                                                <td style="text-align: center; vertical-align: middle">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value=""
                                                            id="checkboxGoods" name="goods">
                                                    </div>
                                                </td>
                                                <td style="text-align: center; vertical-align: middle">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value=""
                                                            id="checkboxRemain" name="remain">
                                                    </div>
                                                </td>
                                                <td style="text-align: center; vertical-align: middle">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value=""
                                                            id="checkboxBudget" name="budget">
                                                    </div>
                                                </td>
                                                <td style="text-align: center; vertical-align: middle">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value=""
                                                            id="checkboxCurrency" name="currency">
                                                    </div>
                                                </td>
                                                <td style="text-align: center; vertical-align: middle">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value=""
                                                            id="checkboxEmp" name="emp">
                                                    </div>
                                                </td>
                                                <td style="text-align: center; vertical-align: middle">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value=""
                                                            id="checkboxDate1" name="date1">
                                                    </div>
                                                </td>
                                                <td style="text-align: center; vertical-align: middle">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value=""
                                                            id="checkboxDate2" name="date2">
                                                    </div>
                                                </td>
                                                <td style="text-align: center; vertical-align: middle">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value=""
                                                            id="checkboxQty" name="qty">
                                                    </div>
                                                </td>
                                                <td style="text-align: center; vertical-align: middle">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value=""
                                                            id="checkboxQtyUnit" name="qty_unit">
                                                    </div>
                                                </td>
                                                <td style="text-align: center; vertical-align: middle">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value=""
                                                            id="checkboxRate" name="rate">
                                                    </div>
                                                </td>
                                                <td style="text-align: center; vertical-align: middle">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value=""
                                                            id="checkboxAmt1" name="amt1">
                                                    </div>
                                                </td>
                                                <td style="text-align: center; vertical-align: middle">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value=""
                                                            id="checkboxAmt2" name="amt2">
                                                    </div>
                                                </td>
                                                <td style="text-align: center; vertical-align: middle">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value=""
                                                            id="checkboxInvest" name="invest">
                                                    </div>
                                                </td>
                                                <td style="text-align: center; vertical-align: middle">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value=""
                                                            id="checkboxOthno" name="othno">
                                                    </div>
                                                </td>
                                                <td style="vertical-align: middle">ASSETS</td>
                                                <td style="vertical-align: middle">01. QUICK ASSET</td>
                                                <td style="vertical-align: middle">CASH</td>
                                                <td style="vertical-align: middle"></td>
                                                <td style="vertical-align: middle"></td>
                                            </tr>
                                            <tr>
                                                <td style="text-align: center; vertical-align: middle">1000-00-00</td>
                                                <td style="text-align: center; vertical-align: middle">1</td>
                                                <td style="vertical-align: middle">ASSETS</td>
                                                <td style="vertical-align: middle">ASSETS</td>
                                                <td style="text-align: center; vertical-align: middle"></td>
                                                <td style="text-align: center; vertical-align: middle">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value=""
                                                            id="checkboxIn" name="in">
                                                    </div>
                                                </td>
                                                <td style="text-align: center; vertical-align: middle">
                                                    <div class="form-group" style="margin-bottom: 0px">
                                                        <select id="inputState" class="form-control"
                                                            style="text-align: center">
                                                            <option value="D">D</option>
                                                            <option value="C">C</option>
                                                        </select>
                                                    </div>
                                                </td>
                                                <td style="text-align: center; vertical-align: middle">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value=""
                                                            id="checkboxDept" name="dept">
                                                    </div>
                                                </td>
                                                <td style="text-align: center; vertical-align: middle">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value=""
                                                            id="checkboxVendor" name="vendor">
                                                    </div>
                                                </td>
                                                <td style="text-align: center; vertical-align: middle">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value=""
                                                            id="checkboxBank" name="bank">
                                                    </div>
                                                </td>
                                                <td style="text-align: center; vertical-align: middle">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value=""
                                                            id="checkboxBankAccount" name="bank_account">
                                                    </div>
                                                </td>
                                                <td style="text-align: center; vertical-align: middle">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value=""
                                                            id="checkboxGoods" name="goods">
                                                    </div>
                                                </td>
                                                <td style="text-align: center; vertical-align: middle">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value=""
                                                            id="checkboxRemain" name="remain">
                                                    </div>
                                                </td>
                                                <td style="text-align: center; vertical-align: middle">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value=""
                                                            id="checkboxBudget" name="budget">
                                                    </div>
                                                </td>
                                                <td style="text-align: center; vertical-align: middle">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value=""
                                                            id="checkboxCurrency" name="currency">
                                                    </div>
                                                </td>
                                                <td style="text-align: center; vertical-align: middle">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value=""
                                                            id="checkboxEmp" name="emp">
                                                    </div>
                                                </td>
                                                <td style="text-align: center; vertical-align: middle">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value=""
                                                            id="checkboxDate1" name="date1">
                                                    </div>
                                                </td>
                                                <td style="text-align: center; vertical-align: middle">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value=""
                                                            id="checkboxDate2" name="date2">
                                                    </div>
                                                </td>
                                                <td style="text-align: center; vertical-align: middle">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value=""
                                                            id="checkboxQty" name="qty">
                                                    </div>
                                                </td>
                                                <td style="text-align: center; vertical-align: middle">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value=""
                                                            id="checkboxQtyUnit" name="qty_unit">
                                                    </div>
                                                </td>
                                                <td style="text-align: center; vertical-align: middle">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value=""
                                                            id="checkboxRate" name="rate">
                                                    </div>
                                                </td>
                                                <td style="text-align: center; vertical-align: middle">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value=""
                                                            id="checkboxAmt1" name="amt1">
                                                    </div>
                                                </td>
                                                <td style="text-align: center; vertical-align: middle">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value=""
                                                            id="checkboxAmt2" name="amt2">
                                                    </div>
                                                </td>
                                                <td style="text-align: center; vertical-align: middle">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value=""
                                                            id="checkboxInvest" name="invest">
                                                    </div>
                                                </td>
                                                <td style="text-align: center; vertical-align: middle">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value=""
                                                            id="checkboxOthno" name="othno">
                                                    </div>
                                                </td>
                                                <td style="vertical-align: middle">ASSETS</td>
                                                <td style="vertical-align: middle">01. QUICK ASSET</td>
                                                <td style="vertical-align: middle">CASH</td>
                                                <td style="vertical-align: middle"></td>
                                                <td style="vertical-align: middle"></td>
                                            </tr>
                                            <tr>
                                                <td style="text-align: center; vertical-align: middle">1000-00-00</td>
                                                <td style="text-align: center; vertical-align: middle">1</td>
                                                <td style="vertical-align: middle">ASSETS</td>
                                                <td style="vertical-align: middle">ASSETS</td>
                                                <td style="text-align: center; vertical-align: middle"></td>
                                                <td style="text-align: center; vertical-align: middle">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value=""
                                                            id="checkboxIn" name="in">
                                                    </div>
                                                </td>
                                                <td style="text-align: center; vertical-align: middle">
                                                    <div class="form-group" style="margin-bottom: 0px">
                                                        <select id="inputState" class="form-control"
                                                            style="text-align: center">
                                                            <option value="D">D</option>
                                                            <option value="C">C</option>
                                                        </select>
                                                    </div>
                                                </td>
                                                <td style="text-align: center; vertical-align: middle">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value=""
                                                            id="checkboxDept" name="dept">
                                                    </div>
                                                </td>
                                                <td style="text-align: center; vertical-align: middle">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value=""
                                                            id="checkboxVendor" name="vendor">
                                                    </div>
                                                </td>
                                                <td style="text-align: center; vertical-align: middle">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value=""
                                                            id="checkboxBank" name="bank">
                                                    </div>
                                                </td>
                                                <td style="text-align: center; vertical-align: middle">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value=""
                                                            id="checkboxBankAccount" name="bank_account">
                                                    </div>
                                                </td>
                                                <td style="text-align: center; vertical-align: middle">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value=""
                                                            id="checkboxGoods" name="goods">
                                                    </div>
                                                </td>
                                                <td style="text-align: center; vertical-align: middle">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value=""
                                                            id="checkboxRemain" name="remain">
                                                    </div>
                                                </td>
                                                <td style="text-align: center; vertical-align: middle">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value=""
                                                            id="checkboxBudget" name="budget">
                                                    </div>
                                                </td>
                                                <td style="text-align: center; vertical-align: middle">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value=""
                                                            id="checkboxCurrency" name="currency">
                                                    </div>
                                                </td>
                                                <td style="text-align: center; vertical-align: middle">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value=""
                                                            id="checkboxEmp" name="emp">
                                                    </div>
                                                </td>
                                                <td style="text-align: center; vertical-align: middle">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value=""
                                                            id="checkboxDate1" name="date1">
                                                    </div>
                                                </td>
                                                <td style="text-align: center; vertical-align: middle">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value=""
                                                            id="checkboxDate2" name="date2">
                                                    </div>
                                                </td>
                                                <td style="text-align: center; vertical-align: middle">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value=""
                                                            id="checkboxQty" name="qty">
                                                    </div>
                                                </td>
                                                <td style="text-align: center; vertical-align: middle">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value=""
                                                            id="checkboxQtyUnit" name="qty_unit">
                                                    </div>
                                                </td>
                                                <td style="text-align: center; vertical-align: middle">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value=""
                                                            id="checkboxRate" name="rate">
                                                    </div>
                                                </td>
                                                <td style="text-align: center; vertical-align: middle">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value=""
                                                            id="checkboxAmt1" name="amt1">
                                                    </div>
                                                </td>
                                                <td style="text-align: center; vertical-align: middle">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value=""
                                                            id="checkboxAmt2" name="amt2">
                                                    </div>
                                                </td>
                                                <td style="text-align: center; vertical-align: middle">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value=""
                                                            id="checkboxInvest" name="invest">
                                                    </div>
                                                </td>
                                                <td style="text-align: center; vertical-align: middle">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value=""
                                                            id="checkboxOthno" name="othno">
                                                    </div>
                                                </td>
                                                <td style="vertical-align: middle">ASSETS</td>
                                                <td style="vertical-align: middle">01. QUICK ASSET</td>
                                                <td style="vertical-align: middle">CASH</td>
                                                <td style="vertical-align: middle"></td>
                                                <td style="vertical-align: middle"></td>
                                            </tr>
                                            <tr>
                                                <td style="text-align: center; vertical-align: middle">1000-00-00</td>
                                                <td style="text-align: center; vertical-align: middle">1</td>
                                                <td style="vertical-align: middle">ASSETS</td>
                                                <td style="vertical-align: middle">ASSETS</td>
                                                <td style="text-align: center; vertical-align: middle"></td>
                                                <td style="text-align: center; vertical-align: middle">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value=""
                                                            id="checkboxIn" name="in">
                                                    </div>
                                                </td>
                                                <td style="text-align: center; vertical-align: middle">
                                                    <div class="form-group" style="margin-bottom: 0px">
                                                        <select id="inputState" class="form-control"
                                                            style="text-align: center">
                                                            <option value="D">D</option>
                                                            <option value="C">C</option>
                                                        </select>
                                                    </div>
                                                </td>
                                                <td style="text-align: center; vertical-align: middle">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value=""
                                                            id="checkboxDept" name="dept">
                                                    </div>
                                                </td>
                                                <td style="text-align: center; vertical-align: middle">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value=""
                                                            id="checkboxVendor" name="vendor">
                                                    </div>
                                                </td>
                                                <td style="text-align: center; vertical-align: middle">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value=""
                                                            id="checkboxBank" name="bank">
                                                    </div>
                                                </td>
                                                <td style="text-align: center; vertical-align: middle">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value=""
                                                            id="checkboxBankAccount" name="bank_account">
                                                    </div>
                                                </td>
                                                <td style="text-align: center; vertical-align: middle">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value=""
                                                            id="checkboxGoods" name="goods">
                                                    </div>
                                                </td>
                                                <td style="text-align: center; vertical-align: middle">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value=""
                                                            id="checkboxRemain" name="remain">
                                                    </div>
                                                </td>
                                                <td style="text-align: center; vertical-align: middle">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value=""
                                                            id="checkboxBudget" name="budget">
                                                    </div>
                                                </td>
                                                <td style="text-align: center; vertical-align: middle">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value=""
                                                            id="checkboxCurrency" name="currency">
                                                    </div>
                                                </td>
                                                <td style="text-align: center; vertical-align: middle">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value=""
                                                            id="checkboxEmp" name="emp">
                                                    </div>
                                                </td>
                                                <td style="text-align: center; vertical-align: middle">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value=""
                                                            id="checkboxDate1" name="date1">
                                                    </div>
                                                </td>
                                                <td style="text-align: center; vertical-align: middle">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value=""
                                                            id="checkboxDate2" name="date2">
                                                    </div>
                                                </td>
                                                <td style="text-align: center; vertical-align: middle">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value=""
                                                            id="checkboxQty" name="qty">
                                                    </div>
                                                </td>
                                                <td style="text-align: center; vertical-align: middle">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value=""
                                                            id="checkboxQtyUnit" name="qty_unit">
                                                    </div>
                                                </td>
                                                <td style="text-align: center; vertical-align: middle">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value=""
                                                            id="checkboxRate" name="rate">
                                                    </div>
                                                </td>
                                                <td style="text-align: center; vertical-align: middle">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value=""
                                                            id="checkboxAmt1" name="amt1">
                                                    </div>
                                                </td>
                                                <td style="text-align: center; vertical-align: middle">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value=""
                                                            id="checkboxAmt2" name="amt2">
                                                    </div>
                                                </td>
                                                <td style="text-align: center; vertical-align: middle">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value=""
                                                            id="checkboxInvest" name="invest">
                                                    </div>
                                                </td>
                                                <td style="text-align: center; vertical-align: middle">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value=""
                                                            id="checkboxOthno" name="othno">
                                                    </div>
                                                </td>
                                                <td style="vertical-align: middle">ASSETS</td>
                                                <td style="vertical-align: middle">01. QUICK ASSET</td>
                                                <td style="vertical-align: middle">CASH</td>
                                                <td style="vertical-align: middle"></td>
                                                <td style="vertical-align: middle"></td>
                                            </tr>
                                            <tr>
                                                <td style="text-align: center; vertical-align: middle">1000-00-00</td>
                                                <td style="text-align: center; vertical-align: middle">1</td>
                                                <td style="vertical-align: middle">ASSETS</td>
                                                <td style="vertical-align: middle">ASSETS</td>
                                                <td style="text-align: center; vertical-align: middle"></td>
                                                <td style="text-align: center; vertical-align: middle">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value=""
                                                            id="checkboxIn" name="in">
                                                    </div>
                                                </td>
                                                <td style="text-align: center; vertical-align: middle">
                                                    <div class="form-group" style="margin-bottom: 0px">
                                                        <select id="inputState" class="form-control"
                                                            style="text-align: center">
                                                            <option value="D">D</option>
                                                            <option value="C">C</option>
                                                        </select>
                                                    </div>
                                                </td>
                                                <td style="text-align: center; vertical-align: middle">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value=""
                                                            id="checkboxDept" name="dept">
                                                    </div>
                                                </td>
                                                <td style="text-align: center; vertical-align: middle">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value=""
                                                            id="checkboxVendor" name="vendor">
                                                    </div>
                                                </td>
                                                <td style="text-align: center; vertical-align: middle">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value=""
                                                            id="checkboxBank" name="bank">
                                                    </div>
                                                </td>
                                                <td style="text-align: center; vertical-align: middle">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value=""
                                                            id="checkboxBankAccount" name="bank_account">
                                                    </div>
                                                </td>
                                                <td style="text-align: center; vertical-align: middle">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value=""
                                                            id="checkboxGoods" name="goods">
                                                    </div>
                                                </td>
                                                <td style="text-align: center; vertical-align: middle">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value=""
                                                            id="checkboxRemain" name="remain">
                                                    </div>
                                                </td>
                                                <td style="text-align: center; vertical-align: middle">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value=""
                                                            id="checkboxBudget" name="budget">
                                                    </div>
                                                </td>
                                                <td style="text-align: center; vertical-align: middle">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value=""
                                                            id="checkboxCurrency" name="currency">
                                                    </div>
                                                </td>
                                                <td style="text-align: center; vertical-align: middle">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value=""
                                                            id="checkboxEmp" name="emp">
                                                    </div>
                                                </td>
                                                <td style="text-align: center; vertical-align: middle">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value=""
                                                            id="checkboxDate1" name="date1">
                                                    </div>
                                                </td>
                                                <td style="text-align: center; vertical-align: middle">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value=""
                                                            id="checkboxDate2" name="date2">
                                                    </div>
                                                </td>
                                                <td style="text-align: center; vertical-align: middle">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value=""
                                                            id="checkboxQty" name="qty">
                                                    </div>
                                                </td>
                                                <td style="text-align: center; vertical-align: middle">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value=""
                                                            id="checkboxQtyUnit" name="qty_unit">
                                                    </div>
                                                </td>
                                                <td style="text-align: center; vertical-align: middle">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value=""
                                                            id="checkboxRate" name="rate">
                                                    </div>
                                                </td>
                                                <td style="text-align: center; vertical-align: middle">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value=""
                                                            id="checkboxAmt1" name="amt1">
                                                    </div>
                                                </td>
                                                <td style="text-align: center; vertical-align: middle">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value=""
                                                            id="checkboxAmt2" name="amt2">
                                                    </div>
                                                </td>
                                                <td style="text-align: center; vertical-align: middle">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value=""
                                                            id="checkboxInvest" name="invest">
                                                    </div>
                                                </td>
                                                <td style="text-align: center; vertical-align: middle">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value=""
                                                            id="checkboxOthno" name="othno">
                                                    </div>
                                                </td>
                                                <td style="vertical-align: middle">ASSETS</td>
                                                <td style="vertical-align: middle">01. QUICK ASSET</td>
                                                <td style="vertical-align: middle">CASH</td>
                                                <td style="vertical-align: middle"></td>
                                                <td style="vertical-align: middle"></td>
                                            </tr>
                                            <tr>
                                                <td style="text-align: center; vertical-align: middle">1000-00-00</td>
                                                <td style="text-align: center; vertical-align: middle">1</td>
                                                <td style="vertical-align: middle">ASSETS</td>
                                                <td style="vertical-align: middle">ASSETS</td>
                                                <td style="text-align: center; vertical-align: middle"></td>
                                                <td style="text-align: center; vertical-align: middle">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value=""
                                                            id="checkboxIn" name="in">
                                                    </div>
                                                </td>
                                                <td style="text-align: center; vertical-align: middle">
                                                    <div class="form-group" style="margin-bottom: 0px">
                                                        <select id="inputState" class="form-control"
                                                            style="text-align: center">
                                                            <option value="D">D</option>
                                                            <option value="C">C</option>
                                                        </select>
                                                    </div>
                                                </td>
                                                <td style="text-align: center; vertical-align: middle">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value=""
                                                            id="checkboxDept" name="dept">
                                                    </div>
                                                </td>
                                                <td style="text-align: center; vertical-align: middle">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value=""
                                                            id="checkboxVendor" name="vendor">
                                                    </div>
                                                </td>
                                                <td style="text-align: center; vertical-align: middle">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value=""
                                                            id="checkboxBank" name="bank">
                                                    </div>
                                                </td>
                                                <td style="text-align: center; vertical-align: middle">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value=""
                                                            id="checkboxBankAccount" name="bank_account">
                                                    </div>
                                                </td>
                                                <td style="text-align: center; vertical-align: middle">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value=""
                                                            id="checkboxGoods" name="goods">
                                                    </div>
                                                </td>
                                                <td style="text-align: center; vertical-align: middle">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value=""
                                                            id="checkboxRemain" name="remain">
                                                    </div>
                                                </td>
                                                <td style="text-align: center; vertical-align: middle">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value=""
                                                            id="checkboxBudget" name="budget">
                                                    </div>
                                                </td>
                                                <td style="text-align: center; vertical-align: middle">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value=""
                                                            id="checkboxCurrency" name="currency">
                                                    </div>
                                                </td>
                                                <td style="text-align: center; vertical-align: middle">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value=""
                                                            id="checkboxEmp" name="emp">
                                                    </div>
                                                </td>
                                                <td style="text-align: center; vertical-align: middle">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value=""
                                                            id="checkboxDate1" name="date1">
                                                    </div>
                                                </td>
                                                <td style="text-align: center; vertical-align: middle">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value=""
                                                            id="checkboxDate2" name="date2">
                                                    </div>
                                                </td>
                                                <td style="text-align: center; vertical-align: middle">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value=""
                                                            id="checkboxQty" name="qty">
                                                    </div>
                                                </td>
                                                <td style="text-align: center; vertical-align: middle">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value=""
                                                            id="checkboxQtyUnit" name="qty_unit">
                                                    </div>
                                                </td>
                                                <td style="text-align: center; vertical-align: middle">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value=""
                                                            id="checkboxRate" name="rate">
                                                    </div>
                                                </td>
                                                <td style="text-align: center; vertical-align: middle">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value=""
                                                            id="checkboxAmt1" name="amt1">
                                                    </div>
                                                </td>
                                                <td style="text-align: center; vertical-align: middle">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value=""
                                                            id="checkboxAmt2" name="amt2">
                                                    </div>
                                                </td>
                                                <td style="text-align: center; vertical-align: middle">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value=""
                                                            id="checkboxInvest" name="invest">
                                                    </div>
                                                </td>
                                                <td style="text-align: center; vertical-align: middle">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value=""
                                                            id="checkboxOthno" name="othno">
                                                    </div>
                                                </td>
                                                <td style="vertical-align: middle">ASSETS</td>
                                                <td style="vertical-align: middle">01. QUICK ASSET</td>
                                                <td style="vertical-align: middle">CASH</td>
                                                <td style="vertical-align: middle"></td>
                                                <td style="vertical-align: middle"></td>
                                            </tr>
                                            <tr>
                                                <td style="text-align: center; vertical-align: middle">1000-00-00</td>
                                                <td style="text-align: center; vertical-align: middle">1</td>
                                                <td style="vertical-align: middle">ASSETS</td>
                                                <td style="vertical-align: middle">ASSETS</td>
                                                <td style="text-align: center; vertical-align: middle"></td>
                                                <td style="text-align: center; vertical-align: middle">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value=""
                                                            id="checkboxIn" name="in">
                                                    </div>
                                                </td>
                                                <td style="text-align: center; vertical-align: middle">
                                                    <div class="form-group" style="margin-bottom: 0px">
                                                        <select id="inputState" class="form-control"
                                                            style="text-align: center">
                                                            <option value="D">D</option>
                                                            <option value="C">C</option>
                                                        </select>
                                                    </div>
                                                </td>
                                                <td style="text-align: center; vertical-align: middle">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value=""
                                                            id="checkboxDept" name="dept">
                                                    </div>
                                                </td>
                                                <td style="text-align: center; vertical-align: middle">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value=""
                                                            id="checkboxVendor" name="vendor">
                                                    </div>
                                                </td>
                                                <td style="text-align: center; vertical-align: middle">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value=""
                                                            id="checkboxBank" name="bank">
                                                    </div>
                                                </td>
                                                <td style="text-align: center; vertical-align: middle">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value=""
                                                            id="checkboxBankAccount" name="bank_account">
                                                    </div>
                                                </td>
                                                <td style="text-align: center; vertical-align: middle">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value=""
                                                            id="checkboxGoods" name="goods">
                                                    </div>
                                                </td>
                                                <td style="text-align: center; vertical-align: middle">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value=""
                                                            id="checkboxRemain" name="remain">
                                                    </div>
                                                </td>
                                                <td style="text-align: center; vertical-align: middle">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value=""
                                                            id="checkboxBudget" name="budget">
                                                    </div>
                                                </td>
                                                <td style="text-align: center; vertical-align: middle">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value=""
                                                            id="checkboxCurrency" name="currency">
                                                    </div>
                                                </td>
                                                <td style="text-align: center; vertical-align: middle">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value=""
                                                            id="checkboxEmp" name="emp">
                                                    </div>
                                                </td>
                                                <td style="text-align: center; vertical-align: middle">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value=""
                                                            id="checkboxDate1" name="date1">
                                                    </div>
                                                </td>
                                                <td style="text-align: center; vertical-align: middle">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value=""
                                                            id="checkboxDate2" name="date2">
                                                    </div>
                                                </td>
                                                <td style="text-align: center; vertical-align: middle">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value=""
                                                            id="checkboxQty" name="qty">
                                                    </div>
                                                </td>
                                                <td style="text-align: center; vertical-align: middle">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value=""
                                                            id="checkboxQtyUnit" name="qty_unit">
                                                    </div>
                                                </td>
                                                <td style="text-align: center; vertical-align: middle">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value=""
                                                            id="checkboxRate" name="rate">
                                                    </div>
                                                </td>
                                                <td style="text-align: center; vertical-align: middle">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value=""
                                                            id="checkboxAmt1" name="amt1">
                                                    </div>
                                                </td>
                                                <td style="text-align: center; vertical-align: middle">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value=""
                                                            id="checkboxAmt2" name="amt2">
                                                    </div>
                                                </td>
                                                <td style="text-align: center; vertical-align: middle">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value=""
                                                            id="checkboxInvest" name="invest">
                                                    </div>
                                                </td>
                                                <td style="text-align: center; vertical-align: middle">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value=""
                                                            id="checkboxOthno" name="othno">
                                                    </div>
                                                </td>
                                                <td style="vertical-align: middle">ASSETS</td>
                                                <td style="vertical-align: middle">01. QUICK ASSET</td>
                                                <td style="vertical-align: middle">CASH</td>
                                                <td style="vertical-align: middle"></td>
                                                <td style="vertical-align: middle"></td>
                                            </tr>
                                            <tr>
                                                <td style="text-align: center; vertical-align: middle">1000-00-00</td>
                                                <td style="text-align: center; vertical-align: middle">1</td>
                                                <td style="vertical-align: middle">ASSETS</td>
                                                <td style="vertical-align: middle">ASSETS</td>
                                                <td style="text-align: center; vertical-align: middle"></td>
                                                <td style="text-align: center; vertical-align: middle">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value=""
                                                            id="checkboxIn" name="in">
                                                    </div>
                                                </td>
                                                <td style="text-align: center; vertical-align: middle">
                                                    <div class="form-group" style="margin-bottom: 0px">
                                                        <select id="inputState" class="form-control"
                                                            style="text-align: center">
                                                            <option value="D">D</option>
                                                            <option value="C">C</option>
                                                        </select>
                                                    </div>
                                                </td>
                                                <td style="text-align: center; vertical-align: middle">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value=""
                                                            id="checkboxDept" name="dept">
                                                    </div>
                                                </td>
                                                <td style="text-align: center; vertical-align: middle">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value=""
                                                            id="checkboxVendor" name="vendor">
                                                    </div>
                                                </td>
                                                <td style="text-align: center; vertical-align: middle">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value=""
                                                            id="checkboxBank" name="bank">
                                                    </div>
                                                </td>
                                                <td style="text-align: center; vertical-align: middle">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value=""
                                                            id="checkboxBankAccount" name="bank_account">
                                                    </div>
                                                </td>
                                                <td style="text-align: center; vertical-align: middle">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value=""
                                                            id="checkboxGoods" name="goods">
                                                    </div>
                                                </td>
                                                <td style="text-align: center; vertical-align: middle">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value=""
                                                            id="checkboxRemain" name="remain">
                                                    </div>
                                                </td>
                                                <td style="text-align: center; vertical-align: middle">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value=""
                                                            id="checkboxBudget" name="budget">
                                                    </div>
                                                </td>
                                                <td style="text-align: center; vertical-align: middle">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value=""
                                                            id="checkboxCurrency" name="currency">
                                                    </div>
                                                </td>
                                                <td style="text-align: center; vertical-align: middle">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value=""
                                                            id="checkboxEmp" name="emp">
                                                    </div>
                                                </td>
                                                <td style="text-align: center; vertical-align: middle">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value=""
                                                            id="checkboxDate1" name="date1">
                                                    </div>
                                                </td>
                                                <td style="text-align: center; vertical-align: middle">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value=""
                                                            id="checkboxDate2" name="date2">
                                                    </div>
                                                </td>
                                                <td style="text-align: center; vertical-align: middle">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value=""
                                                            id="checkboxQty" name="qty">
                                                    </div>
                                                </td>
                                                <td style="text-align: center; vertical-align: middle">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value=""
                                                            id="checkboxQtyUnit" name="qty_unit">
                                                    </div>
                                                </td>
                                                <td style="text-align: center; vertical-align: middle">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value=""
                                                            id="checkboxRate" name="rate">
                                                    </div>
                                                </td>
                                                <td style="text-align: center; vertical-align: middle">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value=""
                                                            id="checkboxAmt1" name="amt1">
                                                    </div>
                                                </td>
                                                <td style="text-align: center; vertical-align: middle">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value=""
                                                            id="checkboxAmt2" name="amt2">
                                                    </div>
                                                </td>
                                                <td style="text-align: center; vertical-align: middle">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value=""
                                                            id="checkboxInvest" name="invest">
                                                    </div>
                                                </td>
                                                <td style="text-align: center; vertical-align: middle">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value=""
                                                            id="checkboxOthno" name="othno">
                                                    </div>
                                                </td>
                                                <td style="vertical-align: middle">ASSETS</td>
                                                <td style="vertical-align: middle">01. QUICK ASSET</td>
                                                <td style="vertical-align: middle">CASH</td>
                                                <td style="vertical-align: middle"></td>
                                                <td style="vertical-align: middle"></td>
                                            </tr>
                                            <tr>
                                                <td style="text-align: center; vertical-align: middle">1000-00-00</td>
                                                <td style="text-align: center; vertical-align: middle">1</td>
                                                <td style="vertical-align: middle">ASSETS</td>
                                                <td style="vertical-align: middle">ASSETS</td>
                                                <td style="text-align: center; vertical-align: middle"></td>
                                                <td style="text-align: center; vertical-align: middle">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value=""
                                                            id="checkboxIn" name="in">
                                                    </div>
                                                </td>
                                                <td style="text-align: center; vertical-align: middle">
                                                    <div class="form-group" style="margin-bottom: 0px">
                                                        <select id="inputState" class="form-control"
                                                            style="text-align: center">
                                                            <option value="D">D</option>
                                                            <option value="C">C</option>
                                                        </select>
                                                    </div>
                                                </td>
                                                <td style="text-align: center; vertical-align: middle">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value=""
                                                            id="checkboxDept" name="dept">
                                                    </div>
                                                </td>
                                                <td style="text-align: center; vertical-align: middle">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value=""
                                                            id="checkboxVendor" name="vendor">
                                                    </div>
                                                </td>
                                                <td style="text-align: center; vertical-align: middle">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value=""
                                                            id="checkboxBank" name="bank">
                                                    </div>
                                                </td>
                                                <td style="text-align: center; vertical-align: middle">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value=""
                                                            id="checkboxBankAccount" name="bank_account">
                                                    </div>
                                                </td>
                                                <td style="text-align: center; vertical-align: middle">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value=""
                                                            id="checkboxGoods" name="goods">
                                                    </div>
                                                </td>
                                                <td style="text-align: center; vertical-align: middle">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value=""
                                                            id="checkboxRemain" name="remain">
                                                    </div>
                                                </td>
                                                <td style="text-align: center; vertical-align: middle">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value=""
                                                            id="checkboxBudget" name="budget">
                                                    </div>
                                                </td>
                                                <td style="text-align: center; vertical-align: middle">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value=""
                                                            id="checkboxCurrency" name="currency">
                                                    </div>
                                                </td>
                                                <td style="text-align: center; vertical-align: middle">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value=""
                                                            id="checkboxEmp" name="emp">
                                                    </div>
                                                </td>
                                                <td style="text-align: center; vertical-align: middle">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value=""
                                                            id="checkboxDate1" name="date1">
                                                    </div>
                                                </td>
                                                <td style="text-align: center; vertical-align: middle">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value=""
                                                            id="checkboxDate2" name="date2">
                                                    </div>
                                                </td>
                                                <td style="text-align: center; vertical-align: middle">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value=""
                                                            id="checkboxQty" name="qty">
                                                    </div>
                                                </td>
                                                <td style="text-align: center; vertical-align: middle">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value=""
                                                            id="checkboxQtyUnit" name="qty_unit">
                                                    </div>
                                                </td>
                                                <td style="text-align: center; vertical-align: middle">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value=""
                                                            id="checkboxRate" name="rate">
                                                    </div>
                                                </td>
                                                <td style="text-align: center; vertical-align: middle">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value=""
                                                            id="checkboxAmt1" name="amt1">
                                                    </div>
                                                </td>
                                                <td style="text-align: center; vertical-align: middle">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value=""
                                                            id="checkboxAmt2" name="amt2">
                                                    </div>
                                                </td>
                                                <td style="text-align: center; vertical-align: middle">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value=""
                                                            id="checkboxInvest" name="invest">
                                                    </div>
                                                </td>
                                                <td style="text-align: center; vertical-align: middle">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value=""
                                                            id="checkboxOthno" name="othno">
                                                    </div>
                                                </td>
                                                <td style="vertical-align: middle">ASSETS</td>
                                                <td style="vertical-align: middle">01. QUICK ASSET</td>
                                                <td style="vertical-align: middle">CASH</td>
                                                <td style="vertical-align: middle"></td>
                                                <td style="vertical-align: middle"></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

</div>

@endsection

@push('css-external')
<link rel="stylesheet" href="{{ asset('vendor/select2/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('vendor/select2/css/select2-bootstrap4.min.css') }}">
@endpush

@push('javascript-external')
<script src="{{ asset('vendor/laravel-filemanager/js/stand-alone-button.js') }}"></script>
<script src="{{ asset('vendor/tinymce5/jquery.tinymce.min.js') }}"></script>
<script src="{{ asset('vendor/tinymce5/tinymce.min.js') }}"></script>
<script src="{{ asset('vendor/select2/js/select2.min.js') }}"></script>
<script src="{{ asset('vendor/select2/js/' . app()->getLocale() . '.js') }}"></script>
<script src="{{ asset('assets/js/datepicker.min.js') }}">
</script>
@endpush


@push('javascript-internal')
<script src="{{ asset('assets/js/sweetalert.min.js') }}"></script>
@endpush