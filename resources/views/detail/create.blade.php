@extends('layouts.template')

@section('content')
    <div class="card card-outline card-primary">
        <div class="card-header">
            <h3 class="card-title">{{ $page->title }}</h3>
            <div class="card-tools"></div>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ url('detail') }}" class="form-horizontal">
                @csrf
                <div class="form-group row">
                    <label class="col-2 control-label col-form-label">ID Penjualan</label>
                    <div class="col-10">
                        <select class="form-control" id="penjualan_id" name="penjualan_id" required>
                            <option value="">- Pilih Penjualan -</option>
                            @foreach($penjualan as $item)
                                <option value="{{ $item->penjualan_id }}">{{ $item->penjualan_id }} - {{ $item->tanggal }}</option>
                            @endforeach
                        </select>
                        @error('penjualan_id')
                            <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-2 control-label col-form-label">Barang</label>
                    <div class="col-10">
                        <select class="form-control" id="barang_id" name="barang_id" required>
                            <option value="">- Pilih Barang -</option>
                            @foreach($barang as $item)
                                <option value="{{ $item->barang_id }}">{{ $item->barang_nama }}</option>
                            @endforeach
                        </select>
                        @error('barang_id')
                            <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-2 control-label col-form-label">Harga</label>
                    <div class="col-10">
                        <input type="number" step="0.01" class="form-control" id="harga" name="harga" value="{{ old('harga') }}" required>
                        @error('harga')
                            <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-2 control-label col-form-label">Jumlah</label>
                    <div class="col-10">
                        <input type="number" class="form-control" id="jumlah" name="jumlah" value="{{ old('jumlah', 1) }}" required min="1">
                        @error('jumlah')
                            <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-2 control-label col-form-label"></label>
                    <div class="col-10">
                        <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
                        <a class="btn btn-sm btn-default ml-1" href="{{ url('detail') }}">Kembali</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('css')
@endpush

@push('js')
    <script>
        $(document).ready(function() {
            $('#barang_id').on('change', function() {
            });
        });
    </script>
@endpush