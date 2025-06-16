@extends('admin.layout')

@section('content')
<div class="container-fluid">

    <!-- Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h4 class="mb-0 text-gray-800">👨‍👦‍👦 Tim Kami</h4>
    </div>
    <a href="{{ route('admin.team.create') }}" class="btn btn-success mb-3">🛠️ Tambah Member</a>

    @if(session('success'))
      <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Foto</th>
                <th>Nama</th>
                <th>Deskripsi</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($teams as $team)
            <tr>
                <td>
                    @if($team->photo)
                        <img src="{{ asset('storage/' . $team->photo) }}" alt="{{ $team->name }}" width="80" height="80" style="object-fit: cover; border-radius: 8px;">
                    @endif
                </td>
                <td>{{ $team->name }}</td>
                <td>{{ $team->description }}</td>
                <td>
                    <a href="{{ route('admin.team.edit', $team->id) }}" class="btn btn-primary btn-sm">Edit</a>

                    <form action="{{ route('admin.team.destroy', $team->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus?')">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
