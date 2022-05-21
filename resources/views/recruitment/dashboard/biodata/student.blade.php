@if ($errors->any())
    <div class="alert alert-danger mt-4 alert-dismissible fade show" role="alert">
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        <strong>Terdapat kesalahan, berikut :</strong>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{$error}}</li>
            @endforeach
        </ul>
    </div>
@endif
@if (Session::has('success'))
    <div class="alert alert-success mt-4 alert-dismissible fade show" role="alert">
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        {{ Session::get('success') }}
    </div>
@endif
<form method="POST" enctype="multipart/form-data">
    @csrf
    <div class="main-form">
        <h4>BIODATA DIRI</h4>
        <div class="form-group row align-items-center mb-4">
            <div class="col-md-2">Nama <small class="text-danger">*</small></div>
            <div class="col-md-4"><input type="text" name="name" value="{{ old('name', Auth::guard('recruitment')->user()->student->name) }}" id="name" placeholder="Masukan nama " class="form-control"></div>
        </div>
        
        @if (Auth::guard('recruitment')->user()->unit_id > 2)
            <div class="form-group row align-items-center mb-4">
                <div class="col-md-2">NISN <small class="text-danger">*</small></div>
                <div class="col-md-4"><input type="number" name="nisn" value="{{ old('nisn', Auth::guard('recruitment')->user()->student->nisn) }}" id="nisn" placeholder="Masukan nisn " class="form-control"></div>
            </div>
        @endif
        
        <div class="form-group row align-items-center mb-4">
            <div class="col-md-2">Jenis Kelamin <small class="text-danger">*</small></div>
            <div class="col-md-4">
                <select name="gender" id="gender" class="form-control">
                    <option value="">Pilih Jenis Kelamin</option>
                    <option value="laki-laki" {{ old('gender', Auth::guard('recruitment')->user()->student->gender) == 'laki-laki' ? 'selected' : '' }}>Laki-Laki</option>
                    <option value="perempuan" {{ old('gender', Auth::guard('recruitment')->user()->student->gender) == 'perempuan' ? 'selected' : '' }}>Perempuan</option>
                </select>
            </div>
        </div>
        <div class="form-group row align-items-center mb-4">
            <div class="col-md-2">Tempat & Tanggal Lahir <small class="text-danger">*</small></div>
            <div class="col-md-4"><input type="text" name="birthday_at" value="{{ old('birthday_at', Auth::guard('recruitment')->user()->student->birthday_at) }}" id="birthday_at" placeholder="Masukan tempat lahir " class="form-control"></div>
            <div class="col-md-4"><input type="date" name="birthday" value="{{ old('birthday', Auth::guard('recruitment')->user()->student->birthday) }}" id="birthday" placeholder="Masukan tanggal lahir " class="form-control"></div>
        </div>
        <div class="form-group row align-items-center mb-4">
            <div class="col-md-2">Alamat <small class="text-danger">*</small></div>
            <div class="col-md-4"><textarea name="address" id="address" rows="5" placeholder="Masukan alamat " class="form-control">{{ old('address', Auth::guard('recruitment')->user()->student->address) }}</textarea></div>
        </div>
        <div class="form-group row align-items-center mb-4">
            <div class="col-md-2">No. Handphone <small class="text-danger">*</small></div>
            <div class="col-md-4"><input type="text" name="phone" id="phone" value="{{ old('phone', Auth::guard('recruitment')->user()->student->phone) }}" placeholder="62821xxxxxxx" class="form-control"></div>
        </div>
        
        @if (Auth::guard('recruitment')->user()->unit_id > 2)
            <h4>ASAL SEKOLAH</h4>
            <div class="form-group row align-items-center mb-4">
                <div class="col-md-2">Nama Sekolah <small class="text-danger">*</small></div>
                <div class="col-md-4"><input type="text" name="previous_school" value="{{ old('previous_school', Auth::guard('recruitment')->user()->student->previous_school) }}" id="previous_school" placeholder="Masukan asal sekolah " class="form-control"></div>
            </div>
            <div class="form-group row align-items-center mb-4">
                <div class="col-md-2">Alamat Sekolah <small class="text-danger">*</small></div>
                <div class="col-md-4"><textarea name="previous_school_address" id="previous_school_address" rows="5" placeholder="Masukan alamat asal sekolah " class="form-control">{{ old('previous_school_address', Auth::guard('recruitment')->user()->student->previous_school_address) }}</textarea></div>
            </div>
        @endif

        <h4>ORANG TUA</h4>
        <div class="form-group row align-items-center mb-4">
            <div class="col-md-2">Nama & Pekerjaan Ayah <small class="text-danger">*</small></div>
            <div class="col-md-4"><input type="text" name="father_name" id="father_name" value="{{ old('father_name', Auth::guard('recruitment')->user()->student->father_name) }}" placeholder="Masukan nama ayah " class="form-control"></div>
            <div class="col-md-4"><input type="text" name="father_job" id="father_job" value="{{ old('father_job', Auth::guard('recruitment')->user()->student->father_job) }}" placeholder="Masukan pekerjaan ayah " class="form-control"></div>
        </div>
        <div class="form-group row align-items-center mb-4">
            <div class="col-md-2">Nama & Pekerjaan Ibu <small class="text-danger">*</small></div>
            <div class="col-md-4"><input type="text" name="mother_name" id="mother_name" value="{{ old('mother_name', Auth::guard('recruitment')->user()->student->mother_name) }}" placeholder="Masukan nama ibu " class="form-control"></div>
            <div class="col-md-4"><input type="text" name="mother_job" id="mother_job" value="{{ old('mother_job', Auth::guard('recruitment')->user()->student->mother_job) }}" placeholder="Masukan pekerjaan ibu " class="form-control"></div>
        </div>
        <div class="form-group row align-items-center mb-4">
            <div class="col-md-2">Alamat Orang Tua <small class="text-danger">*</small></div>
            <div class="col-md-4"><textarea name="parents_address" id="parents_address" rows="5" placeholder="Masukan alamat orang tua" class="form-control">{{ old('parents_address', Auth::guard('recruitment')->user()->student->parents_address) }}</textarea></div>
        </div>
        <div class="form-group row align-items-center mb-4">
            <div class="col-md-2">No. Handphone <small class="text-danger">*</small></div>
            <div class="col-md-4"><input type="text" name="parents_phone" id="parents_phone" value="{{ old('parents_phone', Auth::guard('recruitment')->user()->student->parents_phone) }}" placeholder="62821xxxxxxx" class="form-control"></div>
        </div>
        <div class="form-group row align-items-center mb-4">
            <div class="col-md-2">{{ Auth::guard('recruitment')->user()->unit_id > 2 ? 'Kartu Keluarga & Ijazah' : 'Kartu Keluarga' }} <small class="text-danger">*</small></div>
            <div class="col-md-4">
                <input type="file" name="kk" id="kk" class="form-control"/>
                <small class="text-danger">* Format PDF</small>
                @if (Auth::guard('recruitment')->user()->student->kk)
                    <p><small><a href="{{ Auth::guard('recruitment')->user()->student->kk }}"><i class="bi bi-file-earmark-pdf-fill"></i> Download PDF </a></small></p>
                @endif
            </div>

            @if (Auth::guard('recruitment')->user()->unit_id > 2)
                <div class="col-md-4">
                    <input type="file" name="ijazah" id="ijazah" class="form-control">
                    <small class="text-danger">* Format PDF</small>
                    @if (Auth::guard('recruitment')->user()->student->ijazah)
                        <p><small><a href="{{ Auth::guard('recruitment')->user()->student->ijazah }}"><i class="bi bi-file-earmark-pdf-fill"></i> Download PDF </a></small></p>
                    @endif
                </div>
            @endif

        </div>
    </div>
    <div class="main-button">
        <button type="submit" class="btn btn-primary">Simpan</button>
        @if (Auth::guard('recruitment')->user()->recruitment->step > 1)
            <a href="{{ route('recruitment.photo') }}" class="btn btn-success">Selanjutnya</a>
        @endif
    </div>
</form>