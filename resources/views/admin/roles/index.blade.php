@extends('layouts.admin')
@section('title','Manajemen Peran & User Admin')
@section('page-title','Manajemen Peran & User Admin')
@section('content')
<div style="max-width:1100px;margin:0 auto;display:flex;flex-direction:column;gap:1.5rem;font-family:'Montserrat',sans-serif;">

    {{-- Page Header --}}
    <div style="display:flex;justify-content:space-between;align-items:center;flex-wrap:wrap;gap:1rem;">
        <div>
            <h1 style="font-size:1.5rem;font-weight:800;color:#1E293B;margin:0 0 .25rem;letter-spacing:-.02em;">
                Manajemen Peran & User Admin
            </h1>
            <p style="font-size:.875rem;color:#64748B;margin:0;">
                Kelola hak akses menu (permissions), tambah user admin baru, ganti password, dan batasi halaman secara ketat.
            </p>
        </div>
        <button type="button" onclick="openModal('modal-add-user')" style="display:inline-flex;align-items:center;gap:0.5rem;background:#0F172A;color:#FFF;font-size:0.875rem;font-weight:700;padding:0.75rem 1.25rem;border-radius:10px;border:none;cursor:pointer;transition:all 0.2s;box-shadow:0 4px 12px rgba(15,23,42,0.15);">
            <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
            Tambah User Admin Baru
        </button>
    </div>

    {{-- Alert Messages --}}
    @if(session('success'))
    <div style="background:#ECFDF5;border:1px solid #A7F3D0;color:#065F46;padding:1rem 1.25rem;border-radius:12px;font-size:0.875rem;font-weight:600;display:flex;align-items:center;gap:0.5rem;">
        <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M22 11.08V12a10 10 0 11-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
        {{ session('success') }}
    </div>
    @endif
    @if(session('error'))
    <div style="background:#FEF2F2;border:1px solid #FCA5A5;color:#991B1B;padding:1rem 1.25rem;border-radius:12px;font-size:0.875rem;font-weight:600;display:flex;align-items:center;gap:0.5rem;">
        <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
        {{ session('error') }}
    </div>
    @endif

    {{-- Users Table Card --}}
    <div style="background:#FFFFFF;border:1px solid #E2E8F0;border-radius:14px;overflow:hidden;box-shadow:0 1px 3px rgba(0,0,0,0.04);">
        <div style="padding:1.25rem 1.5rem;border-bottom:1px solid #F1F5F9;display:flex;align-items:center;justify-content:space-between;">
            <div style="font-size:1rem;font-weight:800;color:#0F172A;">Daftar Pengguna Admin ({{ $users->count() }})</div>
            <div style="font-size:0.75rem;color:#64748B;">User tanpa izin menu tertentu akan mendapatkan error 404 saat akses URL</div>
        </div>

        <div style="overflow-x:auto;">
            <table style="width:100%;border-collapse:collapse;font-size:0.875rem;">
                <thead>
                    <tr style="background:#F8FAFC;border-bottom:1px solid #E2E8F0;text-align:left;color:#475569;font-weight:700;">
                        <th style="padding:0.875rem 1.25rem;width:50px;">#</th>
                        <th style="padding:0.875rem 1.25rem;">Nama & Email</th>
                        <th style="padding:0.875rem 1.25rem;">Peran (Role)</th>
                        <th style="padding:0.875rem 1.25rem;">Hak Akses Menu Allowed</th>
                        <th style="padding:0.875rem 1.25rem;">Status</th>
                        <th style="padding:0.875rem 1.25rem;text-align:right;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $u)
                    <tr style="border-bottom:1px solid #F1F5F9;transition:background 0.15s;" onmouseover="this.style.background='#F8FAFC'" onmouseout="this.style.background='transparent'">
                        <td style="padding:1rem 1.25rem;color:#94A3B8;font-weight:600;">{{ $u->id }}</td>
                        <td style="padding:1rem 1.25rem;">
                            <div style="font-weight:700;color:#0F172A;">{{ $u->name }}</div>
                            <div style="font-size:0.75rem;color:#3B82F6;">{{ $u->email }}</div>
                        </td>
                        <td style="padding:1rem 1.25rem;">
                            @if($u->role === 'superadmin' || $u->id === 1)
                                <span style="display:inline-flex;align-items:center;gap:0.25rem;font-size:0.7rem;font-weight:800;color:#059669;background:#ECFDF5;border:1px solid #A7F3D0;padding:0.2rem 0.6rem;border-radius:50px;">
                                    🛡️ Superadmin
                                </span>
                            @else
                                <span style="display:inline-flex;align-items:center;gap:0.25rem;font-size:0.7rem;font-weight:800;color:#3B82F6;background:#EFF6FF;border:1px solid #BFDBFE;padding:0.2rem 0.6rem;border-radius:50px;">
                                    👤 Admin Custom
                                </span>
                            @endif
                        </td>
                        <td style="padding:1rem 1.25rem;">
                            @if($u->role === 'superadmin' || is_null($u->permissions))
                                <span style="font-size:0.75rem;font-weight:700;color:#059669;background:#ECFDF5;padding:0.25rem 0.6rem;border-radius:6px;">
                                    Akses Semua Menu (Full Access)
                                </span>
                            @else
                                <div style="display:flex;flex-wrap:wrap;gap:0.35rem;max-width:380px;">
                                    @foreach($u->permissions ?? [] as $modKey)
                                        @if(isset($modules[$modKey]))
                                            <span style="font-size:0.6875rem;font-weight:700;color:#334155;background:#F1F5F9;border:1px solid #E2E8F0;padding:0.15rem 0.45rem;border-radius:4px;">
                                                {{ $modules[$modKey] }}
                                            </span>
                                        @endif
                                    @endforeach
                                    @if(empty($u->permissions))
                                        <span style="font-size:0.75rem;color:#94A3B8;font-style:italic;">Tidak ada menu diizinkan (Semua 404)</span>
                                    @endif
                                </div>
                            @endif
                        </td>
                        <td style="padding:1rem 1.25rem;">
                            @if($u->is_active)
                                <span style="font-size:0.7rem;font-weight:700;color:#10B981;background:rgba(16,185,129,0.1);padding:0.2rem 0.6rem;border-radius:50px;">Aktif</span>
                            @else
                                <span style="font-size:0.7rem;font-weight:700;color:#EF4444;background:rgba(239,68,68,0.1);padding:0.2rem 0.6rem;border-radius:50px;">Nonaktif</span>
                            @endif
                        </td>
                        <td style="padding:1rem 1.25rem;text-align:right;">
                            <div style="display:inline-flex;gap:0.5rem;align-items:center;">
                                {{-- Edit Button --}}
                                <button type="button" onclick="openModal('modal-edit-{{ $u->id }}')" style="background:#F1F5F9;color:#334155;border:1px solid #E2E8F0;padding:0.4rem 0.75rem;border-radius:6px;font-weight:700;font-size:0.75rem;cursor:pointer;transition:all 0.2s;" onmouseover="this.style.background='#0F172A';this.style.color='#FFF';" onmouseout="this.style.background='#F1F5F9';this.style.color='#334155';">
                                    Edit Peran
                                </button>

                                {{-- Change Password Button --}}
                                <button type="button" onclick="openModal('modal-pass-{{ $u->id }}')" style="background:#EFF6FF;color:#2563EB;border:1px solid #BFDBFE;padding:0.4rem 0.75rem;border-radius:6px;font-weight:700;font-size:0.75rem;cursor:pointer;transition:all 0.2s;" onmouseover="this.style.background='#2563EB';this.style.color='#FFF';" onmouseout="this.style.background='#EFF6FF';this.style.color='#2563EB';">
                                    Ganti Password
                                </button>

                                {{-- Delete Button --}}
                                @if($u->id !== 1 && $u->id !== session('admin_id'))
                                <form method="POST" action="{{ route('admin.roles.destroy', $u) }}" onsubmit="return confirm('Hapus user admin {{ $u->name }} secara permanen?')" style="margin:0;">
                                    @csrf @method('DELETE')
                                    <button type="submit" style="background:#FEF2F2;color:#DC2626;border:1px solid #FCA5A5;padding:0.4rem 0.65rem;border-radius:6px;font-weight:700;font-size:0.75rem;cursor:pointer;">
                                        Hapus
                                    </button>
                                </form>
                                @endif
                            </div>
                        </td>
                    </tr>

                    {{-- MODAL EDIT USER --}}
                    <div id="modal-edit-{{ $u->id }}" class="custom-modal-overlay" style="display:none;">
                        <div class="custom-modal-box">
                            <div class="custom-modal-header">
                                <h3 style="margin:0;font-size:1rem;font-weight:800;color:#0F172A;">Edit Peran & Hak Akses: {{ $u->name }}</h3>
                                <button type="button" onclick="closeModal('modal-edit-{{ $u->id }}')" class="custom-modal-close">&times;</button>
                            </div>
                            <form method="POST" action="{{ route('admin.roles.update', $u) }}">
                                @csrf @method('PUT')
                                <div class="custom-modal-body">
                                    <div style="display:grid;grid-template-columns:1fr 1fr;gap:1rem;margin-bottom:1rem;">
                                        <div>
                                            <label class="form-label">Nama Lengkap</label>
                                            <input type="text" name="name" value="{{ old('name', $u->name) }}" class="form-input" required>
                                        </div>
                                        <div>
                                            <label class="form-label">Email Admin</label>
                                            <input type="email" name="email" value="{{ old('email', $u->email) }}" class="form-input" required>
                                        </div>
                                    </div>

                                    <div style="display:grid;grid-template-columns:1fr 1fr;gap:1rem;margin-bottom:1.25rem;">
                                        <div>
                                            <label class="form-label">Tipe Peran (Role)</label>
                                            <select name="role" class="form-select" onchange="togglePermsVisibility(this, 'perms-edit-{{ $u->id }}')">
                                                <option value="admin" {{ $u->role === 'admin' ? 'selected' : '' }}>Admin (Custom Permissions)</option>
                                                <option value="superadmin" {{ $u->role === 'superadmin' ? 'selected' : '' }}>Superadmin (Akses Semua Menu)</option>
                                            </select>
                                        </div>
                                        <div style="display:flex;align-items:flex-end;">
                                            <label style="display:flex;align-items:center;gap:0.5rem;cursor:pointer;font-size:0.875rem;font-weight:700;color:#334155;padding-bottom:0.75rem;">
                                                <input type="hidden" name="is_active" value="0">
                                                <input type="checkbox" name="is_active" value="1" {{ $u->is_active ? 'checked' : '' }} style="accent-color:#0F172A;width:18px;height:18px;">
                                                Akun Aktif
                                            </label>
                                        </div>
                                    </div>

                                    <div id="perms-edit-{{ $u->id }}" style="display:{{ $u->role === 'superadmin' ? 'none' : 'block' }};background:#F8FAFC;border:1px solid #E2E8F0;border-radius:12px;padding:1.25rem;margin-bottom:1rem;">
                                        <label style="font-size:0.8125rem;font-weight:800;color:#0F172A;margin-bottom:0.75rem;display:block;">
                                            Ceklis Menu yang Diizinkan (Menu Lainnya Otomatis HILANG & 404 jika diakses URL):
                                        </label>
                                        <div style="display:grid;grid-template-columns:1fr 1fr;gap:0.6rem;">
                                            @foreach($modules as $modKey => $modLabel)
                                                @php
                                                    $isAllowed = is_null($u->permissions) || in_array($modKey, $u->permissions ?? []);
                                                @endphp
                                                <label style="display:flex;align-items:center;gap:0.5rem;font-size:0.8125rem;color:#334155;cursor:pointer;background:#FFF;border:1px solid #CBD5E1;padding:0.5rem 0.75rem;border-radius:8px;">
                                                    <input type="checkbox" name="permissions[]" value="{{ $modKey }}" {{ $isAllowed ? 'checked' : '' }} style="accent-color:#3B82F6;width:16px;height:16px;">
                                                    <strong>{{ $modLabel }}</strong>
                                                </label>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                <div class="custom-modal-footer">
                                    <button type="button" onclick="closeModal('modal-edit-{{ $u->id }}')" style="background:#F1F5F9;color:#64748B;border:none;padding:0.65rem 1.25rem;border-radius:8px;font-weight:700;cursor:pointer;">Batal</button>
                                    <button type="submit" style="background:#0F172A;color:#FFF;border:none;padding:0.65rem 1.25rem;border-radius:8px;font-weight:700;cursor:pointer;">Simpan Perubahan</button>
                                </div>
                            </form>
                        </div>
                    </div>

                    {{-- MODAL GANTI PASSWORD --}}
                    <div id="modal-pass-{{ $u->id }}" class="custom-modal-overlay" style="display:none;">
                        <div class="custom-modal-box" style="max-width:460px;">
                            <div class="custom-modal-header">
                                <h3 style="margin:0;font-size:1rem;font-weight:800;color:#0F172A;">Ganti Password: {{ $u->name }}</h3>
                                <button type="button" onclick="closeModal('modal-pass-{{ $u->id }}')" class="custom-modal-close">&times;</button>
                            </div>
                            <form method="POST" action="{{ route('admin.roles.change_password', $u) }}">
                                @csrf
                                <div class="custom-modal-body">
                                    <div style="margin-bottom:1rem;">
                                        <label class="form-label">Password Baru <span style="color:#EF4444;">*</span></label>
                                        <input type="password" name="password" class="form-input" placeholder="Minimal 6 karakter" required minlength="6">
                                    </div>
                                    <div style="margin-bottom:1rem;">
                                        <label class="form-label">Konfirmasi Password Baru <span style="color:#EF4444;">*</span></label>
                                        <input type="password" name="password_confirmation" class="form-input" placeholder="Ketik ulang password baru" required minlength="6">
                                    </div>
                                </div>
                                <div class="custom-modal-footer">
                                    <button type="button" onclick="closeModal('modal-pass-{{ $u->id }}')" style="background:#F1F5F9;color:#64748B;border:none;padding:0.65rem 1.25rem;border-radius:8px;font-weight:700;cursor:pointer;">Batal</button>
                                    <button type="submit" style="background:#2563EB;color:#FFF;border:none;padding:0.65rem 1.25rem;border-radius:8px;font-weight:700;cursor:pointer;">Update Password</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

