@extends('layouts.admin.master')

@section('title')
CMS | Edit Code
@endsection

@push('css')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/select2.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/sweetalert2.css') }}">

<style>
    form {
        display: flex;
        align-items: center;
        justify-content: center;
        flex-direction: column;
        min-height: 60vh;
    }
</style>
@endpush

@section('content')
@component('components.breadcrumb')
@slot('breadcrumb_title')
<h3>Edit Code</h3>
@endslot
{{-- {{ Breadcrumbs::render('edit_code', $code) }} --}}
@endcomponent

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <form action="{{ route('code.update', ['code' => $code]) }}" method="POST" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="card _card" style="width: 40%; margin: auto">
                    <div class="card-body _card-body">
                        <div class="row d-flex align-items-stretch">

                            <div class="col-12">
                                <div class="row">
                                    <div class="col-12">
                                        <!-- title -->
                                        <div class="form-group _form-group">
                                            <label for="input_head" class="font-weight-bold">
                                                Head <span class="wajib">* </span>
                                            </label>
                                            <input id="input_head" value="{{ old('head', $code->head) }}" name="head"
                                                type="text" class="form-control @error('head') is-invalid @enderror"
                                                placeholder="Ex: A01" />
                                            @error('head')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>

                                    </div>
                                    <div class="col-12">
                                        <div class="form-group _form-group">
                                            <label for="input_code_name" class="font-weight-bold">
                                                Name <span class="wajib">* </span>
                                            </label>
                                            <input id="input_code_name" value="{{ old('code_name', $code->code_name) }}"
                                                name="code_name" type="text"
                                                class="form-control @error('code_name') is-invalid @enderror"
                                                placeholder="Type here.." />
                                            @error('code_name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="row">

                            <div class="col-12">
                                <div style="width: 100; display: flex; align-items: center; justify-content: center;">
                                    <a style="width: 50%; margin-right: 5px"
                                        class="btn btn-outline-primary _btn-primary px-4"
                                        href="{{ route('code.index') }}">Back</a>
                                    <button style="width: 50%; margin-left: 5px" type="submit"
                                        class="btn btn-primary _btn-primary px-4">
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
              toolbar2: "styleselect | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media",
  
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