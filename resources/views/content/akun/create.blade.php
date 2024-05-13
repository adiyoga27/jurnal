@extends('layouts.admin')

@section('content')
<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0 font-size-18">Tambah Akun</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Data Master</a></li>
                    <li class="breadcrumb-item">Akun</li>

                    <li class="breadcrumb-item active">Tambah Akun</li>
                </ol>
            </div>

        </div>
    </div>
</div>
<!-- end page title -->

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
               
                <h4 class="card-title">Form Akun</h4>
                <p class="card-title-desc">Input Data Akun </p>
                <hr>
                <form method="POST" action="{{ route('akun.store') }}" enctype="multipart/form-data">
                    @method('POST')

                    @csrf
                    @include('content.akun.form._form')

                </form>

            </div>
        </div>
        <!-- end select2 -->

    </div>


</div>
<!-- end row -->
@endsection