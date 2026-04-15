@extends('layouts.petugas')

@section('title', 'Pantau Pengembalian')

@section('content')
<div class="card">
    <div class="card-header bg-warning">
        <h5>Daftar Peminjaman Aktif (Perlu Dikembalikan)</h5>
    </div>
    <div class="card-body">
        @if($peminjaman->isEmpty())
            <div class="alert alert-info">Tidak ada peminjaman yang sedang berlangsung.</div>
        @else
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Peminjam</th>
                            <th>Tgl Pinjam</th>
                            <th>Jatuh Tempo</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($peminjaman as $key => $item)
                        <tr>
                            <td>{{ $key+1 }}</td>
                            <td>{{ $item->user->name ?? '-' }}</td>
                            <td>{{ $item->tanggal_pinjam ?? '-' }}</td>
                            <td>{{ $item->tanggal_jatuh_tempo ?? '-' }}</td>
                            <td><span class="badge bg-info">{{ $item->status }}</span></td>
                            <td>
                                <!-- Tombol untuk memproses pengembalian (bisa modal atau form) -->
                                <button type="button" class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#modalKembali{{ $item->id }}">
                                    Proses Kembali
                                </button>

                                <!-- Modal form pengembalian -->
                                <div class="modal fade" id="modalKembali{{ $item->id }}" tabindex="-1">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <form method="POST" action="{{ route('petugas.pengembalian.proses', $item->id) }}">
                                                @csrf
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Proses Pengembalian</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="mb-3">
                                                        <label>Tanggal Kembali Real</label>
                                                        <input type="date" name="tanggal_kembali_real" class="form-control" value="{{ date('Y-m-d') }}" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label>Denda (jika ada)</label>
                                                        <input type="number" name="denda" class="form-control" value="0">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label>Catatan</label>
                                                        <textarea name="catatan" class="form-control" rows="2"></textarea>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</div>
@endsection