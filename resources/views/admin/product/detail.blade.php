@extends('layouts.admin.master')

@section('title')
CMS | Detail Product
@endsection

@section('content')
@component('components.breadcrumb')
@slot('breadcrumb_title')
<h3>Detail Product</h3>
@endslot
{{ Breadcrumbs::render('edit_product', $product) }}
@endcomponent

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <form action="{{ route('product.update', ['product' => $product]) }}" method="POST"
                enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="card _card" style="margin: auto; padding-bottom: 20px">
                    <div class="card-body _card-body">
                        <div class="row d-flex align-items-stretch">

                            <div class="col-12">
                                <div class="row">
                                    <div class="col-6">
                                        <!-- title -->
                                        <div class="form-group _form-group">
                                            <label for="input_post_title" class="font-weight-bold">
                                                Product Name <span class="wajib">* </span>
                                            </label>
                                            <input id="input_post_title" value="{{ $product->name }}" name="name" type="text" class="form-control" readonly>
                                        </div>

                                    </div>
                                    <div class="col-6">
                                        <!-- slug -->
                                        <div class="form-group _form-group">
                                            <label for="input_post_code" class="font-weight-bold">
                                                Code
                                            </label>
                                            <input id="input_post_code" value="{{ $product->code }}" type="text" class="form-control" readonly />
                                        </div>

                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-3">
                                        <div class="form-group _form-group">
                                            <label for="price_store" class="font-weight-bold">
                                                Store Price
                                            </label>
                                            <input id="price_store" value="{{ number_format($product->price_store) }}" type="text" class="form-control" readonly />
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="form-group _form-group">
                                            <label for="price_olshop" class="font-weight-bold">
                                                E-Commerce Price <span class="wajib">* </span>
                                            </label>
                                            <input id="price_olshop" value="{{ number_format($product->price_olshop) }}" type="text" class="form-control" readonly />
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <!-- End Year -->
                                        <div class="form-group _form-group">
                                            <label for="discount_store" class="font-weight-bold">
                                                Store Discount (%)
                                            </label>
                                            <input id="discount_store" value="{{ number_format($product->discount_store) }}" type="text" class="form-control" readonly />
                                        </div>
                                    </div>
                                    
                                    <div class="col-3">
                                        <!-- End Year -->
                                        <div class="form-group _form-group">
                                            <label for="stock_olshop" class="font-weight-bold">
                                                E-Commerce Discount (%)
                                            </label>
                                            <input id="discount_olshop" value="{{ number_format($product->discount_olshop) }}" type="text" class="form-control" readonly />
                                        </div>
                                    </div>
                                </div>

                                <!-- description -->
                                <div class="form-group _form-group">
                                    <label for="input_post_description" class="font-weight-bold">
                                        Description
                                    </label>
                                    {!! $product->description !!}
                                </div>

                                <div class="row">
                                    <div class="col-4">
                                        <div class="form-group" style="display: flex; margin-top: 30px">
                                            <label for="input_banner_status" class="font-weight-bold" style="padding: 7px 0px; margin-right: 20px;">
                                                Status
                                            </label>
                                            <div class="col-2">
                                                <div class="media">
                                                    <div class="media-body text-end icon-state">
                                                        <label class="switch">
                                                            <input type="checkbox" {{ $product->is_active == 1 ? "checked" : null }} disabled><span class="switch-state" ></span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-8">
                                        <span><strong>Price Logs</strong></span>
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th class="center-text">No <span class="dividerHr"></span></th>
                                                    <th class="heightHr">Date <span class="dividerHr"></span></th>
                                                    <th class="heightHr">Store Price <span class="dividerHr"></span></th>
                                                    <th class="heightHr">E-Commerce Price<span class="dividerHr"></span></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if (count($price_logs))
                                                    @forelse ($price_logs as $plog)
                                                        <tr>
                                                            <td style="width: 5%;" class="center-text">{{ $loop->iteration }}</td>
                                                            <td style="width: 25%; vertical-align: middle">{{ $plog->created_at }}</td>
                                                            <td style="width: 35%; vertical-align: middle">Rp {{ number_format($product->price_store) }} ( {{ $product->discount_store }} %)</td>
                                                            <td style="width: 35%; vertical-align: middle"> Rp {{ number_format($product->price_olshop) }} ( {{ $product->discount_olshop }} %)</td>
                                                        </tr>
                                                    @endforeach
                                                @endif
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="float-right">
                                    <a class="btn btn-outline-primary _btn-primary px-4 mt-5"
                                        href="{{ route('product.index') }}">Back</a>
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
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.2.0/css/datepicker.min.css" rel="stylesheet">
@endpush

@push('javascript-external')
<script src="{{ asset('vendor/laravel-filemanager/js/stand-alone-button.js') }}"></script>
<script src="{{ asset('vendor/tinymce5/jquery.tinymce.min.js') }}"></script>
<script src="{{ asset('vendor/tinymce5/tinymce.min.js') }}"></script>
<script src="{{ asset('vendor/select2/js/select2.min.js') }}"></script>
<script src="{{ asset('vendor/select2/js/' . app()->getLocale() . '.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.2.0/js/bootstrap-datepicker.min.js"></script>
@endpush

@push('javascript-internal')
<script>
    $(document).ready(function() {
  
          $("#input_post_description").tinymce({
              relative_urls: false,
              language: "en",
              height: 300,
              plugins: [
                  "advlist autolink lists link image charmap print preview hr anchor pagebreak",
                  "searchreplace wordcount visualblocks visualchars code fullscreen",
                  "insertdatetime media nonbreaking save table directionality",
                  "emoticons template paste textpattern",
              ],
              toolbar2: "styleselect | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link",
  
              file_picker_callback: function(callback, value, meta) {
                  let x = window.innerWidth || document.documentElement.clientWidth || document
                      .getElementsByTagName('body')[0].clientWidth;
                  let y = window.innerHeight || document.documentElement.clientHeight || document
                      .getElementsByTagName('body')[0].clientHeight;
  
                  let cmsURL =
                      "{{ route('unisharp.lfm.show') }}" +
                      '?editor=' + meta.fieldname;
                  if (meta.filetype == 'image') {
                      cmsURL = cmsURL + "&type=Images";
                  } else {
                      cmsURL = cmsURL + "&type=Files";
                  }
  
                  tinyMCE.activeEditor.windowManager.openUrl({
                      url: cmsURL,
                      title: 'Filemanager',
                      width: x * 0.8,
                      height: y * 0.8,
                      resizable: "yes",
                      close_previous: "no",
                      onMessage: (api, message) => {
                          callback(message.content);
                      }
                  });
              }
          });

      });
  
</script>
@endpush