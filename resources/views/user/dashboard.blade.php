@extends('user.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Dashboard Layanan</h2>

    <div class="row">
        <div class="col-md-12">
            <ul class="nav nav-tabs" id="layananTabs" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="semua-tab" data-toggle="tab" href="#semua" role="tab">Semua</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="vera-tab" data-toggle="tab" href="#vera" role="tab">Layanan Vera</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="pd-tab" data-toggle="tab" href="#pd" role="tab">Layanan PD</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="mski-tab" data-toggle="tab" href="#mski" role="tab">Layanan MSKI</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="bank-tab" data-toggle="tab" href="#bank" role="tab">Layanan Bank</a>
                </li>
            </ul>

            <div class="tab-content p-3 border border-top-0 rounded-bottom" id="layananTabsContent">
                <!-- Tab Semua -->
                <div class="tab-pane fade show active" id="semua" role="tabpanel">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>ID Satker</th>
                                    <th>Jenis Layanan</th>
                                    <th>Keterangan</th>
                                    <th>File</th>
                                    <th>Tanggal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($allRequests as $request)
                                    <tr>
                                        <td>{{ $request->id_satker }}</td>
                                        <td>{{ $request->layanan_type . ' - ' . $request->jenis_layanan }}</td>
                                        <td>{{ $request->keterangan ?? '-' }}</td>
                                        <td>
                                            @if($request->file_path)
                                                <a href="{{ asset('storage/'.$request->file_path) }}" target="_blank">Lihat File</a>
                                            @else
                                                -
                                            @endif
                                        </td>
                                        <td>{{ $request->created_at->format('d/m/Y H:i') }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center">Tidak ada data layanan</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Tab Vera -->
                <div class="tab-pane fade" id="vera" role="tabpanel">
                    <!-- Tetap sama seperti sebelumnya -->
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>ID Satker</th>
                                    <th>Jenis Layanan</th>
                                    <th>Keterangan</th>
                                    <th>File</th>
                                    <th>Tanggal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($veraRequests as $request)
                                    <tr>
                                        <td>{{ $request->id_satker }}</td>
                                        <td>{{ $request->jenis_layanan }}</td>
                                        <td>{{ $request->keterangan ?? '-' }}</td>
                                        <td>
                                            @if($request->file_path)
                                                <a href="{{ asset('storage/'.$request->file_path) }}" target="_blank">Lihat File</a>
                                            @else
                                                -
                                            @endif
                                        </td>
                                        <td>{{ $request->created_at->format('d/m/Y H:i') }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center">Tidak ada data layanan Vera</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Tab PD -->
                <div class="tab-pane fade" id="pd" role="tabpanel">
                    <!-- Tetap sama seperti sebelumnya -->
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>ID Satker</th>
                                    <th>Jenis Layanan</th>
                                    <th>Keterangan</th>
                                    <th>File</th>
                                    <th>Tanggal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($pdRequests as $request)
                                    <tr>
                                        <td>{{ $request->id_satker }}</td>
                                        <td>{{ $request->jenis_layanan }}</td>
                                        <td>{{ $request->keterangan ?? '-' }}</td>
                                        <td>
                                            @if($request->file_path)
                                                <a href="{{ asset('storage/'.$request->file_path) }}" target="_blank">Lihat File</a>
                                            @else
                                                -
                                            @endif
                                        </td>
                                        <td>{{ $request->created_at->format('d/m/Y H:i') }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center">Tidak ada data layanan PD</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Tab MSKI -->
                <div class="tab-pane fade" id="mski" role="tabpanel">
                    <!-- Tetap sama seperti sebelumnya -->
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>ID Satker</th>
                                    <th>Jenis Layanan</th>
                                    <th>Keterangan</th>
                                    <th>File</th>
                                    <th>Tanggal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($mskiRequests as $request)
                                    <tr>
                                        <td>{{ $request->id_satker }}</td>
                                        <td>{{ $request->jenis_layanan }}</td>
                                        <td>{{ $request->keterangan ?? '-' }}</td>
                                        <td>
                                            @if($request->file_path)
                                                <a href="{{ asset('storage/'.$request->file_path) }}" target="_blank">Lihat File</a>
                                            @else
                                                -
                                            @endif
                                        </td>
                                        <td>{{ $request->created_at->format('d/m/Y H:i') }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center">Tidak ada data layanan MSKI</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Tab Bank -->
                <div class="tab-pane fade" id="bank" role="tabpanel">
                    <!-- Tetap sama seperti sebelumnya -->
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>ID Satker</th>
                                    <th>Jenis Layanan</th>
                                    <th>Keterangan</th>
                                    <th>File</th>
                                    <th>Tanggal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($bankRequests as $request)
                                    <tr>
                                        <td>{{ $request->id_satker }}</td>
                                        <td>{{ $request->jenis_layanan }}</td>
                                        <td>{{ $request->keterangan ?? '-' }}</td>
                                        <td>
                                            @if($request->file_path)
                                                <a href="{{ asset('storage/'.$request->file_path) }}" target="_blank">Lihat File</a>
                                            @else
                                                -
                                            @endif
                                        </td>
                                        <td>{{ $request->created_at->format('d/m/Y H:i') }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center">Tidak ada data layanan Bank</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection