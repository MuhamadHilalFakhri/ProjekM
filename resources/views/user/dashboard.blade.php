@extends('user.app')

@section('content')
<div class="container py-5">
    <!-- Profil User -->
    <div class="card mb-4 shadow-sm">
        <div class="card-body">
            <h5 class="card-title">Profil Pengguna</h5>
            <p><strong>Nama:</strong> {{ auth()->user()->name }}</p>
            <p><strong>Email:</strong> {{ auth()->user()->email }}</p>
            <p><strong>Role:</strong> {{ auth()->user()->role }}</p>
        </div>
    </div>

    <!-- Tabel Layanan Vera -->
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Daftar Pengajuan Layanan Vera</h5>
        </div>

        <div class="card-body">
            @if($veras->isEmpty())
                <p>Tidak ada data layanan yang diajukan.</p>
            @else
                <div class="table-responsive">
                    <table class="table table-bordered align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>No</th>
                                <th>Tanggal Upload</th>
                                <th>Jam Upload</th>
                                <th>Jenis Layanan</th>
                                <th>Keterangan</th>
                                <th>Status Berkas</th>
                                <th>Lampiran</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($veras as $index => $vera)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $vera->created_at->format('d-m-Y') }}</td>
                                    <td>{{ $vera->created_at->format('H:i') }}</td>
                                    <td>{{ $vera->jenis_layanan }}</td>
                                    <td>{{ $vera->keterangan }}</td>
                                    <td>
                                        <span class="badge bg-secondary">Menunggu</span>
                                    </td>
                                    <td>
                                        <a href="{{ asset('storage/' . $vera->file_path) }}" class="btn btn-sm btn-outline-primary" target="_blank">
                                            Lihat File
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
