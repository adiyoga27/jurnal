@extends('layouts.admin')

@section('content')
<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0 font-size-18">Tambah Transaction</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Data Master</a></li>
                    <li class="breadcrumb-item">Transaction</li>

                    <li class="breadcrumb-item active">Tambah Transaction</li>
                </ol>
            </div>

        </div>
    </div>
</div>
<!-- end page title -->

                <form method="POST" action="{{ route('transaction.store') }}" enctype="multipart/form-data">
                    @method('POST')

                    @csrf
                    @include('content.transaction.form._form')

                </form>

   


<!-- end row -->
@endsection