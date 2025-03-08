<!DOCTYPE html>
<html>
<head>
    <title>Data User</title>
</head>
<body>
    <h1>Data User</h1>
    <a href="user/tambah">+ tambah user</a>
    <table border="1" cellpadding="2" cellspacing="0">
        <tr>
            <th>ID</th>
            <th>Username</th>
            <th>Nama</th>
            <th>ID Level Pengguna</th>
            <td>Aksi</td>
        </tr>
        @foreach ($data as $dt)
            
        <tr>
            <td>{{ $dt->user_id }}</td>
            <td>{{ $dt->username }}</td>
            <td>{{ $dt->nama }}</td>
            <td>{{ $dt->level_id }}</td>
            <td><a href="/user/ubah/{{ $dt->user_id }}">Ubah"></a> | <a href="/user/hapus/{{ $dt->user_id }}">Hapus</td>
        </tr>
        @endforeach
    </table>
</body>
</html>
