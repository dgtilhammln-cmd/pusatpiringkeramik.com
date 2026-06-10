@extends('layouts.admin')
@section('title','Kelola Testimoni')
@section('page-title','Testimoni')
@section('content')
<div style="display:flex;justify-content:space-between;margin-bottom:1.5rem;">
    <span style="color:#A1A1AA;font-size:0.875rem;">{{ $testimonials->count() }} testimoni</span>
    <a href="{{ route('admin.testimonials.create') }}" class="btn-primary" style="font-size:0.875rem;padding:0.5rem 1.25rem;">+ Tambah Testimoni</a>
</div>
<div class="admin-card" style="padding:0;overflow:hidden;">
    <table style="width:100%;border-collapse:collapse;" class="admin-table">
        <thead><tr><th>Nama</th><th>Perusahaan</th><th>Rating</th><th>Status</th><th>Aksi</th></tr></thead>
        <tbody>
        @forelse($testimonials as $t)
        <tr>
            <td style="font-weight:600;color:#fff;">{{ $t->name }}<br><span style="font-size:0.75rem;color:#A1A1AA;">{{ $t->position }}</span></td>
            <td style="color:#A1A1AA;">{{ $t->company ?: '-' }}</td>
            <td>
                <div style="display:flex;gap:2px;">
                    @for($i=0;$i<5;$i++)<svg width="12" height="12" fill="{{ $i<$t->rating?'#F5A623':'#27272A' }}" viewBox="0 0 24 24"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>@endfor
                </div>
            </td>
            <td><span style="font-size:0.75rem;padding:0.2rem 0.625rem;border-radius:100px;background:{{ $t->is_active?'rgba(34,197,94,0.12)':'rgba(239,68,68,0.12)' }};color:{{ $t->is_active?'#4ade80':'#f87171' }};">{{ $t->is_active?'Aktif':'Nonaktif' }}</span></td>
            <td>
                <div style="display:flex;gap:0.5rem;">
                    <a href="{{ route('admin.testimonials.edit',$t) }}" style="font-size:0.8125rem;color:#F5A623;text-decoration:none;font-weight:600;">Edit</a>
                    <form method="POST" action="{{ route('admin.testimonials.destroy',$t) }}" onsubmit="return confirm('Hapus testimoni ini?')">
                        @csrf @method('DELETE')
                        <button type="submit" style="font-size:0.8125rem;color:#f87171;background:none;border:none;cursor:pointer;font-weight:600;padding:0;">Hapus</button>
                    </form>
                </div>
            </td>
        </tr>
        @empty
        <tr><td colspan="5" style="text-align:center;padding:3rem;color:#A1A1AA;">Belum ada testimoni.</td></tr>
        @endforelse
        </tbody>
    </table>
</div>
@endsection
