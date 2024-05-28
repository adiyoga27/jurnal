@section('css')
<link href="{{ url('assets') }}/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />
<link href="{{ url('assets') }}/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
<link href="{{ url('assets') }}/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />
<link href="{{ url('assets') }}/libs/select2/css/select2.min.css" rel="stylesheet" type="text/css" />

@endsection
<form action="{{url('transaction')}}" method="POST">
    @csrf
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">

                <h4 class="card-title">Form Transaction</h4>
                <p class="card-title-desc">Input Data Transaction </p>
                <hr>
                <div class="row">
                    <div class="col-md-6 mb-3 ">
                        <label for="example-text-input" class="col-form-label">Customer Nama</label>
                        <input class="form-control" type="text"
                            value="{{ !empty($data) ? $data->customer_nama : old('customer_nama') }}" name="customer_nama"
                            placeholder="Masukkan nama customer ... " required>
                        {!! $errors->first('customer_nama', '<p class="text-danger">:message</p>') !!}

                    </div>
                    <div class="col-md-6 mb-3 ">
                        <label for="example-text-input" class=" col-form-label">Customer Phone</label>
                        <input class="form-control" type="text"
                            value="{{ !empty($data) ? $data->customer_phone : old('customer_phone') }}" name="customer_phone"
                            placeholder="Masukkan nama nomor telepon ... ">
                        {!! $errors->first('customer_phone', '<p class="text-danger">:message</p>') !!}

                    </div>
                </div>
                <div class="col-md-12">
                    <label for="example-text-input" class="col-md-2 col-form-label">Keterangan</label>
                    <textarea class="form-control" name="keterangan" style="height: 100px">{{ !empty($data) ? $data->keterangan : old('keterangan') }}</textarea>
                    {!! $errors->first('keterangan', '<p class="text-danger">:message</p>') !!}
                </div>
                <div class="col-md-12 ">
                    <label for="example-text-input" class="col-form-label">Tgl Bayar</label>
                    <input class="form-control" type="date"
                        value="{{ !empty($data) ? $data->paid_at : old('paid_at') }}" name="paid_at"
                        required>
                    {!! $errors->first('paid_at', '<p class="text-danger">:message</p>') !!}

                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">

                <h4 class="card-title">Detail Pembelian</h4>
                <p class="card-title-desc">List Detail Pembelian Customer </p>
                <a class="btn btn-primary btn-sm addBtn">+ | Tambah Barang</a>

                <hr>
                <table id="tableData" class="table table-bordered dt-responsive  nowrap w-100" style="vertical-align: middle">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Produk</th>
                            {{-- <th>Harga Beli</th> --}}
                            <th>Harga Jual</th>
                            <th>Qty</th>
                            <th>Total</th>
                        </tr>
                        
                    </thead>
                    

                </table>
                <hr>
                <div class="form-group mb-0 text-end">
                    <button type="submit" class="btn btn-primary waves-effect btn-label waves-light"><i
                            class="bx bx-save label-icon"></i>Checkout</button>
                    <a href="{{ URL::previous() }}" class="btn btn-dark waves-effect btn-label waves-light"><i
                            class="bx bx-window-close label-icon"></i>Cancel</a>
                </div>
            </div>
        </div>
    </div>
</div>
</form>

@section('js')
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap4.min.js"></script>
<script src="{{ url('assets') }}/libs/select2/js/select2.min.js"></script>

<script>
    var table;
    $(document).ready(function() {
        table = $('#tableData').DataTable({
            scrollX: true,
            ordering: false,
            searching: false,
            
        });
        $('#find').change(function() {
            table.ajax.reload();
        });
        addRowInit();
    });

    $(".addBtn").click(function(value) {
        console.log(value);
        addRowInit();
    });

    $(".delBtn").click(function(value) {
        table
        .row($(this).parents('tr'))
        .remove()
        .draw();
    });

    function addRowInit(){
        var newRow = table.row.add([
        '<a class="btn btn-danger btn-sm delBtn ">X</a>',
        '<select class="form-control select2" name="product_id[]"><option value="" required>Pilih Produk</option> @foreach ($products as $p) <option value="{{$p->id}}">{{$p->nama_produk}} | Rp{{number_format($p->harga_beli,0,',','.')}}</option>@endforeach</select>',
        // '<input type="number" class="form-control harga_beli" name="harga_beli[]" required>',
        '<input type="number" class="form-control harga_jual" name="harga_jual[]" required>',
        '<input type="number" class="form-control qty"  name="qty[]" required>',
        '<input type="text" class="form-control total" disabled>',
         ]).draw(false); 

        $(newRow.node()).find('.delBtn').click(function() {
            table.row($(this).closest('tr')).remove().draw(false);
        });
        $(newRow.node()).find('.qty').on('input', function() {
            var qty = parseFloat($(this).val());
            var hargaJual = parseFloat($(newRow.node()).find('.harga_jual').val());
            var total = qty * hargaJual;
            $(newRow.node()).find('.total').val(total);
        });

    
        // Initialize Select2
        var select2 = $(newRow.node()).find('.select2').select2();

        // Event listener for Select2 change event
        select2.on('change', function() {
            var selectedProductId = $(this).val();
            // Make AJAX request to fetch harga_beli and harga_jual from API
            $.ajax({
                url: '{{url("api/product-by-id/")}}/'+selectedProductId, // Replace 'your_api_endpoint_here' with your actual API endpoint URL
                method: 'GET',
                success: function(response) {
                    // Update harga_beli and harga_jual input fields with fetched values
                    $(newRow.node()).find('.harga_beli').val(response.data.harga_beli);
                    $(newRow.node()).find('.harga_jual').val(response.data.harga_jual);
                },
                error: function(xhr, status, error) {
                    console.error('Error fetching data from API:', error);
                }
            });
        });
    }

</script>
@endsection
