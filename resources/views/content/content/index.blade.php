@extends('layouts.admin')
@section('content')
<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0 font-size-18">Iklan</h4>
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Data</a></li>
                    <li class="breadcrumb-item active">Iklan</li>

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
                <label>Status </label>
                <select class="form-control find" id="find">
                    <option value="pending">Pending</option>
                    <option value="accept">Valid</option>
                    <option value="decline">Tidak Valid</option>

                </select>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Data Iklan</h4>
                <table id="tableData" class="table table-bordered dt-responsive  nowrap w-100">
                    <thead>
                        <tr>
                            <th>Action</th>
                            <th>Date</th>
                            <th>Member</th>
                            <th>Deskripsi</th>
                            <th>Harga</th>
                            <th>Image</th>
                            <th>Note</th>

                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div> <!-- end col -->

</div> <!-- end row -->


<!-- end row -->
@endsection
@section('js')
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
                    data: 'action',
                    render: function(data, type, row) {
                        var action = "";
                        if (row['validated'] == 'pending') {
                            action += "<a type='button' class='btn btn-warning editBtn' id='editBtn' href='"+window.location.href+"/"+row['id']+"/edit'>Edit</a> ";

                            action += "<a type='button' class='btn btn-success approveBtn' id='approveBtn' onclick='approve(" + row['id'] + ")'>Approve</a> ";
            
                            action += "<a type='button' class='btn btn-danger declineBtn' id='declineBtn' onclick='decline(" + row['id'] + ")'> Tolak </a>";
                        }else{
                            action += "-";
                        }
                        
                        // if (row['validated'] == 'pending' || row['validated'] == 'decline') {
                        //     action += "<a type='button' class='btn btn-warning editBtn' id='editBtn' href='"+window.location.href+"/"+row['id']+"/edit'>Edit</a> ";

                        //     action += "<a type='button' class='btn btn-success approveBtn' id='approveBtn' onclick='approve(" + row['id'] + ")'>Approve</a> ";
                        // }
                        // if (row['validated'] == 'pending' || row['validated'] == 'accept') {
                        //     action += "<a type='button' class='btn btn-danger declineBtn' id='declineBtn' onclick='decline(" + row['id'] + ")'> Tolak </a>";
                        // }
                        return action;
                    }
                },
                {
                    data: 'date',
                }, {
                    data: 'member',
                }, {
                    data: 'description',
                }, {
                    data: 'amount',
                }, {
                    data: 'image',
                    render: function(data, type, row) {
                        return '<a href="{{url("storage")}}/' + data + '" target="_blank" rel="noopener noreferrer"><img src="{{url("storage")}}/' + data + '" width="100px" height="100px" /></a>';
                    }
                },{
                    data: 'decline_note',
                }
                
            ]
        });

        $('#find').change(function() {
            table.ajax.reload();
        });

    })

</script>
@endsection