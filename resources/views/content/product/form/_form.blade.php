<div class="mb-3 row">
    <label for="example-text-input" class="col-md-2 col-form-label">Kode Produk</label>
    <div class="col-md-10">
        <input class="form-control" type="text" value="{{ !empty($data) ? $data->kode_produk : old('kode_produk') }}" name="kode_produk" placeholder="Masukkan kode produk ... ">
        {!! $errors->first('kode_produk', '<p class="text-danger">:message</p>') !!}
    
    </div>
</div>

<div class="mb-3 row">
    <label for="example-text-input" class="col-md-2 col-form-label">Nama Produk</label>
    <div class="col-md-10">
        <input class="form-control" type="text" value="{{ !empty($data) ? $data->nama_produk : old('nama_produk') }}" name="nama_produk" placeholder="Masukkan nama produk ... ">
        {!! $errors->first('nama_produk', '<p class="text-danger">:message</p>') !!}
        
    </div>
</div>
<div class="mb-3 row">
    <label for="example-text-input" class="col-md-2 col-form-label">Harga Beli</label>
    <div class="col-md-10">
        <input class="form-control" type="text" value="{{ !empty($data) ? $data->harga_beli : old('harga_beli') }}" name="harga_beli" placeholder="Masukkan Harga Beli ... ">
        {!! $errors->first('harga_beli', '<p class="text-danger">:message</p>') !!}
        
    </div>
</div>
<div class="mb-3 row">
    <label for="example-text-input" class="col-md-2 col-form-label">Harga Jual</label>
    <div class="col-md-10">
        <input class="form-control" type="text" value="{{ !empty($data) ? $data->harga_jual : old('harga_jual') }}" name="harga_jual" placeholder="Masukkan harga Jual ... ">
        {!! $errors->first('harga_jual', '<p class="text-danger">:message</p>') !!}
        
    </div>
</div>
<div class="mb-3 row">
    <label for="example-text-input" class="col-md-2 col-form-label">Upload Gambar</label>
    <div class="col-md-10">
        <input class="form-control" type="file" name="image" >
        {!! $errors->first('image', '<p class="text-danger">:message</p>') !!}
    
    </div>
</div>

<div class="card-body">
    <div class="form-group mb-0 text-end">
        <button type="submit" class="btn btn-primary waves-effect btn-label waves-light"><i class="bx bx-save label-icon"></i>Save</button>
        <a href="{{ URL::previous() }}" class="btn btn-dark waves-effect btn-label waves-light"><i class="bx bx-window-close label-icon"></i>Cancel</a>
    </div>
</div>