@extends('layouts.admin')
@section('css')
<link href="{{ url('assets') }}/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />
<link href="{{ url('assets') }}/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
<link href="{{ url('assets') }}/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />
@endsection
@section('content')
<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0 font-size-18">Karyawan</h4>
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Data Master</a></li>
                    <li class="breadcrumb-item active">Karyawan</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<!-- end page title -->
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Data Karyawan</h4>
                <table id="tableData" class="table table-bordered dt-responsive  nowrap w-100" style="vertical-align: middle;">
                    <thead>
                        <tr>
                            <th>Photo</th>
                            <th>NIK</th>
                            <th>Nama</th>
                            <th>Hp</th>
                            <th>Tgl Lahir</th>
                            <th>Alamat</th>
                            <th>Tgl Gabung</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
        <a type="button" href="{{url('employee/create')}}" class="btn btn-primary waves-effect btn-label waves-light"><i class="bx bx-plus-medical label-icon"></i> Tambah</a>
    </div> <!-- end col -->
</div> <!-- end row -->
<!-- end row -->
@endsection
@section('js')
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap4.min.js"></script>
<script>
    var table;
    $(document).ready(function() {
        table = $('#tableData').DataTable({
            scrollX: true,
            ajax: {
                "url": window.location.href,
                "type": "GET",
                "dataType": "JSON",
                "data": function(data) {
                    data.status = $('#find').val();
                }
            },
            columns: [
                {
                    data: 'photo',
                    render: function(data, type, row) {
                        return '<img src="storage/' + data + '" width="50px" height="50px" />';
                    }
                },
                {
                    data: 'kode_karyawan',

                },
                 {
                    data: 'nama_karyawan',
                }, 
                {
                    data: 'hp',
                }, 
                {
                    data: 'tgl_lahir',
                },
                {
                    data: 'alamat',
                },
                {
                    data: 'tgl_gabung',
                },{
                    data: 'action',
                },
            ]
        });
        $('#find').change(function() {
            table.ajax.reload();
        });
    })
</script>
@endsection