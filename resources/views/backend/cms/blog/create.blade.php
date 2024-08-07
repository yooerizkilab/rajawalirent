@extends('layouts.backend.app',[
'title' => 'Tambah Blog'
])

@push('css')
<!-- selet-select -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<!-- summernote -->
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
@endpush

@section('content')
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Tambah Blog</h1>
        <a href="{{ url('admin/blog-cms') }}" class="d-none d-sm-inline-block btn btn-md btn-primary shadow-sm"><i class="fas fa-reply fa-sm text-white-50"></i> Kembali</a>
    </div>

    <div class="row">
        <div class="col-md">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="col-12">
                    <div class="card-body">
                        @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        @endif
                        @if(session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ session('error') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        @endif

                        <form action="{{ url('admin/blog-cms') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="title">Title</label>
                                <input name="title" id="title" type="text" class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" value="{{ old('title') }}">
                                @if($errors->has('title'))
                                <p class="text-danger">{{ $errors->first('title') }}</p>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="content">Content:</label>
                                <textarea id="summernote" name="content" class="form-control">{{ old('content', $request->content ?? '') }}</textarea>
                                <p class="text-danger">{{ $errors->first('content') }}</p>
                            </div>
                            <div class="form-group">
                                <label for="author">Author</label>
                                <input name="author" id="author" type="text" class="form-control {{ $errors->has('author') ? 'is-invalid':'' }}" value="{{ auth()->user()->name }}">
                                <p class="text-danger">{{ $errors->first('author') }}</p>
                            </div>
                            <div class="form-group">
                                <label for="published_at">Published</label>
                                <input name="published_at" id="published_at" type="date" class="form-control {{ $errors->has('published_at') ? 'is-invalid':'' }}" value="{{ old('published_at') }}">
                                <p class="text-danger">{{ $errors->first('published_at') }}</p>
                            </div>
                            <div class="form-group">
                                <label for="category">Category</label>
                                <select name="category" class="form-control {{ $errors->has('category') ? 'is-invalid':'' }}">
                                    <option value="" selected disabled hidden>Choose here</option>
                                    <option value="Berita">Berita</option>
                                    <option value="Event">Event</option>
                                    <option value="Otomotif">Otomotif</option>
                                    <option value="Tips & Trik">Tips & Trik</option>
                                    <option value="Review">Review</option>
                                    <option value="Jual Mobil">Jual Mobil</option>
                                    <option value="Beli Mobil">Beli Mobil</option>
                                </select>
                                <p class="text-danger">{{ $errors->first('category') }}</p>
                            </div>
                            <div class="form-group">
                                <label for="tag">Tag</label>
                                <select id="tag" name="tag[]" multiple="multiple" class="form-control {{ $errors->has('tag') ? 'is-invalid':'' }}">
                                    <option value="Life">Life</option>
                                    <option value="Sport">Sport</option>
                                    <option value="Tech">Tech</option>
                                    <option value="Travel">Travel</option>
                                    <option value="Family">Family</option>
                                    <option value="Classic">Classic</option>
                                    <option value="Elegant">Elegant</option>
                                    <option value="Mobil-baru">Mobil-baru</option>
                                    <option value="Tips">Tips</option>
                                    <option value="Otomotif">Otomotif</option>
                                    <option value="Variasi">Variasi</option>
                                    <option value="Mudik">Mudik</option>
                                    <option value="Cargo">Cargo</option>
                                    <option value="Hoby">Hoby</option>
                                    <option value="Event">Event</option>
                                    <option value="Spare-part">Spare-part</option>
                                    <option value="Oli">Oli</option>
                                    <option value="Mesin">Mesin</option>
                                    <option value="Kerusakan">Kerusakan</option>
                                    <option value="Mobil-bekas">Mobil-bekas</option>
                                    <option value="test-drive">test-drive</option>
                                    <option value="Garasi">Garasi</option>
                                </select>
                                <p class="text-danger">{{ $errors->first('tag') }}</p>
                            </div>
                            <div class="form-group">
                                <label for="thumbnail">Thumbnail</label>
                                <input type="file" name="thumbnail" id="thumbnail" class="form-control {{ $errors->has('thumbnail') ? 'is-invalid':'' }}">
                                <p class="text-danger">{{ $errors->first('thumbnail') }}</p>
                            </div>
                            <button class="btn btn-primary btn-lg mt-3 mb-3 float-right"><i class="fas fa-plus-square fa-sm text-white-50"></i> Simpan Blog</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<!-- Select-select -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        $('#tag').select2();
    });
</script>

<!-- Summernote -->
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
<script>
    $(document).ready(function() {
        $('#summernote').summernote({
            height: 300,
            callbacks: {
                // onImageUpload: function(files) {
                //     uploadImage(file[0], editor, welEditable);
                // }
            }
        });


        // function uploadImage(file) {
        //     var data = new FormData();
        //     data.append("image", file);

        //     $.ajax({
        //         url: "{{ url('admin/blog-cm/image') }}",
        //         cache: false,
        //         contentType: false,
        //         processData: false,
        //         data: data,
        //         type: "POST",
        //         success: function(response) {
        //             var image = $('<img>').attr('src', url.url);
        //             $('#summernote').summernote('insertImage', imageUrl);
        //         },
        //         error: function(data) {
        //             console.log(data);
        //         }
        //     });
        // }
    });
</script>
@endpush