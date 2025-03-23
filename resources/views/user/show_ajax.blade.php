@if(empty($user))
    <div class="modal-master-error modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Kesalahan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="alert alert-danger">
                    <h5><i class="icon fas fa-ban"></i> Kesalahan!!!</h5>
                    Data yang Anda cari tidak ditemukan
                </div>
                <a href="{{ url('/user') }}" class="btn btn-warning">Kembali</a>
            </div>
        </div>
    </div>
@else
    <div id="form-show">
        <div class="modal-master-show modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Detail Data User</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table class="table table-sm table-bordered table-striped">
                        <tr>
                            <th class="text-right col-3">Level Pengguna :</th>
                            <td class="col-9" id="user-level">{{ $user->level->level_nama }}</td>
                        </tr>
                        <tr>
                            <th class="text-right col-3">Username :</th>
                            <td class="col-9" id="user-username">{{ $user->username }}</td>
                        </tr>
                        <tr>
                            <th class="text-right col-3">Nama :</th>
                            <td class="col-9" id="user-nama">{{ $user->nama }}</td>
                        </tr>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" data-dismiss="modal" class="btn btn-warning">Kembali</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function () {
            $.ajax({
                url: '{{ route('user.show_ajax', $user->user_id) }}',
                type: 'GET',
                success: function (response) {
                    if (response.status) {
                        $('#user-level').text(response.data.level);
                        $('#user-username').text(response.data.username);
                        $('#user-nama').text(response.data.nama);
                    } else {
                        $('#data-container').html('<div class="alert alert-danger">Data yang Anda cari tidak ditemukan</div>');
                    }
                },
                error: function () {
                    $('#data-container').html('<div class="alert alert-danger">Terjadi kesalahan saat mengambil data</div>');
                }
            });
        });
    </script>
@endif
