@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Pemantauan Pengembalian</h2>
    @foreach($peminjaman as $p)
    <div class="card mb-3">
        <div class="card-body">
            <h5>{{ optional($p->alat)->nama_alat ?? 'Alat tidak ditemukan' }}</h5>
            <p><strong>Peminjam:</strong> {{ optional($p->user)->name ?? 'User tidak ditemukan' }}</p>
            <p>Tanggal pinjam: {{ $p->tanggal_pinjam }} | Batas kembali: {{ $p->tanggal_kembali ?? '-' }}</p>
            <form action="{{ route('petugas.pengembalian.proses', $p->id) }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-3">
                        <label>Tgl kembali real</label>
                        <input type="date" name="tanggal_kembali_real" class="form-control" required>
                    </div>
                    <div class="col-md-3">
                        <label>Denda (manual)</label>
                        <input type="number" name="denda" class="form-control" value="0">
                    </div>
                    <div class="col-md-4">
                        <label>Catatan</label>
                        <input type="text" name="catatan" class="form-control">
                    </div>
                    <div class="col-md-2 align-self-end">
                        <button class="btn btn-primary">Proses Kembali</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    @endforeach
</div>
@endsection
