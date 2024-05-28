<div class="mb-3 row">
    <label for="example-text-input" class="col-md-2 col-form-label">Kode Akun</label>
    <div class="col-md-10">
        <input class="form-control" type="text" value="{{ !empty($data) ? $data->kode_akun : old('kode_akun') }}" name="kode_akun" placeholder="Masukkan kode akun ... " @if (!empty($data))
            readonly
        @endif>
        {!! $errors->first('kode_akun', '<p class="text-danger">:message</p>') !!}
    
    </div>
</div>
<div class="mb-3 row">
    <label for="example-text-input" class="col-md-2 col-form-label">Sub Akun</label>
    <div class="col-md-10">
        <input class="form-control" type="text" value="{{ !empty($data) ? $data->sub_akun : old('sub_akun') }}" name="sub_akun" placeholder="Masukkan sub akun ... ">
        {!! $errors->first('sub_akun', '<p class="text-danger">:message</p>') !!}
        
    </div>
</div>
<div class="mb-3 row">
    <label for="example-text-input" class="col-md-2 col-form-label">Nama Akun</label>
    <div class="col-md-10">
        <input class="form-control" type="text" value="{{ !empty($data) ? $data->nama_akun : old('nama_akun') }}" name="nama_akun" placeholder="Masukkan nama akun ... ">
        {!! $errors->first('nama_akun', '<p class="text-danger">:message</p>') !!}
        
    </div>
</div>

<div class="mb-3 row">
    <label for="example-text-input" class="col-md-2 col-form-label">Kategori</label>
    <div class="col-md-10">
        <select name="kategori_akun" class="form-control">
            <option value="debit" {{ !empty($data) ? $data->kategori_akun == 'debit' ? 'selected' : '' : '' }}>Debit</option>
            <option value="kredit" {{ !empty($data) ? $data->kategori_akun == 'kredit' ? 'selected' : '' : '' }}>Kredit</option>
        </select>
        {!! $errors->first('kategori_akun', '<p class="text-danger">:message</p>') !!}
        
    </div>
</div>


<div class="card-body">
    <div class="form-group mb-0 text-end">
        <button type="submit" class="btn btn-primary waves-effect btn-label waves-light"><i class="bx bx-save label-icon"></i>Save</button>
        <a href="{{ URL::previous() }}" class="btn btn-dark waves-effect btn-label waves-light"><i class="bx bx-window-close label-icon"></i>Cancel</a>
    </div>
</div>