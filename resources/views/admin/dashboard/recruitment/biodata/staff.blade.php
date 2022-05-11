<div class="main-form">
    <h5>AKUN</h5>
    <div class="form-group row align-items-center mb-4">
        <div class="col-md-3">Username <small class="text-danger">*</small></div>
        <div class="col-md-5"><input disabled type="text" name="username" value="{{ old('username', $user->account->username ?? '') }}" id="username" placeholder="Masukan nama" class="form-control"></div>
    </div>
    <div class="form-group row align-items-center mb-4">
        <div class="col-md-3">Email <small class="text-danger">*</small></div>
        <div class="col-md-5"><input disabled type="email" name="email" value="{{ old('email', $user->account->email ?? '') }}" id="email" placeholder="Masukan email" class="form-control"></div>
    </div>

    <h4>BIODATA DIRI</h4>
    <div class="form-group row align-items-center mb-4">
        <div class="col-md-3">Nama <small class="text-danger">*</small></div>
        <div class="col-md-5"><input disabled type="text" name="name" value="{{ old('name', $user->name ?? '') }}" id="name" placeholder="Masukan nama " class="form-control"></div>
    </div>
    
    <div class="form-group row align-items-center mb-4">
        <div class="col-md-3">NIP <small class="text-danger">*</small></div>
        <div class="col-md-5"><input disabled type="number" name="nip" value="{{ old('nip', $user->nip ?? '') }}" id="nip" placeholder="Masukan nip " class="form-control"></div>
    </div>
    
    <div class="form-group row align-items-center mb-4">
        <div class="col-md-3">Jenis Kelamin <small class="text-danger">*</small></div>
        <div class="col-md-5">
            <select disabled name="gender" id="gender" class="form-control">
                <option value="">Pilih Jenis Kelamin</option>
                <option value="laki-laki" {{ old('gender', $user->gender ?? '') == 'laki-laki' ? 'selected' : '' }}>Laki-Laki</option>
                <option value="perempuan" {{ old('gender', $user->gender ?? '') == 'perempuan' ? 'selected' : '' }}>Perempuan</option>
            </select>
        </div>
    </div>

    <div class="form-group row align-items-center mb-4">
        <div class="col-md-3">Tempat & Tanggal Lahir <small class="text-danger">*</small></div>
        <div class="col-md-5"><input disabled type="text" name="birthday_at" value="{{ old('birthday_at', $user->birthday_at ?? '') }}" id="birthday_at" placeholder="Masukan tempat lahir " class="form-control"></div>
        <div class="col-md-4"><input disabled type="date" name="birthday" value="{{ old('birthday', $user->birthday ?? '') }}" id="birthday" placeholder="Masukan tanggal lahir " class="form-control"></div>
    </div>
    
    <div class="form-group row align-items-center mb-4">
        <div class="col-md-3">Alamat <small class="text-danger">*</small></div>
        <div class="col-md-5"><textarea disabled name="address" id="address" rows="5" placeholder="Masukan alamat " class="form-control">{{ old('address', $user->address ?? '') }}</textarea></div>
    </div>

    <div class="form-group row align-items-center mb-4">
        <div class="col-md-3">No. Handphone <small class="text-danger">*</small></div>
        <div class="col-md-5"><input disabled type="text" name="phone" id="phone" value="{{ old('phone', $user->phone ?? '') }}" placeholder="62821xxxxxxx" class="form-control"></div>
    </div>
</div>