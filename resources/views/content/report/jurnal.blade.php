@extends('layouts.admin')

@section('content')
<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0 font-size-18">Jurnal Umum</h4>
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Report</a></li>
                    <li class="breadcrumb-item active">Jurnal Umum</li>
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
                <h4 class="card-title">Cari Berdasarkan : </h4>
                <hr>
                <div class="row">
                    <div class="col-md-6">
                    <div class="mb-3 ">
                        <label for="example-text-input" class="col-md-2 col-form-label">Tahun</label>
                            <select class="form-control" name="year" >
                                    <option value="">Pilih Tahun</option>
                                    <option value="2024">2024</option>
                                    <option value="2025">2025</option>
                                
                                    
                            </select>
                        
                        </div>
                    </div>
                    <div class="col-md-6">
                    <div class="mb-3 ">
                        <label for="example-text-input" class="col-md-2 col-form-label">Bulan</label>
                            <select class="form-control" name="month" >
                                    <option value="">Pilih Bulan</option>
                                    <option value="1">Januari</option>
                                    <option value="2">Februari</option>
                                    <option value="3">Maret</option>
                                    <option value="4">April</option>
                                    <option value="5">Mei</option>
                                    <option value="6">Juni</option>
                                    <option value="7">Juli</option>
                                    <option value="8">Agustus</option>
                                    <option value="9">September</option>
                                    <option value="10">Oktober</option>
                                    <option value="11">November</option>
                                    <option value="12">Desember</option>
                                    
                            </select>
                        
                        </div>
                    </div>
                

                    
                    
                </div>
                <a type="button" href="#" class="btn btn-primary waves-effect btn-label waves-light"><i class="bx bx-plus-medical label-icon"></i> Cari</a>
            
            </div>
        </div>
    </div> <!-- end col -->
</div> <!-- end row -->

<div class="row">
    <div class="col-12">
        <div class="card">
            
            <div class="card-body">
                    <center><h4>JURNAL UMUM</h4></center>
                    <center><h4>PERIODE MARET 2024</h4></center>
                    <hr>
                <table width="100%" id="tableData" class="table table-bordered dt-responsive  nowrap w-100" style="vertical-align: middle;">
                    <thead>
                        <tr>
                            <th width="5%">No Akun</th>
                            <th width="10%">Sub Akun</th>
                            <th width="20%">Nama Akun</th>
                            <th width="20%">Debit</th>
                            <th width="20%">Kredit</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($datas as $item)
                            
                        <tr>
                            <td>{{$item['kode_akun']}}</td>
                            <td>{{$item['sub_akun']}}</td>
                            <td>{{$item['nama_akun']}}</td>
                            <td>1000000</td>
                            <td>0</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            
            </div>
        </div>
    </div> <!-- end col -->
</div> <!-- end row -->
<!-- end row -->
@endsection