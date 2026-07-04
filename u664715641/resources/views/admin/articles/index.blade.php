@extends('layouts.admin')
@section('title','Kelola Artikel')
@section('page-title','Artikel')
@section('content')
<div style="display:flex;justify-content:space-between;margin-bottom:1.5rem;">
    <span style="color:#A1A1AA;font-size:0.875rem;">{{ $articles->count() }} artikel</span>
    <a href="{{ route('admin.articles.create') }}" class="btn-primary" style="font-size:0.875rem;padding:0.5rem 1.25rem;">+ Tulis Artikel</a>
</div>
<div class="admin-card" style="padding:0;overflow:hidden;">
    <table style="width:100%;border-collapse:collapse;" class="admin-table">
        <thead><tr>
            <th>Gambar</th><th>Judul</th><th>Kategori</th><th>Tanggal</th><th>Views</th><th>Status</th><th>Aksi</th>
        </tr></thead>
        <tbody>
        @forelse($articles as $a)
        <tr>
            <td><img src="{{ $a->image_url }}" style="width:60px;height:40px;object-fit:cover;border:1px solid #27272A;"></td>
            <td style="font-weight:600;color:#fff;max-width:280px;">
                <div style="overflow:hidden;text-overflow:ellipsis;white-space:nowrap;">{{ $a->title }}</div>
                <div style="font-size:0.75rem;color:#3F3F46;">{{ $a->slug }}</div>
            </td>
            <td style="color:#A1A1AA;">{{ $a->category ?: '-' }}</td>
            <td style="color:#A1A1AA;font-size:0.8125rem;">{{ $a->formatted_date }}</td>
            <td style="color:#A1A1AA;">{{ number_format($a->views) }}</td>
            <td>
                <span style="font-size:0.75rem;padding:0.2rem 0.625rem;border-radius:100px;background:{{ $a->is_published?'rgba(34,197,94,0.12)':'rgba(245,166,35,0.12)' }};color:{{ $a->is_published?'#4ade80':'#F5A623' }};">{{ $a->is_published?'Published':'Draft' }}</span>
            </td>
            <td>
                <div style="display:flex;gap:0.5rem;">
                    <a href="{{ route('articles.show',$a->slug) }}" target="_blank" style="font-size:0.8125rem;color:#A1A1AA;text-decoration:none;">View</a>
                    <a href="{{ route('admin.articles.edit',$a) }}" style="font-size:0.8125rem;color:#F5A623;text-decoration:none;font-weight:600;">Edit</a>
                    <form method="POST" action="{{ route('admin.articles.destroy',$a) }}" onsubmit="return confirm('Hapus artikel ini?')">
                        @csrf @method('DELETE')
                        <button type="submit" style="font-size:0.8125rem;color:#f87171;background:none;border:none;cursor:pointer;font-weight:600;padding:0;">Hapus</button>
                    </form>
                </div>
            </td>
        </tr>
        @empty
        <tr><td colspan="7" style="text-align:center;padding:3rem;color:#A1A1AA;">Belum ada artikel.</td></tr>
        @endforelse
        </tbody>
    </table>
</div>
@endsection
