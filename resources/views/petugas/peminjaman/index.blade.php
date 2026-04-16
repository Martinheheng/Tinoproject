@extends('layouts.petugas')

@section('title', 'Peminjaman Menunggu Persetujuan')

@section('content')
<div class="container">
<h2 class="mb-4">Peminjaman Menunggu Persetujuan</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>No</th>
                    <th>Tanggal Pinjam</th>
                    <th>Rencana Kembali</th>
                    <th>Alat (Jumlah)</th>
                    <th>Total</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($transaksis as $key => $transaksi)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ \Carbon\Carbon::parse($transaksi->tanggal_pinjam)->format('d/m/Y') }}</td>
                    <td>{{ \Carbon\Carbon::parse($transaksi->tanggal_pengembalian)->format('d/m/Y') }}</td>
                    <td>
                        @foreach($transaksi->details as $detail)
                            {{ $detail->alat->nama_alat ?? 'Alat dihapus' }}
                            ({{ $detail->jumlah }})
                            @if(!$loop->last)<br>@endif
                        @endforeach
                    </td>
                    <td>Rp {{ number_format($transaksi->total, 0, ',', '.') }}</td>
                    <td>
                        {{-- STATUS MAPPING YANG BENAR --}}
                        @switch($transaksi->status)
                            @case('menunggu')
                                <span class="badge bg-warning text-dark">Menunggu</span>
                                @break
                            @case('disetujui')
                                <span class="badge bg-success">Disetujui</span>
                                @break
                            @case('dipinjam')
                                <span class="badge bg-primary">Dipinjam</span>
                                @break
                            @case('ditolak')
                                <span class="badge bg-danger">Ditolak</span>
                                @break
                            @case('dibatalkan')
                                <span class="badge bg-secondary">Dibatalkan</span>
                                @break
                            @case('dikembalikan')
                                <span class="badge bg-info">Dikembalikan</span>
                                @break
                            @default
                                <span class="badge bg-dark">{{ ucfirst($transaksi->status) }}</span>
                        @endswitch
                    </td>
                    <td>
                        @if($transaksi->status == 'menunggu')
                            <div class="btn-group" role="group">
                                <form action="{{ route('petugas.peminjaman.approve', $transaksi->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-success" onclick="return confirm('Setujui peminjaman ini? Stok akan dikurangi.')">
                                        <i class="fas fa-check"></i> Setujui
                                    </button>
                                </form>
                                <form action="{{ route('petugas.peminjaman.reject', $transaksi->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Tolak peminjaman ini?')">
                                        <i class="fas fa-times"></i> Tolak
                                    </button>
                                </form>
                            </div>
                        @else
                            <span class="text-muted">Tidak dapat diubah</span>
                        @endif
                    </td>
                </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center">Belum ada peminjaman</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{ $transaksis->links() }}
</div>
@endsection
