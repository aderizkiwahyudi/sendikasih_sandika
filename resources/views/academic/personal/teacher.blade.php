<div class="main-form">
    <h5>BIODATA DIRI</h5>
    <div class="form-group row align-items-center mb-4">
        <div class="col-md-2">Nama <small class="text-danger">*</small></div>
        <div class="col-md-4"><input type="text" name="name" value="{{ old('name', Auth::guard('academic')->user()->teacher->name) }}" id="name" placeholder="Masukan nama anda" class="form-control"></div>
    </div>
    
    <div class="form-group row align-items-center mb-4">
        <div class="col-md-2">NIP <small class="text-danger"></small></div>
        <div class="col-md-4"><input type="number" name="nip" value="{{ old('nip', Auth::guard('academic')->user()->teacher->nip) }}" id="nip" placeholder="Masukan nip anda" class="form-control"></div>
    </div>
    
    <div class="form-group row align-items-center mb-4">
        <div class="col-md-2">Jenis Kelamin <small class="text-danger">*</small></div>
        <div class="col-md-4">
            <select name="gender" id="gender" class="form-control">
                <option value="">Pilih Jenis Kelamin</option>
                <option value="laki-laki" {{ old('gender', Auth::guard('academic')->user()->teacher->gender) == 'laki-laki' ? 'selected' : '' }}>Laki-Laki</option>
                <option value="perempuan" {{ old('gender', Auth::guard('academic')->user()->teacher->gender) == 'perempuan' ? 'selected' : '' }}>Perempuan</option>
            </select>
        </div>
    </div>

    <div class="form-group row align-items-center mb-4">
        <div class="col-md-2">Tempat & Tanggal Lahir <small class="text-danger">*</small></div>
        <div class="col-md-4"><input type="text" name="birthday_at" value="{{ old('birthday_at', Auth::guard('academic')->user()->teacher->birthday_at) }}" id="birthday_at" placeholder="Masukan tempat lahir anda" class="form-control"></div>
        <div class="col-md-4"><input type="date" name="birthday" value="{{ old('birthday', Auth::guard('academic')->user()->teacher->birthday) }}" id="birthday" placeholder="Masukan tanggal lahir anda" class="form-control"></div>
    </div>
    
    <div class="form-group row align-items-center mb-4">
        <div class="col-md-2">Alamat <small class="text-danger">*</small></div>
        <div class="col-md-4"><textarea name="address" id="address" rows="5" placeholder="Masukan alamat anda" class="form-control">{{ old('address', Auth::guard('academic')->user()->teacher->address) }}</textarea></div>
    </div>

    <div class="form-group row align-items-center mb-4">
        <div class="col-md-2">No. Handphone <small class="text-danger">*</small></div>
        <div class="col-md-4"><input type="text" name="phone" id="phone" value="{{ old('phone', Auth::guard('academic')->user()->teacher->phone) }}" placeholder="62821xxxxxxx" class="form-control"></div>
    </div>
</div>