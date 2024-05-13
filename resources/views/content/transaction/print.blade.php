@extends('layouts.admin')
@section('css')
<link href="{{ url('assets') }}/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />
<link href="{{ url('assets') }}/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
<link href="{{ url('assets') }}/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />
@endsection
@section('content')
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                            <h4 class="mb-sm-0 font-size-18">Detail Transaction</h4>
                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Data Master</a></li>
                                    <li class="breadcrumb-item ">Transaction</li>
                                    <li class="breadcrumb-item active">{{$data->noinvoice}}</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="invoice-title">
                                    <h4 class="float-end font-size-16">Order # {{$data->noinvoice}}</h4>
                                    <div class="mb-4">
                                        <img src="{{url('/')}}/assets/images/logo-dark.png" alt="logo" height="20">
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <address>
                                            <strong>Customer:</strong><br>
                                            {{$data->customer_name}}<br>
                                            {{$data->customer_phone}}<br>
                                        </address>
                                    </div>
                                    <div class="col-sm-6 text-sm-end">
                                        <address>
                                            <strong>Order Date:</strong><br>
                                            {{\Carbon\Carbon::parse($data->paid_at)->format('d M Y')}}<br>
                                        </address>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12  text-sm-start">
                                        <address>
                                            <strong>Keterangan:</strong><br>
                                           {{$data->keterangan}}
                                        </address>
                                    </div>
                                   
                                </div>
                                <div class="py-2 mt-3 text-sm-end">
                                    <h3 class="font-size-15 fw-bold">Data Pembelian</h3>
                                </div>
                                <div class="table-responsive">
                                    <table class="table table-nowrap">
                                        <thead>
                                            <tr>
                                                <th style="width: 70px;">No.</th>
                                                <th>Barang</th>
                                                <th>Harga</th>
                                                <th>Jumlah</th>
                                                <th class="text-end">Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($data->Details as $d)
                                                
                                            <tr>
                                                <td>{{ ++$loop->index}}</td>
                                                <td>{{ $d->nama_produk}}</td>
                                                <td>Rp{{ number_format($d->harga_jual,0,",",".")}}</td>
                                                <td>{{ $d->qty}}</td>
                                                <td class="text-end">Rp{{ number_format($d->total,0,",",".")}}</td>
                                            </tr>
                                            @endforeach
                                            
                                         
                                            <tr>
                                                <td colspan="4" class="border-0 text-end">
                                                    <strong>Total</strong>
                                                </td>
                                                <td class="border-0 text-end">
                                                    <h4 class="m-0">Rp{{ number_format($data->total,0,",",".")}}</h4>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="d-print-none">
                                    <div class="float-end">
                                        <a href="{{url('transaction')}}"
                                            class="btn btn-primary waves-effect waves-light"><i
                                            class="fa fa-home"></i> | Back</a>
                                        <a href="javascript:window.print()"
                                            class="btn btn-success w-md  waves-effect waves-light me-1"><i
                                                class="fa fa-print"></i> | Cetak</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end row -->
            </div>
        </div>
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
                sorting: [
                    [0, 'desc']
                ],
                columns: [
                    {
                        data: 'paid_at',
                    
                    }, {
                        data: 'noinvoice',
    
                    }, {
                        data: 'customer_name',
                    },{
                        data: 'customer_phone',
                    },{
                        data: 'total',
                    },{
                        data: 'action',
                        sorting: false
                    },
                ]
            });
            $('#find').change(function() {
                table.ajax.reload();
            });
        })
    </script>
    @endsection
