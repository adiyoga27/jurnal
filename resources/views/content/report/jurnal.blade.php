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
        <div class="col-12">
            <div class="card">
                @php
                use Carbon\Carbon;
                    Carbon::setLocale('id');
                @endphp
                <div class="card-body">
                    <center>
                        <h4>JURNAL UMUM</h4>
                    </center>
                    <center>
                        <h4>PERIODE {{ strtoupper(\Carbon\Carbon::parse($year."-".$month."-01")->translatedFormat('F')) }} {{$year}}</h4>
                    </center>
                    <hr>
                    <table width="100%" id="tableData" class="table table-bordered dt-responsive  nowrap w-100"
                        style="vertical-align: middle;">
                        <thead>
                            <tr>
                                <th width="5%">Tanggal</th>
                                <th width="5%">Keterangan</th>
                                <th width="20%">Debit</th>
                                <th width="20%">Kredit</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $totalDebit = 0;
                                $totalKredit = 0;
                            @endphp
                            @foreach ($datas as $item)
                         @php
                             
                             $debit = 0;
                                $kredit = 0;
                         @endphp
                                @foreach ($item['contents'] as $index => $c)
                                    @php
                                    $kredit += $c['kredit'];
                                    $debit += $c['debit'];
                                @endphp
                                    <tr>
                                        @if ($index == 0)
                                            <td rowspan="{{ $item['rows'] + 1 }}">{{ $item['tanggal'] }}</td>
                                        @endif
                                        <td>{{ $c['keterangan'] }}</td>
                                        <td>{{ $c['debit'] > 0 ? number_format($c['debit'], 0, ',', '.') : '' }}</td>
                                        <td>{{ $c['kredit'] > 0 ? number_format($c['kredit'], 0, ',', '.') : '' }}</td>

                                    </tr>

                                @php

                                    $totalDebit += $c['debit'];
                                    $totalKredit += $c['kredit'];
                                    
                                @endphp
                                    @if ($index == $item['rows'] - 1)
                                        <tr>
                                            @if ($debit > $kredit)
                                            @php
                                                $totalKredit += ($debit - $kredit);

                                            @endphp
                                                <td>Kas</td>
                                                <td> </td>
                                                <td>{{ number_format($debit - $kredit, 0, ',', '.') }}</td>
                                            @else
                                            @php
                                                 $totalDebit += ($kredit - $debit);

                                            @endphp
                                                <td>Kas</td>
                                                <td>{{ number_format($kredit - $debit, 0, ',', '.') }}</td>
                                                <td> </td>
                                                @endif
                                        </tr>
                                    @endif

                           
                            @endforeach
                            @endforeach
                            <tr>
                                <td colspan="2">Total</td>
                                <td>{{ 'Rp' . number_format($totalDebit, 0, ',', '.') }}</td>
                                <td>{{ 'Rp' . number_format($totalKredit, 0, ',', '.') }}</td>
                            </tr>
                        </tbody>
                    </table>

                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->
    <!-- end row -->
@endsection
