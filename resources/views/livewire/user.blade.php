<div>
    <div class="container-fluid px-4">
        <!-- Header Section -->
        <div class="row my-3">
            <div class="col-12">
                <div class="d-flex flex-wrap gap-2">
                    <button wire:click="pilihMenu('lihat')"
                        class="btn {{ $pilihanMenu=='lihat' ? 'btn-primary' : 'btn-outline-primary' }} rounded-pill">
                        <i class="fas fa-users me-1"></i> Semua Pengguna
                    </button>
                    <button wire:click="pilihMenu('tambah')"
                        class="btn {{ $pilihanMenu=='tambah' ? 'btn-primary' : 'btn-outline-primary' }} rounded-pill">
                        <i class="fas fa-user-plus me-1"></i> Tambah Pengguna
                    </button>
                    <button wire:loading class="btn btn-info rounded-pill">
                        <i class="fas fa-spinner fa-spin me-1"></i> Loading...
                    </button>
                </div>
            </div>
        </div>

        <!-- Main Content Section -->
        <div class="row">
            <div class="col-12">
                @if($pilihanMenu == 'lihat')
                <!-- User List Card -->
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-white border-0 py-3">
                        <h5 class="m-0"><i class="fas fa-users me-2"></i>Semua Pengguna</h5>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th class="ps-4">No</th>
                                        <th>Nama</th>
                                        <th>Email</th>
                                        <th>Role</th>
                                        <th class="text-end pe-4">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($semuaPengguna as $pengguna)
                                    <tr>
                                        <td class="ps-4">{{ $loop->iteration }}</td>
                                        <td>{{ $pengguna->name }}</td>
                                        <td>{{ $pengguna->email }}</td>
                                        <td>
                                            <span class="badge bg-{{ $pengguna->role == 'admin' ? 'primary' : 'success' }}">
                                                {{ $pengguna->role }}
                                            </span>
                                        </td>
                                        <td class="text-end pe-4">
                                            <div class="d-flex justify-content-end gap-2">
                                                <button wire:click="pilihEdit({{ $pengguna->id }})"
                                                    class="btn btn-sm {{ $pilihanMenu=='edit' ? 'btn-primary' : 'btn-outline-primary' }} rounded-pill">
                                                    <i class="fas fa-edit me-1"></i> Edit
                                                </button>
                                                <button wire:click="pilihHapus({{ $pengguna->id }})"
                                                    class="btn btn-sm {{ $pilihanMenu=='hapus' ? 'btn-danger' : 'btn-outline-danger' }} rounded-pill">
                                                    <i class="fas fa-trash me-1"></i> Hapus
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                @elseif($pilihanMenu == 'tambah')
                <!-- Add User Card -->
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-white border-0 py-3">
                        <h5 class="m-0"><i class="fas fa-user-plus me-2"></i>Tambah Pengguna</h5>
                    </div>
                    <div class="card-body">
                        <form wire:submit="simpan" class="needs-validation" novalidate>
                            <div class="mb-3">
                                <label class="form-label">Nama</label>
                                <input type="text" class="form-control rounded-pill" wire:model="nama" required>
                                @error('nama')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Email</label>
                                <input type="email" class="form-control rounded-pill" wire:model="email" required>
                                @error('email')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Password</label>
                                <input type="password" class="form-control rounded-pill" wire:model="password" required>
                                @error('password')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                            </div>

                            <div class="mb-4">
                                <label class="form-label">Role</label>
                                <select class="form-select rounded-pill" wire:model="role" required>
                                    <option value="">--Pilih Peran--</option>
                                    <option value="admin">Admin</option>
                                    <option value="kasir">Kasir</option>
                                </select>
                                @error('role')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                            </div>

                            <div class="d-flex justify-content-end gap-2">
                                <button type="submit" class="btn btn-primary rounded-pill px-4">
                                    <i class="fas fa-save me-1"></i> Simpan
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                @elseif($pilihanMenu == 'edit')
                <!-- Edit User Card -->
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-white border-0 py-3">
                        <h5 class="m-0"><i class="fas fa-user-edit me-2"></i>Edit Pengguna</h5>
                    </div>
                    <div class="card-body">
                        <form wire:submit="simpanEdit" class="needs-validation" novalidate>
                            <div class="mb-3">
                                <label class="form-label">Nama</label>
                                <input type="text" class="form-control rounded-pill" wire:model="nama" required>
                                @error('nama')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Email</label>
                                <input type="email" class="form-control rounded-pill" wire:model="email" required>
                                @error('email')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Password (Biarkan kosong jika tidak diubah)</label>
                                <input type="password" class="form-control rounded-pill" wire:model="password">
                                @error('password')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                            </div>

                            <div class="mb-4">
                                <label class="form-label">Role</label>
                                <select class="form-select rounded-pill" wire:model="role" required>
                                    <option value="">--Pilih Peran--</option>
                                    <option value="admin">Admin</option>
                                    <option value="kasir">Kasir</option>
                                </select>
                                @error('role')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                            </div>

                            <div class="d-flex justify-content-end gap-2">
                                <button type="button" wire:click="batal" class="btn btn-outline-secondary rounded-pill px-4">
                                    <i class="fas fa-times me-1"></i> Batal
                                </button>
                                <button type="submit" class="btn btn-primary rounded-pill px-4">
                                    <i class="fas fa-save me-1"></i> Simpan
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                @elseif($pilihanMenu == 'hapus')
                <!-- Delete Confirmation Card -->
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-danger text-white py-3">
                        <h5 class="m-0"><i class="fas fa-exclamation-triangle me-2"></i>Hapus Pengguna</h5>
                    </div>
                    <div class="card-body">
                        <div class="alert alert-warning mb-4">
                            <i class="fas fa-exclamation-circle me-2"></i>
                            Anda yakin ingin menghapus data ini secara permanen?
                        </div>

                        <div class="mb-4">
                            <p><strong>Nama:</strong> {{ $penggunaTerpilih->name }}</p>
                            <p><strong>Email:</strong> {{ $penggunaTerpilih->email }}</p>
                            <p>
                                <strong>Role:</strong>
                                <span class="badge bg-{{ $penggunaTerpilih->role == 'admin' ? 'primary' : 'success' }}">
                                    {{ $penggunaTerpilih->role }}
                                </span>
                            </p>
                        </div>

                        <div class="d-flex justify-content-end gap-2">
                            <button class="btn btn-outline-secondary rounded-pill px-4" wire:click='batal'>
                                <i class="fas fa-times me-1"></i> Batal
                            </button>
                            <button class="btn btn-danger rounded-pill px-4" wire:click='hapus'>
                                <i class="fas fa-trash me-1"></i> Hapus
                            </button>
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>