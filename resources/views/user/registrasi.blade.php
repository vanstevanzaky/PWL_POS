<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Registrasi Pengguna</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('adminlte/dist/css/adminlte.min.css') }}">
    <style>
        .login-box {
            width: 600px;
            max-width: 90%;
        }
    </style>

</head>

<body class="hold-transition login-page">
    <div class="login-box">
        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <a href="{{ url('/') }}" class="h1"><b>Admin</b>LTE</a>
            </div>
            <div class="card-body">
                <p class="login-box-msg">Form Registrasi Pengguna Baru</p>
                <form method="POST" action="{{ url('user/storeRegister') }}" class="form-horizontal">
                    @csrf

                    <!-- Level -->
                    <div class="form-group row">
                        <label class="col-3 col-form-label">Level</label>
                        <div class="col-9">
                            <select class="form-control" id="level_id" name="level_id" required>
                                <option value="">- Pilih Level -</option>
                                @foreach($level as $item)
                                    <option value="{{ $item->level_id }}">{{ $item->level_nama }}</option>
                                @endforeach
                            </select>
                            @error('level_id')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <!-- Username -->
                    <div class="form-group row">
                        <label class="col-3 col-form-label">Username</label>
                        <div class="col-9">
                            <input type="text" class="form-control" id="username" name="username"
                                value="{{ old('username') }}" required placeholder="Masukkan username">
                            @error('username')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <!-- Nama -->
                    <div class="form-group row">
                        <label class="col-3 col-form-label">Nama</label>
                        <div class="col-9">
                            <input type="text" class="form-control" id="nama" name="nama" value="{{ old('nama') }}"
                                required placeholder="Masukkan nama lengkap">
                            @error('nama')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <!-- Password -->
                    <div class="form-group row">
                        <label class="col-3 col-form-label">Password</label>
                        <div class="col-9">
                            <input type="password" class="form-control" id="password" name="password" required
                                placeholder="Masukkan password">
                            @error('password')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <!-- Tombol -->
                    <div class="form-group row">
                        <div class="offset-3 col-9">
                            <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
                            <a class="btn btn-sm btn-default ml-1" href="{{ url('user') }}">Kembali</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

</body>

</html>