<div class="mb-3 row">
    <label for="example-text-input" class="col-md-2 col-form-label">Tanggal Transaksi</label>
    <div class="col-md-10">
        <input class="form-control" type="date" value="{{ !empty($data) ? $data->tgl_transaksi : old('tgl_transaksi') }}" name="tgl_transaksi">
        {!! $errors->first('tgl_transaksi', '<p class="text-danger">:message</p>') !!}
        
    </div>
</div>
<div class="mb-3 row">
    <label for="example-text-input" class="col-md-2 col-form-label">Kode Akun</label>
    <div class="col-md-10">
        <select class="form-control" name="kode_akun" id="kode_akun">
            <option value="">Pilih Kode Akun</option>
            @foreach ($akuns as $akun)
            <option value="{{$akun->id}}">{{$akun->kode_akun}} - {{$akun->nama_akun}}</option> 
            @endforeach
        </select>
        {!! $errors->first('kode_akun', '<p class="text-danger">:message</p>') !!}
    
    </div>
</div>

<div class="mb-3 row">
    <label for="example-text-input" class="col-md-2 col-form-label">Judul</label>
    <div class="col-md-10">
        <input class="form-control" type="text" value="{{ !empty($data) ? $data->judul : old('judul') }}" name="judul" placeholder="Masukkan judul pengeluaran ... ">
        {!! $errors->first('judul', '<p class="text-danger">:message</p>') !!}
        
    </div>
</div>
<div class="mb-3 row">
    <label for="example-text-input" class="col-md-2 col-form-label">Nominal</label>
    <div class="col-md-10">
        <input class="form-control" type="text" value="{{ !empty($data) ? $data->nominal : old('nominal') }}" name="nominal" placeholder="Masukkan nominal pengeluaran ... ">
        {!! $errors->first('nominal', '<p class="text-danger">:message</p>') !!}
        
    </div>
</div>
<div class="mb-3 row">
    <label for="example-text-input" class="col-md-2 col-form-label">Keterangan</label>
    <div class="col-md-10">
    <textarea class="form-control" name="keterangan" style="height: 100px">{{ !empty($data) ? $data->keterangan : old('keterangan') }}</textarea>
    {!! $errors->first('keterangan', '<p class="text-danger">:message</p>') !!}
    </div>
</div>


<div class="card-body">
    <div class="form-group mb-0 text-end">
        <button type="submit" class="btn btn-primary waves-effect btn-label waves-light"><i class="bx bx-save label-icon"></i>Save</button>
        <a href="{{ URL::previous() }}" class="btn btn-dark waves-effect btn-label waves-light"><i class="bx bx-window-close label-icon"></i>Cancel</a>
    </div>
</div>