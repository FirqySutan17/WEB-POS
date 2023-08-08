@extends('layouts.admin.master')

@section('title')
CMS | Edit Single Upload
@endsection

@section('content')
@component('components.breadcrumb')
@slot('breadcrumb_title')
<h3>Edit Single Upload</h3>
@endslot
{{ Breadcrumbs::render('edit_single_upload', $single_upload) }}
@endcomponent

<div class="container-fluid">
	<div class="row">
		<div class="col-12">
			<form action="{{ route('single_upload.update', ['single_upload' => $single_upload]) }}" method="POST" enctype="multipart/form-data">
				@method('PUT')
				@csrf
				<div class="card _card " style="width: 60%; margin: auto; padding-bottom: 20px">
					<div class="card-body _card-body">
						<div class="row d-flex align-items-stretch">
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group _form-group">
                                            <label for="input_post_title" class="font-weight-bold">
                                                Title <span class="wajib">* </span>
                                            </label>
                                            <input id="input_post_title" value="{{ old('title', $single_upload->title) }}" name="title" type="text" class="form-control @error('title') is-invalid @enderror" placeholder="Write title here.." />
                                            @error('title')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="form-group _form-group">
                                    <label for="input_post_description" class="font-weight-bold">
                                        Description <span class="wajib">* </span>
                                    </label>
                                    <textarea name="description" placeholder="Write description here.." class="form-control" rows="5">{{ $single_upload->description }}</textarea>
                                </div>

                                <div class="form-group _form-group">
                                    <label for="input_post_description" class="font-weight-bold">
                                        Image <span class="wajib">* </span>
                                    </label>
                                    <input name="image" type="file" class="form-control" />
                                    <?php if (!empty($single_upload->image)): ?>
                                        <br>
                                        <a href="{{ asset('file_upload/'.$single_upload->image) }}" target="_blank" class="btn btn-primary">Lihat File</a>
                                    <?php endif ?>
                                </div>
                            </div>
						</div>
						<div class="row">

							<div class="col-12">
								<div class="float-right mTop">
									<a class="btn btn-outline-primary _btn-primary px-4" href="{{ route('single_upload.index') }}">Back</a>
									<button type="submit" class="btn btn-primary _btn-primary px-4">
										Update
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
@endpush