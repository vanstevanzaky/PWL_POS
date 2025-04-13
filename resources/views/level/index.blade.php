@extends('layouts.template')

@section('content')

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Data Level</h3>
            <div class="card-tools">
                <button onclick="modalAction('{{ route('level.import') }}')" class="btn btn-success">
                    Import Level
                </button>
                <a href="{{ route('level.export_excel') }}" class="btn btn-primary">Export Level</a>
                <button onclick="modalAction('{{ route('level.create_ajax') }}')"
                    class="btn btn-success">TambahAjax</button>
            </div>
        </div>

        <div class="card-body">

            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif

            <table class="table table-bordered table-striped table-hover table-sm" id="tabel_level">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Kode Level</th>
                        <th>Nama Level</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
    <div id="myModal" class="modal fade animate shake" tabindex="-1" role="dialog" databackdrop="static"
        data-keyboard="false" data-width="75%" aria-hidden="true"></div>
@endsection

@push('css')
@endpush

@push('js')
    <script>
        function modalAction(url) {
            $('#myModal').load(url, function () {
                $('#myModal').modal('show');
            });
        }
        var dataLevel;
        $(document).ready(function () {
            dataLevel = $('#tabel_level').DataTable({
                serverSide: true,
                ajax: {
                    "url": "{{ route('level.list') }}",
                    "datatype": "json",
                    "type": "POST"
                },
                columns: [
                    {
                        data: "DT_RowIndex",
                        className: "text-center",
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: "level_kode",
                        className: "",
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: "level_nama",
                        className: "",
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: "aksi",
                        className: "",
                        orderable: false,
                        searchable: false
                    }
                ]
            });
        });
    </script>
@endpush