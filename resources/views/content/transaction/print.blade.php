<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>Dashboard | {{ Auth::user()->role }} </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ url('assets') }}//images/favicon.ico">
    <!-- Bootstrap Css -->
    <link href="{{ url('assets') }}//css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="{{ url('assets') }}//css/icons.min.css" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="{{ url('assets') }}//css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />
    <link href="{{ url('assets') }}/extra-libs/toastr/dist/build/toastr.min.css" rel="stylesheet">
    @yield('css')
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body data-sidebar="dark">
    <div class="container center">
        <div class="col-md-12">
            <div class="container-fluid">
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
                                                    <h4 class="m-0">$1410.00</h4>
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
    </div>
</body>
</html>
