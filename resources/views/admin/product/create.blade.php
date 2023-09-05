@extends('layouts.admin.master')

@section('title')
CMS | Add Product
@endsection

@push('css')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/select2.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/sweetalert2.css') }}">
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.2.0/css/datepicker.min.css" rel="stylesheet">
@endpush

@section('content')
@component('components.breadcrumb')
@slot('breadcrumb_title')
<h3>Add Product</h3>
@endslot
{{ Breadcrumbs::render('product') }}
@endcomponent

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <form action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data">
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
                                            <input id="input_post_title" value="{{ old('name') }}"
                                                name="name" type="text"
                                                class="form-control @error('name') is-invalid @enderror"
                                                placeholder="Input name here" required />
                                            @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>

                                    </div>
                                    <div class="col-6">
                                        <!-- code -->
                                        <div class="form-group _form-group">
                                            <label for="input_post_code" class="font-weight-bold">
                                                Code
                                            </label>
                                            <input id="input_post_code" value="{{ old('code') }}" name="code"
                                                type="text" class="form-control @error('code') is-invalid @enderror"
                                                placeholder="Input product code here" />
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
                                                Store Price <span class="wajib">* </span>
                                            </label>
                                            <input id="price_store" value="{{ old('price_store') }}" name="price_store"
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
                                        <div class="form-group _form-group">
                                            <label for="price_olshop" class="font-weight-bold">
                                                E-Commerce Price <span class="wajib">* </span>
                                            </label>
                                            <input id="price_olshop" value="{{ old('price_olshop') }}" name="price_olshop"
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
                                                Store Discount (%)
                                            </label>
                                            <input id="discount_store" value="{{ old('discount_store') }}" name="discount_store"
                                                type="number" class="form-control @error('discount_store') is-invalid @enderror"
                                                placeholder="" />
                                            @error('discount_store')
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
                                                E-Commerce Discount (%)
                                            </label>
                                            <input id="discount_olshop" value="{{ old('discount_olshop') }}" name="discount_olshop"
                                                type="number" class="form-control @error('discount_olshop') is-invalid @enderror"
                                                placeholder="" />
                                            @error('discount_olshop')
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
                                        Description
                                    </label>
                                    <textarea id="input_post_description" name="description"
                                        placeholder="Write description here.."
                                        class="form-control @error('description') is-invalid @enderror"
                                        rows="7">{{ old('description') }}</textarea>
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
                                                    <input type="checkbox" name="is_active" {{ old("is_active")==1
                                                        ? "checked" : null }}><span class="switch-state"></span>
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
        $("#input_post_title").change(function(event) {
            $("#input_post_slug").val(
                event.target.value
                .trim()
                .toLowerCase()
                .replace(/[^a-z\d-]/gi, "-")
                .replace(/-+/g, "-")
                .replace(/^-|-$/g, "")
            );
        });

        $('#button_post_thumbnail').filemanager('image');

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

        $("#input_post_description_2").tinymce({
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
<script>
    $(function() {
        $('#select_user_type').select2({
            theme: 'bootstrap4',
            language: "{{ app()->getLocale() }}",
            allowClear: true,
            // ajax: {
            //     url: "{{ route('roles.select') }}",
            //     dataType: 'json',
            //     delay: 250,
            //     processResults: function(data) {
            //         return {
            //             results: $.map(data, function(item) {
            //                 return {
            //                     text: item.name,
            //                     id: item.id
            //                 }
            //             })
            //         };
            //     }
            // }
        });
    });

    $(function() {
        $('#select_user_location').select2({
            theme: 'bootstrap4',
            language: "{{ app()->getLocale() }}",
            allowClear: true,
            // ajax: {
            //     url: "{{ route('roles.select') }}",
            //     dataType: 'json',
            //     delay: 250,
            //     processResults: function(data) {
            //         return {
            //             results: $.map(data, function(item) {
            //                 return {
            //                     text: item.name,
            //                     id: item.id
            //                 }
            //             })
            //         };
            //     }
            // }
        });
    });
    //select2 tag
    $('#select_portfolio_skill').select2({
            theme: 'bootstrap4',
            language: "",
            allowClear: true,
            ajax: {
                url: "{{ route('skill.select') }}",
                dataType: 'json',
                delay: 250,
                processResults: function(data) {
                    return {
                        results: $.map(data, function(item) {
                            return {
                                text: item.name,
                                id: item.id
                            }
                        })
                    };
                }
            }
    });
    //select2 tag
    $('#select_user_role').select2({
            theme: 'bootstrap4',
            language: "",
            allowClear: true,
            ajax: {
                url: "{{ route('project-type.select') }}",
                dataType: 'json',
                delay: 250,
                processResults: function(data) {
                    return {
                        results: $.map(data, function(item) {
                            return {
                                text: item.name,
                                id: item.id
                            }
                        })
                    };
                }
            }
    });
</script>

<script>
    $(document).ready(function(){
      $("#datepicker").datepicker({
         format: "yyyy",
         viewMode: "years", 
         minViewMode: "years",
         autoclose:true
      });   
      $("#datepickerend").datepicker({
         format: "yyyy",
         viewMode: "years", 
         minViewMode: "years",
         autoclose:true
      });  
    })
</script>

<script>
    function add_image() {
        var id = $('.images_data').length + 1;
        var txtarea_id = "element_desc_" + id;
        var item_id = "item_" + id;
        var html = `
            <div id="${item_id}">
                <div class="row">
                    <div class="col-4">
                        <div class="form-group _form-group">
                            <label for="images" class="font-weight-bold">
                                Image <span class="wajib">* </span>
                            </label>
                            <div class="float-right">
                                <button onclick="delete_row('${item_id}')" type="button" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></button>
                            </div>
                            <input name="image[]" type="file" class="form-control images_data" />
                        </div>
                    </div>
                    <div class="col-4">
                        <div  class="form-group _form-group">
                            <label for="images" class="font-weight-bold">
                                Alt Text 
                            </label>
                            <input name="alt_text[]" type="text" class="form-control" placeholder="Input alt text" />
                        </div>
                    </div>
                    <div class="col-4">
                        <div  class="form-group _form-group">
                            <label for="images" class="font-weight-bold">
                                Hover Text 
                            </label>
                            <input name="hover_text[]" type="text" class="form-control" placeholder="Input hover text" />
                        </div>
                    </div>
                </div>
            </div>
        `;
        $("#images_group").append(html);

    }

    function delete_row(eid) {
        $("#" + eid).remove();
    }

    function add_image_slider() {
        var id_slider = $('.images_data_slider').length + 1;
        var txtarea_slider_id = "element_desc_slider_" + id_slider;
        var item_slider_id = "item_slider_" + id_slider;
        var html_slider = `
            <div id="${item_slider_id}">
                <div class="row">
                    <div class="col-4">
                        <div class="form-group _form-group">
                            <label for="input_post_description" class="font-weight-bold">
                                Image <span class="wajib">* </span>
                            </label>
                            <div class="float-right">
                                <button onclick="delete_row_slider('${item_slider_id}')" type="button" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></button>
                            </div>
                            <input name="image_slider[]" type="file" class="form-control images_data" />
                        </div>
                    </div>
                    <div class="col-4">
                        <div  class="form-group _form-group">
                            <label for="input_post_description" class="font-weight-bold">
                                Alt Text 
                            </label>
                            <input name="alt_text_slider[]" type="text" class="form-control" placeholder="Input alt text" />
                        </div>
                    </div>
                    <div class="col-4">
                        <div  class="form-group _form-group">
                            <label for="input_post_description" class="font-weight-bold">
                                Hover Text 
                            </label>
                            <input name="hover_text_slider[]" type="text" class="form-control" placeholder="Input hover text" />
                        </div>
                    </div>
                </div>
            </div>
        `;
        $("#images_group_slider").append(html_slider);

    }

    function delete_row_slider(eid_slider) {
        $("#" + eid_slider).remove();
    }

</script>
@endpush