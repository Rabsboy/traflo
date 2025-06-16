@extends('admin.layout')

@section('content')
<div class="container-fluid">

    <!-- Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h4 class="mb-0 text-gray-800">🛠️ Edit Link Laman</h4>
    </div>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ url('admin/footer/update') }}" method="POST">
        @csrf
    
        <div class="mb-3">
            <label for="tagline" class="form-label">Tagline</label>
            <input type="text" id="tagline" name="tagline" class="form-control" value="{{ old('tagline', $data['tagline'] ?? '') }}" required>
        </div>

        <div class="mb-3">
            <label for="facebook" class="form-label">Facebook URL</label>
            <input type="url" id="facebook" name="facebook" class="form-control" value="{{ old('facebook', $data['facebook'] ?? '') }}">
        </div>

        <div class="mb-3">
            <label for="instagram" class="form-label">Instagram URL</label>
            <input type="url" id="instagram" name="instagram" class="form-control" value="{{ old('instagram', $data['instagram'] ?? '') }}">
        </div>

        <div class="mb-3">
            <label for="youtube" class="form-label">Youtube URL</label>
            <input type="url" id="youtube" name="youtube" class="form-control" value="{{ old('youtube', $data['youtube'] ?? '') }}">
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" id="email" name="email" class="form-control" value="{{ old('email', $data['email'] ?? '') }}">
        </div>

        <div class="mb-3">
            <label for="address" class="form-label">Alamat</label>
            <textarea id="address" name="address" class="form-control" rows="3">{{ old('address', $data['address'] ?? '') }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">Simpan Footer</button>
    </form>
</div>
@endsection
