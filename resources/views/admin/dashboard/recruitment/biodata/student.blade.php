<div class="main-form">
    <h5>AKUN</h5>
    <div class="form-group row align-items-center mb-4">
        <div class="col-md-4">Unit <small class="text-danger">*</small></div>
        <div class="col-md-4">
            <select name="unit_id" class="form-control" id="unit" disabled>
                <option value="">Pilih Unit</option>
                <option value="2" {{ old('unit_id', $user->account->unit_id ?? '') == '2' ? 'selected' : '' }}>MI</option>
                <option value="3" {{ old('unit_id', $user->account->unit_id ?? '') == '3' ? 'selected' : '' }}>SMP</option>
                <option value="4" {{ old('unit_id', $user->account->unit_id ?? '') == '4' ? 'selected' : '' }}>SMA</option>
            </select>
        </div>
    </div>
    <div class="form-group row align-items-center mb-4">
        <div class="col-md-4">Username <small class="text-danger">*</small></div>
        <div class="col-md-4"><input type="text" name="username" value="{{ old('username', $user->account->username ?? '') }}" id="username" placeholder="Masukan nama" class="form-control" disabled></div>
    </div>
    <div class="form-group row align-items-center mb-4">
        <div class="col-md-4">Email <small class="text-danger">*</small></div>
        <div class="col-md-4"><input type="email" name="email" value="{{ old('email', $user->account->email ?? '') }}" id="email" placeholder="Masukan email" class="form-control" disabled></div>
    </div>
    
    <h5>BIODATA DIRI</h5>
    <div class="form-group row align-items-center mb-4">
        <div class="col-md-4">Nama <small class="text-danger">*</small></div>
        <div class="col-md-4"><input type="text" name="name" value="{{ old('name', $user->name ?? '') }}" id="name" placeholder="Masukan nama" class="form-control" disabled></div>
    </div>
    
    @if ($user->unit_id != unit_name('mi'))
        <div class="form-group row align-items-center mb-4">
            <div class="col-md-4">NISN <small class="text-danger">*</small></div>
            <div class="col-md-4"><input type="number" name="nisn" value="{{ old('nisn', $user->nisn ?? '') }}" id="nisn" placeholder="Masukan nisn" class="form-control" disabled></div>
        </div>
    @endif
    <div class="form-group row align-items-center mb-4">
        <div class="col-md-4">Tahun Masuk<small class="text-danger">*</small></div>
        <div class="col-md-4">
            <select name="year_id" id="year_id" class="form-control" disabled>
                <option value="">Pilih Tahun Masuk</option>
                @foreach ($year as $item)
                    <option value="{{ $item->name }}" {{ old('year_id', $user->year->name ?? '') == $item->name ? 'selected' : '' }}>{{ $item->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-4">
            <select name="semester" id="semester" class="form-control" disabled>
                <option value="">Pilih Semester</option>
                <option value="ganjil" {{ old('semester', $user->year->status ?? '') == 'Ganjil' ? 'selected' : '' }}>Semester Ganjil</option>
                <option value="genap" {{ old('semester', $user->year->status ?? '') == 'Genap' ? 'selected' : '' }}>Semester Genap</option>
                @if (Request::segment(5))
                    <option value="Tidak Diketahui" {{ old('semester', $user->year->status ?? '') == 'Tidak Diketahui' ? 'selected' : '' }}>Tidak Diketahui</option>
                @endif
            </select>
        </div>
    </div>
    <div class="form-group row align-items-center mb-4">
        <div class="col-md-4">Status Siswa<small class="text-danger">*</small></div>
        <div class="col-md-4">
            <select name="student_status" id="student_status" class="form-control" disabled>
                <option value="">Pilih Status Siswa</option>
                <option value="1" {{ old('student_status', $user->student_status ?? '') == '1' ? 'selected' : '' }}>Siswa Baru</option>
                <option value="2" {{ old('student_status', $user->student_status ?? '') == '2' ? 'selected' : '' }}>Siswa Pindahan</option>
            </select>
        </div>
    </div>
    <div class="form-group row align-items-center mb-4">
        <div class="col-md-4">Jenis Kelamin <small class="text-danger">*</small></div>
        <div class="col-md-4">
            <select name="gender" id="gender" class="form-control" disabled>
                <option value="">Pilih Jenis Kelamin</option>
                <option value="laki-laki" {{ old('gender', $user->gender ?? '') == 'laki-laki' ? 'selected' : '' }}>Laki-Laki</option>
                <option value="perempuan" {{ old('gender', $user->gender ?? '') == 'perempuan' ? 'selected' : '' }}>Perempuan</option>
            </select>
        </div>
    </div>
    <div class="form-group row align-items-center mb-4">
        <div class="col-md-4">Tempat & Tanggal Lahir <small class="text-danger">*</small></div>
        <div class="col-md-4"><input type="text" name="birthday_at" value="{{ old('birthday_at', $user->birthday_at ?? '') }}" id="birthday_at" placeholder="Masukan tempat lahir " class="form-control" disabled></div>
        <div class="col-md-4"><input type="date" name="birthday" value="{{ old('birthday', $user->birthday ?? '') }}" id="birthday" placeholder="Masukan tanggal lahir " class="form-control" disabled></div>
    </div>
    <div class="form-group row align-items-center mb-4">
        <div class="col-md-4">Alamat <small class="text-danger">*</small></div>
        <div class="col-md-4">{{ $user->address ?? 'Belum ada alamat' }}</textarea></div>
    </div>
    <div class="form-group row align-items-center mb-4">
        <div class="col-md-4">No. Handphone <small class="text-danger">*</small></div>
        <div class="col-md-4"><input type="text" name="phone" id="phone" value="{{ old('phone', $user->phone ?? '') }}" placeholder="62821xxxxxxx" class="form-control" disabled></div>
    </div>
    
    @if ($user->unit_id != unit_name('mi'))
        <h4>ASAL SEKOLAH</h4>
        <div class="form-group row align-items-center mb-4">
            <div class="col-md-4">Nama Sekolah <small class="text-danger">*</small></div>
            <div class="col-md-4"><input type="text" name="previous_school" value="{{ old('previous_school', $user->previous_school ?? '') }}" id="previous_school" placeholder="Masukan asal sekolah " class="form-control" disabled></div>
        </div>
        <div class="form-group row align-items-center mb-4">
            <div class="col-md-4">Alamat Sekolah <small class="text-danger">*</small></div>
            <div class="col-md-4">{{ $user->previous_school_address ?? 'Belum ada alamat' }}</textarea></div>
        </div>
    @endif

    <h5>ORANG TUA</h5>
    <div class="form-group row align-items-center mb-4">
        <div class="col-md-4">Nama & Pekerjaan Ayah <small class="text-danger">*</small></div>
        <div class="col-md-4"><input type="text" name="father_name" id="father_name" value="{{ old('father_name', $user->father_name  ?? '') }}" placeholder="Masukan nama ayah " class="form-control" disabled></div>
        <div class="col-md-4"><input type="text" name="father_job" id="father_job" value="{{ old('father_job', $user->father_job  ?? '') }}" placeholder="Masukan pekerjaan ayah " class="form-control" disabled></div>
    </div>
    <div class="form-group row align-items-center mb-4">
        <div class="col-md-4">Nama & Pekerjaan Ibu <small class="text-danger">*</small></div>
        <div class="col-md-4"><input type="text" name="mother_name" id="mother_name" value="{{ old('mother_name', $user->mother_name  ?? '') }}" placeholder="Masukan nama ibu " class="form-control" disabled></div>
        <div class="col-md-4"><input type="text" name="mother_job" id="mother_job" value="{{ old('mother_job', $user->mother_job  ?? '') }}" placeholder="Masukan pekerjaan ibu " class="form-control" disabled></div>
    </div>
    <div class="form-group row align-items-center mb-4">
        <div class="col-md-4">Alamat Orang Tua <small class="text-danger">*</small></div>
        <div class="col-md-4">{{ $user->parents_address ?? 'Belum ada alamat' }}</textarea></div>
    </div>
    <div class="form-group row align-items-center mb-4">
        <div class="col-md-4">No. Handphone <small class="text-danger">*</small></div>
        <div class="col-md-4"><input type="number" name="parents_phone" id="parents_phone" value="{{ old('parents_phone', $user->parents_phone ?? '') }}" placeholder="62821xxxxxxx" class="form-control" disabled></div>
    </div>
    <div class="form-group row align-items-center mb-4">
        <div class="col-md-4">{{ Request::segment(4) != 'mi' ? 'Kartu Keluarga & Ijazah' : 'Kartu Keluarga' }} <small class="text-danger">*</small></div>
        <div class="col-md-4">
            <p><small><a href="{{ $user->kk  ?? ''}}"><i class="bi bi-file-earmark-pdf-fill"></i> Download Kartu Keluarga </a></small></p>
        </div>
        @if (unit_name($user->account->unit_id) != 'mi')
            <div class="col-md-4">
                <p><small><a href="{{ $user->ijazah ?? '' }}"><i class="bi bi-file-earmark-pdf-fill"></i> Download Ijazah </a></small></p>
            </div>
        @endif
    </div>
    
</div>