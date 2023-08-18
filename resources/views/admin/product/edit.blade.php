@extends('layouts.admin.master')

@section('title')
CMS | Edit Product
@endsection

@section('content')
@component('components.breadcrumb')
@slot('breadcrumb_title')
<h3>Edit Product</h3>
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
                                            <input id="input_post_title"
                                                value="{{ old('name', $product->name) }}"
                                                name="name" type="text"
                                                class="form-control @error('name') is-invalid @enderror"
                                                placeholder="Input name here" />
                                            @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>

                                    </div>
                                    <div class="col-6">
                                        <!-- slug -->
                                        <div class="form-group _form-group">
                                            <label for="input_post_code" class="font-weight-bold">
                                                Code
                                            </label>
                                            <input id="input_post_code" value="{{ old('code', $product->code) }}"
                                                name="code" type="text"
                                                class="form-control @error('code') is-invalid @enderror"
                                                placeholder="Cannot changed" readonly />
                                            @error('code')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>

                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-3">
                                        <div class="form-group _form-group">
                                            <label for="price_store" class="font-weight-bold">
                                                Offline Store Price <span class="wajib">* </span>
                                            </label>
                                            <input id="price_store" value="{{ old('price_store', $product->price_store) }}" name="price_store"
                                                type="number"
                                                class="form-control @error('price_store') is-invalid @enderror"
                                                placeholder="" required />
                                            @error('price_store')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <!-- End Year -->
                                        <div class="form-group _form-group">
                                            <label for="stock_store" class="font-weight-bold">
                                                Offline Store Stock
                                            </label>
                                            <input id="stock_store" value="{{ old('stock_store', $product->stock_store) }}" name="stock_store"
                                                type="number" class="form-control @error('stock_store') is-invalid @enderror"
                                                placeholder="" />
                                            @error('stock_store')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="form-group _form-group">
                                            <label for="price_olshop" class="font-weight-bold">
                                                Online Store Price <span class="wajib">* </span>
                                            </label>
                                            <input id="price_olshop" value="{{ old('price_olshop', $product->price_olshop) }}" name="price_olshop"
                                                type="number"
                                                class="form-control @error('price_olshop') is-invalid @enderror"
                                                placeholder="" required />
                                            @error('price_olshop')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <!-- End Year -->
                                        <div class="form-group _form-group">
                                            <label for="stock_olshop" class="font-weight-bold">
                                                Online Store Stock
                                            </label>
                                            <input id="stock_olshop" value="{{ old('stock_olshop', $product->stock_olshop) }}" name="stock_olshop"
                                                type="number" class="form-control @error('stock_olshop') is-invalid @enderror"
                                                placeholder="" />
                                            @error('stock_olshop')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <!-- description -->
                                <div class="form-group _form-group">
                                    <label for="input_post_description" class="font-weight-bold">
                                        Description <span class="wajib">* </span>
                                    </label>
                                    <textarea id="input_post_description" name="description"
                                        placeholder="Write description here.."
                                        class="form-control @error('description') is-invalid @enderror"
                                        rows="7">{{ old('description', $product->description) }}</textarea>
                                    @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <!-- status -->
                                <div class="form-group {{ $errors->has('is_active') ? ' has-error' : '' }} _form-group"
                                    style="display: flex; margin-top: 30px">
                                    <label for="input_banner_status" class="font-weight-bold"
                                        style="padding: 7px 0px; margin-right: 20px;">
                                        Status
                                    </label>
                                    <div class="col-2">
                                        <div class="media">
                                            <div class="media-body text-end icon-state">
                                                <label class="switch">
                                                    <input type="checkbox" name="is_active" {{ old("is_active",
                                                        $product->is_active) == 1 ? "checked" : null }}><span
                                                        class="switch-state"></span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- end status -->

                            </div>
                        </div>
                        <div class="row">

                            <div class="col-12">
                                <div class="float-right">
                                    <a class="btn btn-outline-primary _btn-primary px-4"
                                        href="{{ route('product.index') }}">Back</a>
                                    <button type="submit" class="btn btn-primary _btn-primary px-4">
                                        Save
                                    </button>
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