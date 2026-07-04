@extends('layouts.admin')
@section('title','Kelola Services')
@section('page-title','Services')
@section('content')
<div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:1.5rem;">
    <span style="color:#A1A1AA;font-size:0.875rem;">{{ $services->count() }} produk/layanan</span>
    <a href="{{ route('admin.services.create') }}" class="btn-primary" style="font-size:0.875rem;padding:0.5rem 1.25rem;">+ Tambah Service</a>
</div>
<div class="admin-card" style="padding:0;overflow:hidden;">
    <table style="width:100%;border-collapse:collapse;" class="admin-table">
        <thead><tr>
            <th>No</th><th>Gambar</th><th>Nama</th><th>Slug</th><th>Urutan</th><th>Status</th><th>Aksi</th>
        </tr></thead>
        <tbody>
            @foreach($services as $s)
            <tr>
                <td style="color:#3F3F46;">{{ str_pad($s->order,2,'0',STR_PAD_LEFT) }}</td>
                <td><img src="{{ $s->image_url }}" alt="{{ $s->name }}" style="width:56px;height:40px;object-fit:cover;border:1px solid #27272A;"></td>
                <td style="font-weight:600;color:#fff;">{{ $s->name }}</td>
                <td style="color:#A1A1AA;font-size:0.8125rem;">{{ $s->slug }}</td>
                <td>{{ $s->order }}</td>
                <td>
                    <span style="font-size:0.75rem;padding:0.2rem 0.625rem;border-radius:100px;background:{{ $s->is_active?'rgba(34,197,94,0.12)':'rgba(239,68,68,0.12)' }};color:{{ $s->is_active?'#4ade80':'#f87171' }};">{{ $s->is_active?'Aktif':'Nonaktif' }}</span>
                </td>
                <td>
                    <div style="display:flex;gap:0.5rem;">
                        <a href="{{ route('admin.services.edit',$s) }}" style="font-size:0.8125rem;color:#F5A623;text-decoration:none;font-weight:600;">Edit</a>
                        <form method="POST" action="{{ route('admin.services.destroy',$s) }}" onsubmit="return confirm('Hapus service ini?')">
                            @csrf @method('DELETE')
                            <button type="submit" style="font-size:0.8125rem;color:#f87171;background:none;border:none;cursor:pointer;font-weight:600;padding:0;">Hapus</button>
                        </form>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
