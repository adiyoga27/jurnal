@extends('layouts.admin')
@section('content')
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0 font-size-18">Dashboard</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboards</a></li>
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-xl-8">
                <div class="row">
                    <div class="col-md-4">
                        <div class="card mini-stats-wid">
                            <div class="card-body">
                                <div class="d-flex">
                                    <div class="flex-grow-1">
                                        <p class="text-muted fw-medium">Pemasukan Bulan Ini</p>
                                        <h4 class="mb-0">Rp {{number_format($debit,0,",",".")}}</h4>
                                    </div>

                                    <div class="flex-shrink-0 align-self-center">
                                        <div class="mini-stat-icon avatar-sm rounded-circle bg-primary">
                                            <span class="avatar-title">
                                                <i class="bx bx-copy-alt font-size-24"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card mini-stats-wid">
                            <div class="card-body">
                                <div class="d-flex">
                                    <div class="flex-grow-1">
                                        <p class="text-muted fw-medium">Pengeluaran Bulan Ini</p>
                                        <h4 class="mb-0">Rp {{number_format($kredit,0,",",".")}}</h4>
                                    </div>

                                    <div class="flex-shrink-0 align-self-center ">
                                        <div class="avatar-sm rounded-circle bg-primary mini-stat-icon">
                                            <span class="avatar-title rounded-circle bg-primary">
                                                <i class="bx bx-archive-in font-size-24"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card mini-stats-wid">
                            <div class="card-body">
                                <div class="d-flex">
                                    <div class="flex-grow-1">
                                        <p class="text-muted fw-medium">Total Kas</p>
                                        <h4 class="mb-0">Rp {{number_format($kas,0,",",".")}}</h4>
                                    </div>

                                    <div class="flex-shrink-0 align-self-center">
                                        <div class="avatar-sm rounded-circle bg-primary mini-stat-icon">
                                            <span class="avatar-title rounded-circle bg-primary">
                                                <i class="bx bx-purchase-tag-alt font-size-24"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end row -->
            </div>
        </div>
        @if (Auth::user()->role == 'manager')
        <div class="row">
            <div class="col-xl-8">
                <div class="row">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex flex-wrap align-items-start">
                                <h5 class="card-title me-2">Omzet Transaksi</h5>
               
                            </div>

                          

                            <hr class="mb-4">
                            
                            <div class="apex-charts" id="area-chart" dir="ltr"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection
@section('js')
        
        <!-- apexcharts -->
        <script src="{{url('assets')}}//libs/apexcharts/apexcharts.min.js"></script>
        @if (Auth::user()->role == 'manager')
        <script>
            var now = {{json_encode($now)}};
            var last = {{json_encode($last)}};
            var options={
                series:[
                    {
                        name:"Current",
                        data:now
                    },
                    {
                        name:"Previous",
                        data:last
                    }
                ],
                chart:
                    {
                        height:350,type:"area",
                        toolbar:
                        {
                            show:!1

                        }
                    },
                colors:["#556ee6","#f1b44c"],
                dataLabels:{
                    enabled:!1
                },
                stroke:{
                    curve:"smooth",
                    width:2
                },
                fill:{
                    type:"gradient",
                    gradient:{
                        shadeIntensity:1,
                        inverseColors:!1,
                        opacityFrom:.45,
                        opacityTo:.05,
                        stops:[20,100,100,100]
                    }
                },
                xaxis:{
                         categories:["Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec"]
                },
                markers:{
                            size:3,strokeWidth:3,hover:{size:4,sizeOffset:2}
                },
                legend:{
                    position:"top",horizontalAlign:"right"
                }
            },
            chart=new ApexCharts(document.querySelector("#area-chart"),options);
            chart.render();
        </script>
        @endif
@endsection