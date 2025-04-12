@empty($barang)
    <div id="modal-master" class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Kesalahan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="alert alert-danger">
                    <h5><i class="icon fas fa-ban"></i> Kesalahan!!!</h5>
                    Data yang anda cari tidak ditemukan
                </div>
                <a href="{{ url('/barang') }}" class="btn btn-warning">Kembali</a>
            </div>
        </div>
    </div>
@else
    <form action="{{ route('barang.update_ajax', $barang->barang_id) }}" method="POST" id="form-edit-barang">
        @csrf
        @method('PUT')
        <div id="modal-master" class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Data Barang</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    {{-- Kode Barang --}}
                    <div class="form-group">
                        <label>Kode Barang</label>
                        <input value="{{ $barang->barang_kode }}" type="text" name="barang_kode" id="barang_kode" class="form-control" required>
                        <small id="error-barang_kode" class="error-text form-text text-danger"></small>
                    </div>

                    {{-- Nama Barang --}}
                    <div class="form-group">
                        <label>Nama Barang</label>
                        <input value="{{ $barang->barang_nama }}" type="text" name="barang_nama" id="barang_nama" class="form-control" required>
                        <small id="error-barang_nama" class="error-text form-text text-danger"></small>
                    </div>

                    {{-- Kategori --}}
                    <div class="form-group">
                        <label>Kategori</label>
                        <select name="kategori_id" id="kategori_id" class="form-control" required>
                            <option value="">- Pilih Kategori -</option>
                            @foreach($kategori as $item)
                                <option {{ $item->kategori_id == $barang->kategori_id ? 'selected' : '' }} value="{{ $item->kategori_id }}">{{ $item->kategori_nama }}</option>
                            @endforeach
                        </select>
                        <small id="error-kategori_id" class="error-text form-text text-danger"></small>
                    </div>

                    {{-- Harga Beli --}}
                    <div class="form-group">
                        <label>Harga Beli</label>
                        <input value="{{ $barang->harga_beli }}" type="number" name="harga_beli" id="harga_beli" class="form-control" required>
                        <small id="error-harga_beli" class="error-text form-text text-danger"></small>
                    </div>

                    {{-- Harga Jual --}}
                    <div class="form-group">
                        <label>Harga Jual</label>
                        <input value="{{ $barang->harga_jual }}" type="number" name="harga_jual" id="harga_jual" class="form-control" required>
                        <small id="error-harga_jual" class="error-text form-text text-danger"></small>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" data-dismiss="modal" class="btn btn-warning">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </div>
        </div>
    </form>

    <script>
        $(document).ready(function () {
            $("#form-edit-barang").validate({
                rules: {
                    barang_kode: { required: true, minlength: 3 },
                    barang_nama: { required: true, minlength: 3 },
                    kategori_id: { required: true, number: true },
                    harga_beli: { required: true, number: true },
                    harga_jual: { required: true, number: true },
                },
                submitHandler: function (form) {
                    $.ajax({
                        url: form.action,
                        type: form.method,
                        data: $(form).serialize(),
                        success: function (response) {
                            if (response.status) {
                                $('#myModal').modal('hide');
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Berhasil',
                                    text: response.message
                                });
                                tableBarang.ajax.reload(); 
                            } else {
                                $('.error-text').text('');
                                $.each(response.msgField, function (prefix, val) {
                                    $('#error-' + prefix).text(val[0]);
                                });
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Terjadi Kesalahan',
                                    text: response.message
                                });
                            }
                        }
                    });
                    return false;
                },
                errorElement: 'span',
                errorPlacement: function (error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                },
                highlight: function (element) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function (element) {
                    $(element).removeClass('is-invalid');
                }
            });
        });
    </script>
@endempty
