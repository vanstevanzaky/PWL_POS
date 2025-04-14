@extends('layouts.template')
@section('content')
<div class="container-fluid h-100 py-3">
    <div class="row justify-content-center h-100">
        <div class="col-lg-10">
            <div class="card shadow rounded-lg border-0 h-100">
                <div class="row no-gutters h-100">
                    <!-- Sidebar Profil di Sebelah Kiri (1/3 layar) -->
                    <div class="col-md-4 bg-gradient-primary text-white">
                        <div class="d-flex flex-column h-100">
                            <div class="text-center p-4">
                                <div class="profile-image-container mb-3">
                                    @if($user->foto)
                                        <img class="profile-user-img img-fluid img-circle shadow" 
                                            src="{{ asset('storage/' . $user->foto) }}" 
                                            alt="User profile picture" style="width: 120px; height: 120px; object-fit: cover; border: 3px solid rgba(255,255,255,0.7);">
                                    @else
                                        <img class="profile-user-img img-fluid img-circle shadow" 
                                            src="{{ asset('adminlte/dist/img/user2-160x160.jpg') }}"
                                            alt="Default profile picture" style="width: 120px; height: 120px; object-fit: cover; border: 3px solid rgba(255,255,255,0.7);">
                                    @endif
                                </div>
                                <h3 class="profile-username font-weight-bold">{{ $user->nama }}</h3>
                                <p class="mb-0"><span class="badge badge-light text-primary px-3 py-1">{{ $user->getRoleName() }}</span></p>
                            </div>
                            
                            <div class="p-4 border-top border-light">
                                <ul class="list-unstyled">
                                    <li class="mb-2">
                                        <i class="fas fa-user-tag mr-2"></i> <b>Username:</b> {{ $user->username }}
                                    </li>
                                    <li>
                                        <i class="fas fa-layer-group mr-2"></i> <b>Level:</b> {{ $user->getRole() }}
                                    </li>
                                </ul>
                            </div>
                            
                            <div class="mt-auto p-3 text-center">
                                <a href="{{ url('/dashboard') }}" class="btn btn-outline-light btn-sm">
                                    <i class="fas fa-arrow-left mr-1"></i> Kembali ke Dashboard
                                </a>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Content Utama di Sebelah Kanan (2/3 layar) -->
                    <div class="col-md-8">
                        <div class="p-4 h-100 d-flex flex-column">
                            <h4 class="mb-3">
                                <i class="fas fa-camera text-primary mr-2"></i> Kelola Foto Profil
                            </h4>
                            
                            <!-- Kelola Foto Profil yang Compact -->
                            <div class="card card-body bg-light border-0 p-3 mb-2 flex-grow-0">
                                <div class="row">
                                    <!-- Kolom Upload Foto -->
                                    <div class="col-xl-8 mb-2 mb-xl-0">
                                        <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data" class="mb-0">
                                            @csrf
                                            @method('PUT')
                                            <div class="input-group input-group-sm">
                                                <div class="custom-file custom-file-sm">
                                                    <input type="file" name="foto" class="custom-file-input @error('foto') is-invalid @enderror" id="foto">
                                                    <label class="custom-file-label text-truncate" for="foto">Pilih file foto</label>
                                                </div>
                                                <div class="input-group-append">
                                                    <button type="submit" class="btn btn-primary btn-sm">
                                                        <i class="fas fa-upload"></i> Upload
                                                    </button>
                                                </div>
                                            </div>
                                            @error('foto')
                                                <small class="text-danger d-block mt-1">{{ $message }}</small>
                                            @enderror
                                        </form>
                                    </div>
                                    
                                    <!-- Kolom Hapus Foto -->
                                    <div class="col-xl-4">
                                        <form action="{{ url('/profile/remove_foto') }}" method="POST" class="mb-0">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm btn-block {{ $user->foto ? '' : 'disabled' }}">
                                                <i class="fas fa-trash"></i> Hapus Foto
                                            </button>
                                        </form>
                                    </div>
                                </div>
                                
                                <!-- Info Format dalam Satu Baris -->
                                <div class="d-flex justify-content-between align-items-center mt-2">
                                    <small class="text-muted">
                                        <i class="fas fa-info-circle"></i> Format: JPG, JPEG, PNG (Maks: 2MB)
                                    </small>
                                    @if(!$user->foto)
                                    <small class="text-info">
                                        <i class="fas fa-exclamation-circle"></i> Menggunakan foto default
                                    </small>
                                    @endif
                                </div>
                            </div>
                            
                            <!-- Area Kosong yang Fleksibel (bisa diisi konten tambahan di masa depan) -->
                            <div class="flex-grow-1">
                                <!-- Isi dengan konten lain jika diperlukan di masa depan -->
                            </div>
                            
                            <!-- Footer Info -->
                            <div class="text-center text-muted mt-auto">
                                <small>Terakhir diperbarui: {{ now()->format('d M Y H:i') }}</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

