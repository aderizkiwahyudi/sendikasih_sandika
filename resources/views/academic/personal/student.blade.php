<div class="main-form">
    <h5>BIODATA DIRI</h5>
    <div class="form-group row align-items-center mb-4">
        <div class="col-md-4">Nama <small class="text-danger">*</small></div>
        <div class="col-md-4"><input type="text" name="name" value="{{ old('name', Auth::guard('academic')->user()->student->name) }}" id="name" placeholder="Masukan nama anda" class="form-control"></div>
    </div>
    
    @if (Auth::guard('academic')->user()->unit_id > 2)
        <div class="form-group row align-items-center mb-4">
            <div class="col-md-4">NISN <small class="text-danger">*</small></div>
            <div class="col-md-4"><input type="number" name="nisn" value="{{ old('nisn', Auth::guard('academic')->user()->student->nisn) }}" id="nisn" placeholder="Masukan nisn anda" class="form-control"></div>
        </div>
    @endif
    
    <div class="form-group row align-items-center mb-4">
        <div class="col-md-4">Jenis Kelamin <small class="text-danger">*</small></div>
        <div class="col-md-4">
            <select name="gender" id="gender" class="form-control">
                <option value="">Pilih Jenis Kelamin</option>
                <option value="laki-laki" {{ old('gender', Auth::guard('academic')->user()->student->gender) == 'laki-laki' ? 'selected' : '' }}>Laki-Laki</option>
                <option value="perempuan" {{ old('gender', Auth::guard('academic')->user()->student->gender) == 'perempuan' ? 'selected' : '' }}>Perempuan</option>
            </select>
        </div>
    </div>
    <div class="form-group row align-items-center mb-4">
        <div class="col-md-4">Tempat & Tanggal Lahir <small class="text-danger">*</small></div>
        <div class="col-md-4"><input type="text" name="birthday_at" value="{{ old('birthday_at', Auth::guard('academic')->user()->student->birthday_at) }}" id="birthday_at" placeholder="Masukan tempat lahir anda" class="form-control"></div>
        <div class="col-md-4"><input type="date" name="birthday" value="{{ old('birthday', Auth::guard('academic')->user()->student->birthday) }}" id="birthday" placeholder="Masukan tanggal lahir anda" class="form-control"></div>
    </div>
    <div class="form-group row align-items-center mb-4">
        <div class="col-md-4">Alamat <small class="text-danger">*</small></div>
        <div class="col-md-4"><textarea name="address" id="address" rows="5" placeholder="Masukan alamat anda" class="form-control">{{ old('address', Auth::guard('academic')->user()->student->address) }}</textarea></div>
    </div>
    <div class="form-group row align-items-center mb-4">
        <div class="col-md-4">No. Handphone <small class="text-danger">*</small></div>
        <div class="col-md-4"><input type="text" name="phone" id="phone" value="{{ old('phone', Auth::guard('academic')->user()->student->phone) }}" placeholder="62821xxxxxxx" class="form-control"></div>
    </div>
    
    @if (Auth::guard('academic')->user()->unit_id > 2)
        <h4>ASAL SEKOLAH</h4>
        <div class="form-group row align-items-center mb-4">
            <div class="col-md-4">Nama Sekolah <small class="text-danger">*</small></div>
            <div class="col-md-4"><input type="text" name="previous_school" value="{{ old('previous_school', Auth::guard('academic')->user()->student->previous_school) }}" id="previous_school" placeholder="Masukan asal sekolah anda" class="form-control"></div>
        </div>
        <div class="form-group row align-items-center mb-4">
            <div class="col-md-4">Alamat Sekolah <small class="text-danger">*</small></div>
            <div class="col-md-4"><textarea name="previous_school_address" value="{{ old('previous_school_address', Auth::guard('academic')->user()->student->previous_school_address) }}" id="previous_school_address" rows="5" placeholder="Masukan alamat asal sekolah anda" class="form-control"></textarea></div>
        </div>
    @endif

    <h5>ORANG TUA</h5>
    <div class="form-group row align-items-center mb-4">
        <div class="col-md-4">Nama & Pekerjaan Ayah <small class="text-danger">*</small></div>
        <div class="col-md-4"><input type="text" name="father_name" id="father_name" value="{{ old('father_name', Auth::guard('academic')->user()->student->father_job) }}" placeholder="Masukan nama ayah anda" class="form-control"></div>
        <div class="col-md-4"><input type="text" name="father_job" id="father_job" value="{{ old('father_job', Auth::guard('academic')->user()->student->father_job) }}" placeholder="Masukan pekerjaan ayah anda" class="form-control"></div>
    </div>
    <div class="form-group row align-items-center mb-4">
        <div class="col-md-4">Nama & Pekerjaan Ibu <small class="text-danger">*</small></div>
        <div class="col-md-4"><input type="text" name="mother_name" id="mother_name" value="{{ old('mother_name', Auth::guard('academic')->user()->student->mother_name) }}" placeholder="Masukan nama ibu anda" class="form-control"></div>
        <div class="col-md-4"><input type="text" name="mother_job" id="mother_job" value="{{ old('mother_job', Auth::guard('academic')->user()->student->mother_job) }}" placeholder="Masukan pekerjaan ibu anda" class="form-control"></div>
    </div>
    <div class="form-group row align-items-center mb-4">
        <div class="col-md-4">Alamat Orang Tua <small class="text-danger">*</small></div>
        <div class="col-md-4"><textarea name="parents_address" id="parents_address" rows="5" placeholder="Masukan alamat asal sekolah anda" class="form-control">{{ old('parents_address', Auth::guard('academic')->user()->student->parents_address) }}</textarea></div>
    </div>
    <div class="form-group row align-items-center mb-4">
        <div class="col-md-4">No. Handphone <small class="text-danger">*</small></div>
        <div class="col-md-4"><input type="text" name="parents_phone" id="parents_phone" value="{{ old('parents_phone', Auth::guard('academic')->user()->student->parents_phone) }}" placeholder="62821xxxxxxx" class="form-control"></div>
    </div>
    <div class="form-group row align-items-center mb-4">
        <div class="col-md-4">{{ Auth::guard('academic')->user()->unit_id > 2 ? 'Kartu Keluarga & Ijazah' : 'Kartu Keluarga' }} <small class="text-danger">*</small></div>
        <div class="col-md-4">
            @if (Auth::guard('academic')->user()->student->kk)
                <p><small><a href="{{ Auth::guard('academic')->user()->student->kk }}"><i class="bi bi-file-earmark-pdf-fill"></i> Download PDF Anda</a></small></p>
            @endif
        </div>

        @if (Auth::guard('academic')->user()->unit_id > 2)
            <div class="col-md-4">
                @if (Auth::guard('academic')->user()->student->ijazah)
                    <p><small><a href="{{ Auth::guard('academic')->user()->student->ijazah }}"><i class="bi bi-file-earmark-pdf-fill"></i> Download PDF Anda</a></small></p>
                @endif
            </div>
        @endif

    </div>
</div>