{{-- MODAL ADD USER BARU --}}
<div id="modal-add-user" class="custom-modal-overlay" style="display:none;">
    <div class="custom-modal-box">
        <div class="custom-modal-header">
            <h3 style="margin:0;font-size:1rem;font-weight:800;color:#0F172A;">Tambah User Admin Baru</h3>
            <button type="button" onclick="closeModal('modal-add-user')" class="custom-modal-close">&times;</button>
        </div>
        <form method="POST" action="{{ route('admin.roles.store') }}">
            @csrf
            <div class="custom-modal-body">
                <div style="display:grid;grid-template-columns:1fr 1fr;gap:1rem;margin-bottom:1rem;">
                    <div>
                        <label class="form-label">Nama Lengkap <span style="color:#EF4444;">*</span></label>
                        <input type="text" name="name" class="form-input" placeholder="Contoh: Budi Sales Admin" required>
                    </div>
                    <div>
                        <label class="form-label">Email Admin (Login) <span style="color:#EF4444;">*</span></label>
                        <input type="email" name="email" class="form-input" placeholder="admin2@domain.com" required>
                    </div>
                </div>

                <div style="display:grid;grid-template-columns:1fr 1fr;gap:1rem;margin-bottom:1rem;">
                    <div>
                        <label class="form-label">Password Initial <span style="color:#EF4444;">*</span></label>
                        <input type="password" name="password" class="form-input" placeholder="Minimal 6 karakter" required minlength="6">
                    </div>
                    <div>
                        <label class="form-label">Tipe Peran (Role)</label>
                        <select name="role" class="form-select" onchange="togglePermsVisibility(this, 'perms-add-box')">
                            <option value="admin">Admin (Custom Permissions)</option>
                            <option value="superadmin">Superadmin (Akses Semua Menu)</option>
                        </select>
                    </div>
                </div>

                <div id="perms-add-box" style="background:#F8FAFC;border:1px solid #E2E8F0;border-radius:12px;padding:1.25rem;margin-bottom:1rem;">
                    <label style="font-size:0.8125rem;font-weight:800;color:#0F172A;margin-bottom:0.75rem;display:block;">
                        Ceklis Menu yang Diizinkan Dibuka (Menu Lain Dihilangkan & Abort 404):
                    </label>
                    <div style="display:grid;grid-template-columns:1fr 1fr;gap:0.6rem;">
                        @foreach($modules as $modKey => $modLabel)
                            <label style="display:flex;align-items:center;gap:0.5rem;font-size:0.8125rem;color:#334155;cursor:pointer;background:#FFF;border:1px solid #CBD5E1;padding:0.5rem 0.75rem;border-radius:8px;">
                                <input type="checkbox" name="permissions[]" value="{{ $modKey }}" {{ in_array($modKey, ['dashboard','leads','wa']) ? 'checked' : '' }} style="accent-color:#3B82F6;width:16px;height:16px;">
                                <strong>{{ $modLabel }}</strong>
                            </label>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="custom-modal-footer">
                <button type="button" onclick="closeModal('modal-add-user')" style="background:#F1F5F9;color:#64748B;border:none;padding:0.65rem 1.25rem;border-radius:8px;font-weight:700;cursor:pointer;">Batal</button>
                <button type="submit" style="background:#0F172A;color:#FFF;border:none;padding:0.65rem 1.25rem;border-radius:8px;font-weight:700;cursor:pointer;">+ Buat User Admin</button>
            </div>
        </form>
    </div>
