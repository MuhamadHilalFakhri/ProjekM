@extends('user.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h2 class="h4 mb-0">Ajukan Layanan Vera</h2>
                </div>
                
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <!-- <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button> -->
                        </div>
                    @endif

                    <form action="{{ route('vera.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <!-- Nomor Berkas -->
                        <div class="mb-3">
                            <label for="no_berkas" class="form-label">Nomor Berkas</label>
                            <input type="text" class="form-control" id="no_berkas" name="no_berkas" value="{{ 'VERA-' . now()->format('Ymd') }}" readonly disabled>
                        </div>

                        <!-- ID Satker -->
                        <div class="mb-3">
                            <label for="id_satker" class="form-label">ID Satker</label>
                            <input type="text" class="form-control @error('id_satker') is-invalid @enderror" 
                                   id="id_satker" name="id_satker" 
                                   value="{{ $userNip ?? Auth::user()->nip }}" readonly required>
                            @error('id_satker')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Jenis Layanan -->
                        <div class="mb-3">
                            <label for="jenis_layanan" class="form-label">Jenis Layanan</label>
                            <select class="form-select @error('jenis_layanan') is-invalid @enderror" 
                                    name="jenis_layanan" id="jenis_layanan" required>
                                <option value="">-- Pilih Jenis Layanan --</option>
                                @foreach($jenis_layanan as $layanan)
                                    <option value="{{ $layanan }}" {{ old('jenis_layanan') == $layanan ? 'selected' : '' }}>
                                        {{ $layanan }}
                                    </option>
                                @endforeach
                            </select>
                            @error('jenis_layanan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Keterangan -->
                        <div class="mb-3">
                            <label for="keterangan" class="form-label">Keterangan</label>
                            <textarea class="form-control @error('keterangan') is-invalid @enderror" 
                                      id="keterangan" name="keterangan" rows="3">{{ old('keterangan') }}</textarea>
                            @error('keterangan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Upload File -->
                        <div class="mb-4">
                            <label for="file_upload" class="form-label">Upload File</label>
                            <input class="form-control @error('file_upload') is-invalid @enderror" 
                                   type="file" name="file_upload" id="file_upload" required>
                            @error('file_upload')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <div class="form-text">Format file yang didukung: PDF, DOC, DOCX, XLS, XLSX, JPG, PNG</div>
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary btn-lg">
                                <i class="bi bi-send-fill me-2"></i>Kirim Pengajuan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection