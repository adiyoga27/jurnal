<div class="mb-3 row">
    <label for="example-text-input" class="col-md-2 col-form-label">Kode Karyawan</label>
    <div class="col-md-10">
        <input class="form-control" type="text" value="{{ !empty($data) ? $data->kode_karyawan : $nik }}" name="kode_karyawan" placeholder="Masukkan kode karyawan ... " readonly>
        {!! $errors->first('kode_karyawan', '<p class="text-danger">:message</p>') !!}
    
    </div>
</div>

<div class="mb-3 row">
    <label for="example-text-input" class="col-md-2 col-form-label">Nama</label>
    <div class="col-md-10">
        <input class="form-control" type="text" value="{{ !empty($data) ? $data->nama_karyawan : old('nama_karyawan') }}" name="nama_karyawan" placeholder="Masukkan nama karyawan ... ">
        {!! $errors->first('nama_karyawan', '<p class="text-danger">:message</p>') !!}
        
    </div>
</div>
<div class="mb-3 row">
    <label for="example-text-input" class="col-md-2 col-form-label">Hp</label>
    <div class="col-md-10">
        <input class="form-control" type="text" value="{{ !empty($data) ? $data->hp : old('hp') }}" name="hp" placeholder="Masukkan nomor hp ... ">
        {!! $errors->first('hp', '<p class="text-danger">:message</p>') !!}
        
    </div>
</div>
<div class="mb-3 row">
    <label for="example-text-input" class="col-md-2 col-form-label">Tgl Lahir</label>
    <div class="col-md-10">
        <input class="form-control" type="date" value="{{ !empty($data) ? $data->tgl_lahir : old('tgl_lahir') }}" name="tgl_lahir" >
        {!! $errors->first('tgl_lahir', '<p class="text-danger">:message</p>') !!}
        
    </div>
</div>
<div class="mb-3 row">
    <label for="example-text-input" class="col-md-2 col-form-label">Tgl Gabung</label>
    <div class="col-md-10">
        <input class="form-control" type="date" value="{{ !empty($data) ? $data->tgl_gabung : old('tgl_gabung') }}" name="tgl_gabung">
        {!! $errors->first('tgl_gabung', '<p class="text-danger">:message</p>') !!}
        
    </div>
</div>
<div class="mb-3 row">
    <label for="example-text-input" class="col-md-2 col-form-label">Alamat</label>
    <div class="col-md-10">
    <textarea class="form-control" name="alamat" style="height: 100px">{{ !empty($data) ? $data->alamat : old('alamat') }}</textarea>
    {!! $errors->first('alamat', '<p class="text-danger">:message</p>') !!}
    </div>
</div>
<div class="mb-3 row">
    <label for="example-text-input" class="col-md-2 col-form-label">Upload Photo</label>
    <div class="col-md-10">
        <input class="form-control" type="file" name="photo" >
        {!! $errors->first('photo', '<p class="text-danger">:message</p>') !!}
    
    </div>
</div>

<div class="card-body">
    <div class="form-group mb-0 text-end">
        <button type="submit" class="btn btn-primary waves-effect btn-label waves-light"><i class="bx bx-save label-icon"></i>Save</button>
        <a href="{{ URL::previous() }}" class="btn btn-dark waves-effect btn-label waves-light"><i class="bx bx-window-close label-icon"></i>Cancel</a>
    </div>
</div>