</div>

<style>
    .form-label { font-size:0.8rem; font-weight:700; color:#334155; margin-bottom:0.35rem; display:block; }
    .form-input, .form-select { width:100%; border:1.5px solid #CBD5E1; border-radius:8px; padding:0.65rem 0.875rem; font-size:0.875rem; font-family:inherit; outline:none; background:#FFF; transition:all 0.2s; }
    .form-input:focus, .form-select:focus { border-color:#3B82F6; box-shadow:0 0 0 3px rgba(59,130,246,0.15); }
    
    .custom-modal-overlay { position:fixed; inset:0; background:rgba(15,23,42,0.4); backdrop-filter:blur(4px); z-index:99999; display:flex; align-items:center; justify-content:center; padding:1rem; }
    .custom-modal-box { background:#FFF; width:100%; max-width:650px; border-radius:16px; box-shadow:0 20px 40px rgba(0,0,0,0.15); overflow:hidden; display:flex; flex-direction:column; animation:modalIn 0.25s cubic-bezier(0.16,1,0.3,1); }
    .custom-modal-header { padding:1.25rem 1.5rem; background:#F8FAFC; border-bottom:1px solid #E2E8F0; display:flex; align-items:center; justify-content:space-between; }
    .custom-modal-close { background:none; border:none; font-size:1.5rem; color:#64748B; cursor:pointer; }
    .custom-modal-body { padding:1.5rem; max-height:75vh; overflow-y:auto; }
    .custom-modal-footer { padding:1rem 1.5rem; background:#F8FAFC; border-top:1px solid #E2E8F0; display:flex; align-items:center; justify-content:flex-end; gap:0.75rem; }
    
    @keyframes modalIn { from { opacity:0; transform:scale(0.95) translateY(10px); } to { opacity:1; transform:scale(1) translateY(0); } }
</style>

<script>
    function openModal(id) {
        document.getElementById(id).style.display = 'flex';
    }
    function closeModal(id) {
        document.getElementById(id).style.display = 'none';
    }
    function togglePermsVisibility(selectElem, boxId) {
        const box = document.getElementById(boxId);
        if (box) {
            box.style.display = selectElem.value === 'superadmin' ? 'none' : 'block';
        }
    }
</script>
@endsection
