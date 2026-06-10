@extends('layouts.admin')
@section('title','Kelola Klien')
@section('page-title','Klien & Mitra')
@section('content')
<div style="display:flex;justify-content:space-between;margin-bottom:1.5rem;">
    <span style="color:#A1A1AA;font-size:0.875rem;">{{ $clients->count() }} klien</span>
    <a href="{{ route('admin.clients.create') }}" class="btn-primary" style="font-size:0.875rem;padding:0.5rem 1.25rem;">+ Tambah Klien</a>
</div>
<div class="admin-card" style="padding:0;overflow:hidden;">
    <table style="width:100%;border-collapse:collapse;" class="admin-table">
        <thead><tr><th>Logo</th><th>Nama Perusahaan</th><th>Kota</th><th>Industri</th><th>Urutan</th><th>Status</th><th>Aksi</th></tr></thead>
        <tbody>
        @forelse($clients as $c)
        <tr>
            <td>
                @if($c->logo)
                <img src="{{ asset('storage/'.$c->logo) }}" alt="{{ $c->name }}" style="height:32px;max-width:60px;object-fit:contain;">
                @else
                <div style="width:48px;height:32px;background:#27272A;display:flex;align-items:center;justify-content:center;font-size:0.6875rem;color:#A1A1AA;">No Logo</div>
                @endif
            </td>
            <td style="font-weight:600;color:#fff;">{{ $c->name }}</td>
            <td style="color:#A1A1AA;">{{ $c->city ?: '-' }}</td>
            <td style="color:#A1A1AA;">{{ $c->industry ?: '-' }}</td>
            <td>{{ $c->order }}</td>
            <td><span style="font-size:0.75rem;padding:0.2rem 0.625rem;border-radius:100px;background:{{ $c->is_active?'rgba(34,197,94,0.12)':'rgba(239,68,68,0.12)' }};color:{{ $c->is_active?'#4ade80':'#f87171' }};">{{ $c->is_active?'Aktif':'Nonaktif' }}</span></td>
            <td>
                <div style="display:flex;gap:0.5rem;">
                    <a href="{{ route('admin.clients.edit',$c) }}" style="font-size:0.8125rem;color:#F5A623;text-decoration:none;font-weight:600;">Edit</a>
                    <form method="POST" action="{{ route('admin.clients.destroy',$c) }}" onsubmit="return confirm('Hapus klien ini?')">
                        @csrf @method('DELETE')
                        <button type="submit" style="font-size:0.8125rem;color:#f87171;background:none;border:none;cursor:pointer;font-weight:600;padding:0;">Hapus</button>
                    </form>
                </div>
            </td>
        </tr>
        @empty
        <tr><td colspan="7" style="text-align:center;padding:3rem;color:#A1A1AA;">Belum ada klien.</td></tr>
        @endforelse
        </tbody>
    </table>
</div>
@endsection
