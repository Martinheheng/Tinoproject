@extends('layouts.petugas')

@section('title', 'Laporan Peminjaman')

@section('content')
<div class="container-fluid">
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0"><i class="fas fa-chart-line me-2"></i> Laporan Peminjaman Alat</h5>
        </div>
        <div class="card-body">
            <!-- Form Filter Laporan -->
            <form method="GET" action="{{ route('petugas.laporan.cetak') }}" target="_blank">
                @csrf
                <div class="row g-3">
                    <div class="col-md-3">
                        <label class="form-label">Dari Tanggal</label>
                        <input type="date" name="tanggal_awal" class="form-control" required>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Sampai Tanggal</label>
                        <input type="date" name="tanggal_akhir" class="form-control" required>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Status Peminjaman</label>
                        <select name="status" class="form-select">
                            <option value="">Semua Status</option>
                            <option value="menunggu">Menunggu</option>
                            <option value="disetujui">Disetujui</option>
                            <option value="dipinjam">Dipinjam</option>
                            <option value="dikembalikan">Dikembalikan</option>
                            <option value="ditolak">Ditolak</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">&nbsp;</label>
                        <button type="submit" class="btn btn-success w-100">
                            <i class="fas fa-print me-2"></i> Cetak Laporan PDF
                        </button>
                    </div>
                </div>
            </form>

            <hr class="my-4">

            <!-- Tabel Ringkasan / Statistik Cepat (Opsional) -->
            <div class="row mb-4">
                <div class="col-md-3">
                    <div class="card text-white bg-primary">
                        <div class="card-body">
                            <h6 class="card-title">Total Peminjaman</h6>
                            <h3 class="mb-0">{{ \App\Models\Peminjaman::count() }}</h3>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card text-white bg-warning">
                        <div class="card-body">
                            <h6 class="card-title">Menunggu</h6>
                            <h3 class="mb-0">{{ \App\Models\Peminjaman::where('status', 'menunggu')->count() }}</h3>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card text-white bg-success">
                        <div class="card-body">
                            <h6 class="card-title">Sedang Berlangsung</h6>
                            <h3 class="mb-0">{{ \App\Models\Peminjaman::whereIn('status', ['disetujui', 'dipinjam'])->count() }}</h3>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card text-white bg-secondary">
                        <div class="card-body">
                            <h6 class="card-title">Selesai</h6>
                            <h3 class="mb-0">{{ \App\Models\Peminjaman::where('status', 'dikembalikan')->count() }}</h3>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tabel Data Peminjaman Terbaru (Preview) -->
            <div class="table-responsive">
                <h6 class="fw-bold">10 Transaksi Terakhir</h6>
                <table class="table table-bordered table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>ID</th>
                            <th>Peminjam</th>
                            <th>Tanggal Pinjam</th>
                            <th>Jatuh Tempo</th>
                            <th>Status</th>
                            <th>Petugas</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $recent = \App\Models\Peminjaman::with(['user', 'petugas'])->latest()->limit(10)->get();
                        @endphp
                        @forelse($recent as $item)
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->user->name ?? '-' }}</td>
                            <td>{{ $item->tanggal_pinjam ?? '-' }}</td>
                            <td>{{ $item->tanggal_jatuh_tempo ?? '-' }}</td>
                            <td>
                                @if($item->status == 'menunggu')
                                    <span class="badge bg-warning text-dark">Menunggu</span>
                                @elseif($item->status == 'disetujui')
                                    <span class="badge bg-info">Disetujui</span>
                                @elseif($item->status == 'dipinjam')
                                    <span class="badge bg-primary">Dipinjam</span>
                                @elseif($item->status == 'dikembalikan')
                                    <span class="badge bg-success">Dikembalikan</span>
                                @else
                                    <span class="badge bg-danger">Ditolak</span>
                                @endif
                            </td>
                            <td>{{ $item->petugas->name ?? '-' }}</td>
                        </tr>
                        @empty
                            <tr><td colspan="6" class="text-center">Tidak ada data</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .card .card-title { font-size: 0.9rem; opacity: 0.9; }
    .btn-success:hover { background-color: #1e7e34; }
</style>
@endpush