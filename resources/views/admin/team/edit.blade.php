@extends('admin.layout')

@section('content')
<div class="container-fluid">

    <!-- Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h4 class="mb-0 text-gray-800">✏️ Edit Member</h4>
    </div>
    <form action="{{ route('admin.team.update', $team->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="name" class="form-label">Nama</label>
            <input type="text" name="name" id="name" class="form-control" required value="{{ old('name', $team->name) }}">
        </div>

        <div class="mb-3">
            <label for="photo" class="form-label">Foto</label>
            @if($team->photo)
                <div class="mb-2">
                    <img src="{{ asset('storage/' . $team->photo) }}" alt="{{ $team->name }}" width="100" height="100" style="object-fit: cover; border-radius: 8px;">
                </div>
            @endif
            <input type="file" name="photo" id="photo" class="form-control" accept="image/*">
            <small class="text-muted">Kosongkan jika tidak ingin mengganti foto</small>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Deskripsi</label>
            <textarea name="description" id="description" rows="4" class="form-control">{{ old('description', $team->description) }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection
