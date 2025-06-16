@extends('admin.layout')

@section('content')
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-3">
        <h4 class="mb-0 text-gray-800">📝 Daftar Post</h4>
        <a href="{{ route('admin.posts.create') }}" class="btn btn-sm btn-primary shadow-sm">
            <i class="fa fa-plus me-1"></i> Tambah Post
        </a>
    </div>

    <!-- Alert -->
    @if(session('message'))
        <div class="alert alert-info alert-dismissible fade show" role="alert">
            <strong>{{ session('message') }}</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Card & Table -->
    <div class="card shadow-sm border-0">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th width="50">ID</th>
                            <th>Judul</th>
                            <th width="180">Gambar</th>
                            <th class="text-center" width="130">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($posts as $post)
                            <tr>
                                <td>{{ $post->id }}</td>
                                <td>{{ $post->title }}</td>
                                <td>
                                    <img src="{{ Storage::url($post->image) }}" alt="Post Image" class="img-fluid rounded shadow-sm" style="max-height: 100px;">
                                </td>
                                <td class="text-center">
                                    <a href="{{ route('admin.posts.edit', $post) }}" class="btn btn-sm btn-info me-1">
                                        <i class="fa fa-pencil-alt"></i>
                                    </a>
                                    <form action="{{ route('admin.posts.destroy', $post) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('delete')
                                        <button onclick="return confirm('Yakin ingin menghapus post ini?')" class="btn btn-sm btn-danger">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center text-muted">Belum ada post.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
@endsection
