@extends('layouts.admin')

@section('content')
<style>
    .thick-hr {
        height: 5px;
        background-color: black;
        border: none;
    }
</style>
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">Laba Rugi</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Report</a></li>
                        <li class="breadcrumb-item active">Laba Rugi</li>
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
                    <form action="" method="POST">
                        @csrf
                        <h4 class="card-title">Cari Berdasarkan : </h4>
                        <hr>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3 ">
                                    <label for="example-text-input" class="col-md-2 col-form-label">Tahun</label>
                                    <select class="form-control" name="year">
                                        <option value="">Pilih Tahun</option>
                                        <option value="2024" {{ $year == '2024' ? 'selected' : '' }}>2024</option>
                                        <option value="2025" {{ $year == '2025' ? 'selected' : '' }}>2025</option>


                                    </select>

                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3 ">
                                    <label for="example-text-input" class="col-md-2 col-form-label">Bulan</label>
                                    <select class="form-control" name="month">
                                        <option value="" {{ $month == '' ? 'selected' : '' }}>Pilih Bulan</option>
                                        <option value="1" {{ $month == '1' ? 'selected' : '' }}>Januari</option>
                                        <option value="2" {{ $month == '2' ? 'selected' : '' }}>Februari</option>
                                        <option value="3" {{ $month == '3' ? 'selected' : '' }}>Maret</option>
                                        <option value="4" {{ $month == '4' ? 'selected' : '' }}>April</option>
                                        <option value="5" {{ $month == '5' ? 'selected' : '' }}>Mei</option>
                                        <option value="6" {{ $month == '6' ? 'selected' : '' }}>Juni</option>
                                        <option value="7" {{ $month == '7' ? 'selected' : '' }}>Juli</option>
                                        <option value="8" {{ $month == '8' ? 'selected' : '' }}>Agustus</option>
                                        <option value="9" {{ $month == '9' ? 'selected' : '' }}>September</option>
                                        <option value="10" {{ $month == '10' ? 'selected' : '' }}>Oktober</option>
                                        <option value="11" {{ $month == '11' ? 'selected' : '' }}>November</option>
                                        <option value="12" {{ $month == '12' ? 'selected' : '' }}>Desember</option>

                                    </select>

                                </div>
                            </div>




                        </div>
                        <button type="submit" class="btn btn-primary waves-effect btn-label waves-light"><i
                                class="bx bx-plus-medical label-icon"></i> Cari</button>
                    </form>
                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->

    <div class="row">
        <div class="col-3"></div> 
        <div class="col-6">
            <div class="card">
                @php
                use Carbon\Carbon;
                    Carbon::setLocale('id');
                @endphp
                <div class="card-body">
                    <center>
                        <h4 style="font-weight: bold">LAPORAN LABA RUGI</h4>
                    </center>
                    <center>
                        <h4 style="font-weight: bold">PERIODE {{ strtoupper(\Carbon\Carbon::parse($year."-".$month."-01")->translatedFormat('F')) }} {{$year}}</h4>
                    </center>
                    <hr>
                    <br>
                    <center>
                    <table style="width: 100%; font-size:10pt"  id="tableData" 
                        style="vertical-align: center; align-text:center">
                      
                        <tbody style="border:1;" >
                            @foreach ($results as $r)
                                <tr style="color:black; font-weight:bold">
                                    <td colspan="3">{{$r['sub']}}</td>
                                </tr>
                                @foreach ($r['content'] as $item)
                                    <tr>
                                        <td >{{$item['akun']}}</td>
                                        <td style="text-align: right">{{"Rp".number_format($item['nominal'],0,",",".")}}</td>
                                        <td ></td>
                                    </tr>
                                @endforeach
                                <tr  style="color:black; font-weight:bold">
                                    <td style="text-align:right">Total {{$r['sub']}} &nbsp&nbsp&nbsp&nbsp</td>
                                    <td></td>
                                    <td style="text-align: right">{{"Rp".number_format($r['total'],0,",",".")}}</td>
                                </tr>
                                <tr  style="color:black; font-weight:bold">
                                    <td colspan="3"><hr></td>
                                   
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    
                    </center>

                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->
    <!-- end row -->
@endsection
