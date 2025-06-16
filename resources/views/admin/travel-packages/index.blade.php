@extends('admin.layout')

@section('content')
<div class="container-fluid">

    <!-- Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-3">
        <h4 class="mb-0 text-gray-800">📦 Daftar Paket Travel</h4>
        <a href="{{ route('admin.travel-packages.create') }}" class="btn btn-sm btn-primary shadow-sm">
            <i class="fa fa-plus me-1"></i> Tambah Paket
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
                            <th>ID</th>
                            <th>Nama Paket</th>
                            <th>Lokasi</th>
                            <th>Durasi</th>
                            <th>Harga</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($travelPackages as $travelPackage)
                            <tr>
                                <td>{{ $travelPackage->id }}</td>
                                <td>{{ $travelPackage->name }}</td>
                                <td>{{ $travelPackage->location }}</td>
                                <td>{{ $travelPackage->duration }}</td>
                                <td>IDR {{ number_format($travelPackage->price, 0, ',', '.') }}</td>
                                <td class="text-center">
                                    <a href="{{ route('admin.travel-packages.edit', $travelPackage) }}" class="btn btn-sm btn-info me-1">
                                        <i class="fa fa-pencil-alt"></i>
                                    </a>
                                    <form action="{{ route('admin.travel-packages.destroy', $travelPackage) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('delete')
                                        <button onclick="return confirm('Yakin ingin menghapus paket ini?')" class="btn btn-sm btn-danger">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted">Belum ada data paket travel.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
@endsection
