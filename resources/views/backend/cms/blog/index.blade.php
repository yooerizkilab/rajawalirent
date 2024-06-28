@extends('layouts.backend.app',[
'title' => 'Blog CRM'
])

@section('content')

<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Blog Manajement</h1>
        <a href="{{ url('admin/blog-cms/create') }}" class="d-none d-sm-inline-block btn btn-md btn-primary shadow-sm"><i class="fas fa-plus-square fa-sm text-white-50"></i> Tamabah Blog</a>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="offset-md-9 col-md-3 mb-4">
                        <form action="{{ url('admin/blog-cms') }}" method="get">
                            <input type="text" name="q" class="form-control" placeholder="Cari data..." value="{{ request()->q }}">
                        </form>
                    </div>

                    @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert"">
                        {{ session('success') }}
                        <button type=" button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    @endif

                    <div class="table-responsive">
                        <table class="table table-hover table-bordered" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Title</th>
                                    <th>Author</th>
                                    <th>Published</th>
                                    <th>Category</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($blog as $key => $item)
                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td>{{ $item->title }}</td>
                                    <td>{{ $item->author }}</td>
                                    <td>{{ $item->published_at }}</td>
                                    <td>{{ $item->category }}</td>
                                    <td>
                                        <a href="{{ url('blog', $item->slug) }}" class="btn btn-info">View</a>
                                        <a href="{{ url('admin/blog-cms/edit', $item->id) }}" class="btn btn-warning">Edit</a>
                                        <form action="{{ url('admin/blog-cms/delete/', $item->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="7" class="text-center">Tidak ada data</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="float-right">
                        {!! $blog->links() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection