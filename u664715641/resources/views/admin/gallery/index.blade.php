@extends('layouts.admin')
@section('title','Galeri Proyek')
@section('page-title','Galeri Proyek')
@section('content')
<div style="display:flex;justify-content:space-between;margin-bottom:1.5rem;">
    <span style="color:#A1A1AA;font-size:0.875rem;">{{ $items->count() }} foto</span>
    <a href="{{ route('admin.gallery.create') }}" class="btn-primary" style="font-size:0.875rem;padding:0.5rem 1.25rem;">+ Tambah Foto</a>
</div>
<div style="display:grid;grid-template-columns:repeat(4,1fr);gap:1rem;">
    @foreach($items as $item)
    <div style="background:#18181B;border:1px solid #27272A;overflow:hidden;">
        <div style="aspect-ratio:4/3;overflow:hidden;position:relative;">
            <img src="{{ $item->image_url }}" alt="{{ $item->title }}" style="width:100%;height:100%;object-fit:cover;">
            <div style="position:absolute;top:0.5rem;right:0.5rem;">
                <span style="font-size:0.625rem;background:{{ $item->is_active?'rgba(34,197,94,0.9)':'rgba(239,68,68,0.9)' }};color:#fff;padding:0.15rem 0.5rem;font-weight:700;">{{ $item->is_active?'ON':'OFF' }}</span>
            </div>
        </div>
        <div style="padding:0.875rem;">
            <div style="font-size:0.875rem;font-weight:600;color:#fff;margin-bottom:0.25rem;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;">{{ $item->title }}</div>
            <div style="font-size:0.75rem;color:#A1A1AA;margin-bottom:0.75rem;">{{ $item->category }}</div>
            <div style="display:flex;gap:0.75rem;">
                <a href="{{ route('admin.gallery.edit',$item) }}" style="font-size:0.8125rem;color:#F5A623;text-decoration:none;font-weight:600;">Edit</a>
                <form method="POST" action="{{ route('admin.gallery.destroy',$item) }}" onsubmit="return confirm('Hapus foto ini?')">
                    @csrf @method('DELETE')
                    <button type="submit" style="font-size:0.8125rem;color:#f87171;background:none;border:none;cursor:pointer;font-weight:600;padding:0;">Hapus</button>
                </form>
            </div>
        </div>
    </div>
    @endforeach
</div>
@endsection
