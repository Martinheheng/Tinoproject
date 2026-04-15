@extends('layouts.petugas')

@section('title', 'Daftar Peminjaman Menunggu')

@section('content')
<div class="container">
    <h2 class="mb-4">Riwayat Peminjaman Saya</h2>

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
                            <form action="{{ route('peminjam.peminjaman.cancel', $transaksi->id_peminjaman) }}" method="POST" class="d-inline">
                                @csrf
                                <button class="btn btn-sm btn-warning" onclick="return confirm('Batalkan peminjaman?')">Batalkan</button>
                            </form>
                        @elseif($transaksi->status == 'disetujui')
                            <span class="text-muted">Menunggu pengambilan</span>
                        @elseif($transaksi->status == 'dipinjam')
                            <span class="text-muted">Sedang dipinjam</span>
                        @elseif($transaksi->status == 'dikembalikan')
                            <span class="text-muted">Selesai</span>
                        @else
                            <span class="text-muted">-</span>
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
