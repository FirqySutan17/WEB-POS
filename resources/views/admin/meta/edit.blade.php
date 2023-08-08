@extends('layouts.admin.master')

@section('title')
CMS | Edit Meta pages
@endsection

@section('content')
@component('components.breadcrumb')
@slot('breadcrumb_title')
<h3>Edit Meta pages</h3>
@endslot

@endcomponent

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <form action="{{ route('metas.update', ['meta' => $meta]) }}" method="POST" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="card _card" style="width: 70%; margin: auto; padding-bottom: 20px">
                    <div class="card-body _card-body">
                        <div class="row d-flex align-items-stretch">

                            <div class="col-12">
                                <div class="row">
                                    <div class="col-6">
                                        <!-- title -->
                                        <div class="form-group _form-group">
                                            <label for="input_post_title" class="font-weight-bold">
                                                Name <span class="wajib">* </span>
                                            </label>
                                            <input id="input_post_title" value="{{ old('name', $meta->name) }}"
                                                name="name" type="text"
                                                class="form-control @error('name') is-invalid @enderror"
                                                placeholder="Write title here.." />
                                            @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                {{ $message }}
                                            </span>
                                            @enderror
                                        </div>

                                        <!-- Meta Title -->
                                        <div class="form-group _form-group">
                                            <label for="input_user_mtitle" class="font-weight-bold">
                                                Meta Title <span class="wajib">*</span>
                                            </label>
                                            <input id="input_user_mtitle"
                                                value="{{ old('meta_title', $meta->meta_title) }}" name="meta_title"
                                                type="text"
                                                class="form-control @error('meta_title') is-invalid @enderror"
                                                placeholder="Input meta title" />
                                            @error('meta_title')
                                            <span class="invalid-feedback">
                                                {{ $message }}
                                            </span>
                                            @enderror
                                            <!-- error message -->
                                        </div>
                                        <!-- end Meta Title -->

                                        <!-- Meta description -->
                                        <div class="form-group _form-group">
                                            <label for="input_user_mdescription" class="font-weight-bold">
                                                Meta Description <span class="wajib">*</span>
                                            </label>
                                            <input id="input_user_mdescription"
                                                value="{{ old('meta_description', $meta->meta_description) }}"
                                                name="meta_description" type="text"
                                                class="form-control @error('meta_description') is-invalid @enderror"
                                                placeholder="Input meta description" />
                                            @error('meta_description')
                                            <span class="invalid-feedback">
                                                {{ $message }}
                                            </span>
                                            @enderror
                                            <!-- error message -->
                                        </div>
                                        <!-- end Meta description -->

                                        <!-- og Title -->
                                        <div class="form-group _form-group">
                                            <label for="input_user_mtitle" class="font-weight-bold">
                                                OpenGraph Title <span class="wajib">*</span>
                                            </label>
                                            <input id="input_user_mtitle" value="{{ old('og_title', $meta->og_title) }}"
                                                name="og_title" type="text"
                                                class="form-control @error('og_title') is-invalid @enderror"
                                                placeholder="Input og title" />
                                            @error('og_title')
                                            <span class="invalid-feedback">
                                                {{ $message }}
                                            </span>
                                            @enderror
                                            <!-- error message -->
                                        </div>
                                        <!-- end og Title -->

                                        <!-- og url -->
                                        <div class="form-group _form-group">
                                            <label for="input_user_murl" class="font-weight-bold">
                                                OpenGraph url <span class="wajib">*</span>
                                            </label>
                                            <input id="input_user_murl" value="{{ old('og_url', $meta->og_url) }}"
                                                name="og_url" type="text"
                                                class="form-control @error('og_url') is-invalid @enderror"
                                                placeholder="Input og url" />
                                            @error('og_url')
                                            <span class="invalid-feedback">
                                                {{ $message }}
                                            </span>
                                            @enderror
                                            <!-- error message -->
                                        </div>
                                        <!-- end og Title -->

                                        <!-- og image_width -->
                                        <div class="form-group _form-group">
                                            <label for="input_user_mimage_width" class="font-weight-bold">
                                                OpenGraph Image Width <span class="wajib">*</span>
                                            </label>
                                            <input id="input_user_mimage_width"
                                                value="{{ old('og_image_width', $meta->og_image_width) }}"
                                                name="og_image_width" type="text"
                                                class="form-control @error('og_image_width') is-invalid @enderror"
                                                placeholder="Input og image_width" />
                                            @error('og_image_width')
                                            <span class="invalid-feedback">
                                                {{ $message }}
                                            </span>
                                            @enderror
                                            <!-- error message -->
                                        </div>
                                        <!-- end og Title -->

                                        <!-- og type -->
                                        <div class="form-group _form-group">
                                            <label for="input_user_mtype" class="font-weight-bold">
                                                OpenGraph Type <span class="wajib">*</span>
                                            </label>
                                            <input id="input_user_mtype" value="{{ old('og_type', $meta->og_type) }}"
                                                name="og_type" type="text"
                                                class="form-control @error('og_type') is-invalid @enderror"
                                                placeholder="Input og type" />
                                            @error('og_type')
                                            <span class="invalid-feedback">
                                                {{ $message }}
                                            </span>
                                            @enderror
                                            <!-- error message -->
                                        </div>
                                        <!-- end og Title -->

                                        <!-- og description -->
                                        <div class="form-group _form-group">
                                            <label for="input_user_mdescription" class="font-weight-bold">
                                                OpenGraph Description <span class="wajib">*</span>
                                            </label>
                                            <input id="input_user_mdescription"
                                                value="{{ old('og_description', $meta->og_description) }}"
                                                name="og_description" type="text"
                                                class="form-control @error('og_description') is-invalid @enderror"
                                                placeholder="Input og description" />
                                            @error('og_description')
                                            <span class="invalid-feedback">
                                                {{ $message }}
                                            </span>
                                            @enderror
                                            <!-- error message -->
                                        </div>
                                        <!-- end og Title -->

                                        <!-- Twitter Card -->
                                        <div class="form-group _form-group">
                                            <label for="input_user_tcard" class="font-weight-bold">
                                                Twitter Card <span class="wajib">*</span>
                                            </label>
                                            <input id="input_user_tcard"
                                                value="{{ old('twitter_card', $meta->twitter_card) }}"
                                                name="twitter_card" type="text"
                                                class="form-control @error('twitter_card') is-invalid @enderror"
                                                placeholder="Input twitter card" />
                                            @error('twitter_card')
                                            <span class="invalid-feedback">
                                                {{ $message }}
                                            </span>
                                            @enderror
                                            <!-- error message -->
                                        </div>
                                        <!-- end Twitter Card -->

                                        <!-- Twitter description -->
                                        <div class="form-group _form-group">
                                            <label for="input_user_tdescription" class="font-weight-bold">
                                                Twitter Description <span class="wajib">*</span>
                                            </label>
                                            <input id="input_user_tdescription"
                                                value="{{ old('twitter_description', $meta->twitter_description) }}"
                                                name="twitter_description" type="text"
                                                class="form-control @error('twitter_description') is-invalid @enderror"
                                                placeholder="Input twitter description" />
                                            @error('twitter_description')
                                            <span class="invalid-feedback">
                                                {{ $message }}
                                            </span>
                                            @enderror
                                            <!-- error message -->
                                        </div>
                                        <!-- end Twitter Card -->

                                        <!-- Twitter creator -->
                                        <div class="form-group _form-group">
                                            <label for="input_user_tcreator" class="font-weight-bold">
                                                Twitter Creator <span class="wajib">*</span>
                                            </label>
                                            <input id="input_user_tcreator"
                                                value="{{ old('twitter_creator', $meta->twitter_creator) }}"
                                                name="twitter_creator" type="text"
                                                class="form-control @error('twitter_creator') is-invalid @enderror"
                                                placeholder="Input twitter creator" />
                                            @error('twitter_creator')
                                            <span class="invalid-feedback">
                                                {{ $message }}
                                            </span>
                                            @enderror
                                            <!-- error message -->
                                        </div>
                                        <!-- end Twitter Card -->



                                    </div>
                                    <div class="col-6">
                                        <!-- slug -->
                                        <div class="form-group _form-group">
                                            <label for="input_post_slug" class="font-weight-bold">
                                                Slug
                                            </label>
                                            <input id="input_post_slug" value="{{ old('slug', $meta->slug) }}"
                                                name="slug" type="text"
                                                class="form-control @error('slug') is-invalid @enderror"
                                                placeholder="Auto Generate" readonly />
                                            @error('slug')
                                            <span class="invalid-feedback" role="alert">
                                                {{ $message }}
                                            </span>
                                            @enderror
                                        </div>

                                        <!-- Meta keyword -->
                                        <div class="form-group _form-group">
                                            <label for="input_user_mkeyword" class="font-weight-bold">
                                                Meta Keyword <span class="wajib">*</span>
                                            </label>
                                            <input id="input_user_mkeyword"
                                                value="{{ old('meta_keyword', $meta->meta_keyword) }}"
                                                name="meta_keyword" type="text"
                                                class="form-control @error('meta_keyword') is-invalid @enderror"
                                                placeholder="Input meta keyword" />
                                            @error('meta_keyword')
                                            <span class="invalid-feedback">
                                                {{ $message }}
                                            </span>
                                            @enderror
                                            <!-- error message -->
                                        </div>
                                        <!-- end Meta Title -->

                                        <!-- Meta robots -->
                                        <div class="form-group _form-group">
                                            <label for="input_user_mrobots" class="font-weight-bold">
                                                Meta Robots <span class="wajib">*</span>
                                            </label>
                                            <input id="input_user_mrobots"
                                                value="{{ old('meta_robots', $meta->meta_robots) }}" name="meta_robots"
                                                type="text"
                                                class="form-control @error('meta_robots') is-invalid @enderror"
                                                placeholder="Input meta robots" />
                                            @error('meta_robots')
                                            <span class="invalid-feedback">
                                                {{ $message }}
                                            </span>
                                            @enderror
                                            <!-- error message -->
                                        </div>
                                        <!-- end Meta Title -->

                                        <!-- og site_name -->
                                        <div class="form-group _form-group">
                                            <label for="input_user_msite_name" class="font-weight-bold">
                                                OpenGraph Site Name <span class="wajib">*</span>
                                            </label>
                                            <input id="input_user_msite_name"
                                                value="{{ old('og_site_name', $meta->og_site_name) }}"
                                                name="og_site_name" type="text"
                                                class="form-control @error('og_site_name') is-invalid @enderror"
                                                placeholder="Input og site_name" />
                                            @error('og_site_name')
                                            <span class="invalid-feedback">
                                                {{ $message }}
                                            </span>
                                            @enderror
                                            <!-- error message -->
                                        </div>
                                        <!-- end og Title -->



                                        <!-- og image_height -->
                                        <div class="form-group _form-group">
                                            <label for="input_user_mimage_height" class="font-weight-bold">
                                                OpenGraph Image Height <span class="wajib">*</span>
                                            </label>
                                            <input id="input_user_mimage_height"
                                                value="{{ old('og_image_height', $meta->og_image_height) }}"
                                                name="og_image_height" type="text"
                                                class="form-control @error('og_image_height') is-invalid @enderror"
                                                placeholder="Input og image_height" />
                                            @error('og_image_height')
                                            <span class="invalid-feedback">
                                                {{ $message }}
                                            </span>
                                            @enderror
                                            <!-- error message -->
                                        </div>
                                        <!-- end og Title -->

                                        <!-- og locale -->
                                        <div class="form-group _form-group">
                                            <label for="input_user_mlocale" class="font-weight-bold">
                                                OpenGraph Locale <span class="wajib">*</span>
                                            </label>
                                            <input id="input_user_mlocale"
                                                value="{{ old('og_locale', $meta->og_locale) }}" name="og_locale"
                                                type="text"
                                                class="form-control @error('og_locale') is-invalid @enderror"
                                                placeholder="Input og locale" />
                                            @error('og_locale')
                                            <span class="invalid-feedback">
                                                {{ $message }}
                                            </span>
                                            @enderror
                                            <!-- error message -->
                                        </div>
                                        <!-- end og Title -->

                                        <!-- og alternate -->
                                        <div class="form-group _form-group">
                                            <label for="input_user_malternate" class="font-weight-bold">
                                                OpenGraph Alternate <span class="wajib">*</span>
                                            </label>
                                            <input id="input_user_malternate"
                                                value="{{ old('og_alternate', $meta->og_alternate) }}"
                                                name="og_alternate" type="text"
                                                class="form-control @error('og_alternate') is-invalid @enderror"
                                                placeholder="Input og alternate" />
                                            @error('og_alternate')
                                            <span class="invalid-feedback">
                                                {{ $message }}
                                            </span>
                                            @enderror
                                            <!-- error message -->
                                        </div>
                                        <!-- end og Title -->

                                        <!-- Twitter title -->
                                        <div class="form-group _form-group">
                                            <label for="input_user_ttitle" class="font-weight-bold">
                                                Twitter Title <span class="wajib">*</span>
                                            </label>
                                            <input id="input_user_ttitle"
                                                value="{{ old('twitter_title', $meta->twitter_title) }}"
                                                name="twitter_title" type="text"
                                                class="form-control @error('twitter_title') is-invalid @enderror"
                                                placeholder="Input twitter title" />
                                            @error('twitter_title')
                                            <span class="invalid-feedback">
                                                {{ $message }}
                                            </span>
                                            @enderror
                                            <!-- error message -->
                                        </div>
                                        <!-- end Twitter title -->

                                        <!-- Twitter site -->
                                        <div class="form-group _form-group">
                                            <label for="input_user_tsite" class="font-weight-bold">
                                                Twitter Site <span class="wajib">*</span>
                                            </label>
                                            <input id="input_user_tsite"
                                                value="{{ old('twitter_site', $meta->twitter_site) }}"
                                                name="twitter_site" type="text"
                                                class="form-control @error('twitter_site') is-invalid @enderror"
                                                placeholder="Input twitter site" />
                                            @error('twitter_site')
                                            <span class="invalid-feedback">
                                                {{ $message }}
                                            </span>
                                            @enderror
                                            <!-- error message -->
                                        </div>
                                        <!-- end Twitter title -->

                                        <!-- Twitter image -->
                                        <div class="form-group _form-group">
                                            <label for="input_post_description" class="font-weight-bold">
                                                Twitter Image <span class="wajib">* </span>
                                            </label>
                                            <input name="twitter_image" type="file" class="form-control" />
                                            <?php if (!empty($meta->twitter_image)): ?>
                                            <br>
                                            <a href="{{ asset('file_upload/'.$meta->twitter_image) }}" target="_blank"
                                                class="btn btn-primary">Lihat File</a>
                                            <?php endif ?>

                                        </div>
                                        <!-- end Twitter image -->

                                        <!-- thumbnail -->
                                        <div class="form-group _form-group">
                                            <label for="input_post_description" class="font-weight-bold">
                                                OpenGraph Image <span class="wajib">* </span>
                                            </label>
                                            <input name="og_image" type="file" class="form-control" />
                                            <?php if (!empty($meta->og_image)): ?>
                                            <br>
                                            <a href="{{ asset('file_upload/'.$meta->og_image) }}" target="_blank"
                                                class="btn btn-primary">Lihat File</a>
                                            <?php endif ?>
                                        </div>
                                    </div>
                                </div>

                                <!-- schema_markup -->
                                <div class="form-group _form-group" style="display: none">
                                    <label for="input_post_schema_markup" class="font-weight-bold">
                                        Schema Markup
                                    </label>
                                    <textarea id="input_post_schema_markup" name="schema_markup"
                                        placeholder="Input schema markup"
                                        class="form-control @error('schema_markup') is-invalid @enderror"
                                        rows="7">{{ old('schema_markup', $meta->schema_markup) }}</textarea>
                                    @error('schema_markup')
                                    <span class="invalid-feedback" role="alert">
                                        {{ $message }}
                                    </span>
                                    @enderror
                                </div>

                            </div>
                        </div>
                        <div class="row">

                            <div class="col-12">
                                <div class="float-right">
                                    <a class="btn btn-outline-primary _btn-primary px-4"
                                        href="{{ route('metas.index') }}">Back</a>
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