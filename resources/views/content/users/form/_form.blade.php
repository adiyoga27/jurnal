<div class="mb-3 row">
    <label for="example-text-input" class="col-md-2 col-form-label">Nama</label>
    <div class="col-md-10">
        <input class="form-control" type="text" value="{{ !empty($user) ? $user->nama : '' }}" name="nama" placeholder="Masukkan nama user ... ">
        {!! $errors->first('nama', '<p class="text-danger">:message</p>') !!}
    
    </div>
</div>

<div class="mb-3 row">
    <label for="example-text-input" class="col-md-2 col-form-label">Email</label>
    <div class="col-md-10">
        <input class="form-control" type="text" value="{{ !empty($user) ? $user->email : '' }}" name="email" placeholder="Masukkan nama email ... ">
        {!! $errors->first('email', '<p class="text-danger">:message</p>') !!}
        
    </div>
</div>
<div class="mb-3 row">
    <label for="example-text-input" class="col-md-2 col-form-label">No Telepon</label>
    <div class="col-md-10">
        <input class="form-control" type="text" value="{{ !empty($user) ? $user->no_telepon : '' }}" name="no_telepon" placeholder="Masukkan nama nomor telephone ... ">
        {!! $errors->first('no_telepon', '<p class="text-danger">:message</p>') !!}
        
    </div>
</div>
<div class="mb-3 row">
    <label for="example-text-input" class="col-md-2 col-form-label">Role</label>
    <div class="col-md-10">
        <select name="role" class="form-control">
            <option value="manager" {{ !empty($user) ? $user->role == 'manager' ? 'selected' : '' : '' }}>Manager</option>
            <option value="admin" {{ !empty($user) ? $user->role == 'admin' ? 'selected' : '' : '' }}>Admin</option>
        </select>
        {!! $errors->first('role', '<p class="text-danger">:message</p>') !!}
        
    </div>
</div>

<div class="mb-3 row">
    <label for="example-text-input" class="col-md-2 col-form-label">Username</label>
    <div class="col-md-10">
        <input class="form-control" type="text" value="{{ !empty($user) ? $user->username : '' }}" name="username" placeholder="Masukkan username .... ">
        {!! $errors->first('username', '<p class="text-danger">:message</p>') !!}
        
    </div>
</div>

<div class="mb-3 row">
    <label for="example-text-input" class="col-md-2 col-form-label">Password</label>
    <div class="col-md-10">
        <input class="form-control" type="text" value="{{ !empty($user) ? $user->password : '' }}" name="password" placeholder="Masukkan password ...">
        {!! $errors->first('password', '<p class="text-danger">:message</p>') !!}
        
    </div>
</div>

<div class="card-body">
    <div class="form-group mb-0 text-end">
        <button type="submit" class="btn btn-primary waves-effect btn-label waves-light"><i class="bx bx-save label-icon"></i>Save</button>
        <a href="{{ URL::previous() }}" class="btn btn-dark waves-effect btn-label waves-light"><i class="bx bx-window-close label-icon"></i>Cancel</a>
    </div>
</div>