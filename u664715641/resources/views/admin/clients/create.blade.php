@extends('layouts.admin')
@section('title', isset($client) ? 'Edit Klien' : 'Tambah Klien')
@section('page-title', isset($client) ? 'Edit Klien' : 'Tambah Klien Baru')
@section('content')
<div style="max-width:600px;">
<form method="POST" action="{{ isset($client) ? route('admin.clients.update',$client) : route('admin.clients.store') }}" enctype="multipart/form-data">
    @csrf @if(isset($client)) @method('PUT') @endif
    <div style="display:flex;flex-direction:column;gap:1.25rem;">
        <div class="admin-card">
            <h3 style="font-size:0.875rem;font-weight:700;color:#F5A623;text-transform:uppercase;margin:0 0 1.25rem;">Data Klien</h3>
            <div style="display:flex;flex-direction:column;gap:1rem;">
                <div>
                    <label class="form-label">Nama Perusahaan <span style="color:#F5A623;">*</span></label>
                    <input type="text" name="name" value="{{ old('name',$client->name??'') }}" class="form-input" required>
                </div>
                <div style="display:grid;grid-template-columns:1fr 1fr;gap:1rem;">
                    <div>
                        <label class="form-label">Kota</label>
                        <input type="text" name="city" value="{{ old('city',$client->city??'') }}" class="form-input" placeholder="Surabaya, Gresik...">
                    </div>
                    <div>
                        <label class="form-label">Industri</label>
                        <input type="text" name="industry" value="{{ old('industry',$client->industry??'') }}" class="form-input" placeholder="Manufaktur, Logistik...">
                    </div>
                </div>
                <div>
                    <label class="form-label">Logo Perusahaan</label>
                    <input type="file" name="logo" accept="image/*" class="form-input" data-preview="logo-preview">
                    @if(isset($client) && $client->logo)
                    <img id="logo-preview" src="{{ asset('storage/'.$client->logo) }}" style="height:48px;object-fit:contain;margin-top:0.5rem;">
                    @else
                    <img id="logo-preview" src="" style="height:48px;object-fit:contain;margin-top:0.5rem;display:none;">
                    @endif
                    <p style="font-size:0.75rem;color:#3F3F46;margin:0.375rem 0 0;">Auto WebP. Max 2MB.</p>
                </div>
                <div style="display:flex;gap:1.5rem;">
                    <div>
                        <label class="form-label">Urutan</label>
                        <input type="number" name="order" value="{{ old('order',$client->order??0) }}" class="form-input" min="0" style="width:80px;">
                    </div>
                    <div style="display:flex;align-items:flex-end;gap:0.5rem;padding-bottom:0.5rem;">
                        <input type="hidden" name="is_active" value="0">
                        <input type="checkbox" name="is_active" id="is_active" value="1" {{ old('is_active',$client->is_active??true)?'checked':'' }} style="accent-color:#F5A623;">
                        <label for="is_active" style="font-size:0.875rem;color:#D4D4D8;">Tampilkan di website</label>
                    </div>
                </div>
            </div>
        </div>
        <div style="display:flex;gap:0.75rem;">
            <button type="submit" class="btn-primary">Simpan Klien</button>
            <a href="{{ route('admin.clients.index') }}" class="btn-outline">Batal</a>
        </div>
    </div>
</form>
</div>
@endsection
