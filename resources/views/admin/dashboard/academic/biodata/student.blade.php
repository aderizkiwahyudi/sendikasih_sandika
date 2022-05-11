<form method="post" enctype="multipart/form-data">
    @csrf
    <div class="main-form">
        <h5>AKUN</h5>
        @if (Request::segment(4) == 'semua')
            <div class="form-group row align-items-center mb-4">
                <div class="col-md-4">Unit <small class="text-danger">*</small></div>
                <div class="col-md-4">
                    <select name="unit_id" class="form-control" id="unit">
                        <option value="">Pilih Unit</option>
                        <option value="2" {{ old('unit_id', $user->account->unit_id ?? '') == '2' ? 'selected' : '' }}>MI</option>
                        <option value="3" {{ old('unit_id', $user->account->unit_id ?? '') == '3' ? 'selected' : '' }}>SMP</option>
                        <option value="4" {{ old('unit_id', $user->account->unit_id ?? '') == '4' ? 'selected' : '' }}>SMA</option>
                    </select>
                </div>
            </div>
        @endif
        <div class="form-group row align-items-center mb-4">
            <div class="col-md-4">Username <small class="text-danger">*</small></div>
            <div class="col-md-4"><input type="text" name="username" value="{{ old('username', $user->account->username ?? '') }}" id="username" placeholder="Masukan nama" class="form-control"></div>
        </div>
        <div class="form-group row align-items-center mb-4">
            <div class="col-md-4">Email <small class="text-danger">*</small></div>
            <div class="col-md-4"><input type="email" name="email" value="{{ old('email', $user->account->email ?? '') }}" id="email" placeholder="Masukan email" class="form-control"></div>
        </div>
        <div class="form-group row align-items-center mb-4">
            <div class="col-md-4">Password <small class="text-danger">*</small></div>
            <div class="col-md-4">
                <input type="password" name="password" id="password" placeholder="Masukan password" class="form-control">
                @if (Request::segment(5) == 'edit')
                    <small class="text-danger">Kosongkan jika tidak ingin mengubah</small>
                @endif
            </div>
        </div>
        
        <h5>BIODATA DIRI</h5>
        <div class="form-group row align-items-center mb-4">
            <div class="col-md-4">Nama <small class="text-danger">*</small></div>
            <div class="col-md-4"><input type="text" name="name" value="{{ old('name', $user->name ?? '') }}" id="name" placeholder="Masukan nama" class="form-control"></div>
        </div>
        
        @if (Request::segment(4) != 'mi')
            <div class="form-group row align-items-center mb-4">
                <div class="col-md-4">NISN <small class="text-danger">*</small></div>
                <div class="col-md-4"><input type="number" name="nisn" value="{{ old('nisn', $user->nisn ?? '') }}" id="nisn" placeholder="Masukan nisn" class="form-control"></div>
            </div>
        @endif
        <div class="form-group row align-items-center mb-4">
            <div class="col-md-4">Kelas<small class="text-danger">*</small></div>
            <div class="col-md-4">
                <select name="class_id" id="class_id" class="form-control">
                    <option value="">Pilih Kelas</option>
                    @foreach ($class as $item)
                        <option value="{{ $item->id }}" {{ old('class_id', $user->class_id ?? '') == $item->id ? 'selected' : '' }}>{{ $item->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="form-group row align-items-center mb-4">
            <div class="col-md-4">Tahun Masuk<small class="text-danger">*</small></div>
            <div class="col-md-4">
                <select name="year_id" id="year_id" class="form-control">
                    <option value="">Pilih Tahun Masuk</option>
                    @foreach ($year as $item)
                        <option value="{{ $item->name }}" {{ old('year_id', $user->year->name ?? '') == $item->name ? 'selected' : '' }}>{{ $item->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-4">
                <select name="semester" id="semester" class="form-control">
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
                <select name="student_status" id="student_status" class="form-control">
                    <option value="">Pilih Status Siswa</option>
                    <option value="1" {{ old('student_status', $user->student_status ?? '') == '1' ? 'selected' : '' }}>Siswa Baru</option>
                    <option value="2" {{ old('student_status', $user->student_status ?? '') == '2' ? 'selected' : '' }}>Siswa Pindahan</option>
                </select>
            </div>
        </div>
        <div class="form-group row align-items-center mb-4">
            <div class="col-md-4">Jenis Kelamin <small class="text-danger">*</small></div>
            <div class="col-md-4">
                <select name="gender" id="gender" class="form-control">
                    <option value="">Pilih Jenis Kelamin</option>
                    <option value="laki-laki" {{ old('gender', $user->gender ?? '') == 'laki-laki' ? 'selected' : '' }}>Laki-Laki</option>
                    <option value="perempuan" {{ old('gender', $user->gender ?? '') == 'perempuan' ? 'selected' : '' }}>Perempuan</option>
                </select>
            </div>
        </div>
        <div class="form-group row align-items-center mb-4">
            <div class="col-md-4">Tempat & Tanggal Lahir <small class="text-danger">*</small></div>
            <div class="col-md-4"><input type="text" name="birthday_at" value="{{ old('birthday_at', $user->birthday_at ?? '') }}" id="birthday_at" placeholder="Masukan tempat lahir " class="form-control"></div>
            <div class="col-md-4"><input type="date" name="birthday" value="{{ old('birthday', $user->birthday ?? '') }}" id="birthday" placeholder="Masukan tanggal lahir " class="form-control"></div>
        </div>
        <div class="form-group row align-items-center mb-4">
            <div class="col-md-4">Alamat <small class="text-danger">*</small></div>
            <div class="col-md-4"><textarea name="address" id="address" rows="5" placeholder="Masukan alamat " class="form-control">{{ old('address', $user->address ?? '') }}</textarea></div>
        </div>
        <div class="form-group row align-items-center mb-4">
            <div class="col-md-4">No. Handphone <small class="text-danger">*</small></div>
            <div class="col-md-4"><input type="text" name="phone" id="phone" value="{{ old('phone', $user->phone ?? '') }}" placeholder="62821xxxxxxx" class="form-control"></div>
        </div>
        <div class="form-group row align-items-center mb-4">
            <div class="col-md-4">Photo <small class="text-danger">*</small></div>
            <div class="col-md-4">
                <input type="file" name="photo" id="photo" class="form-control"/>
                @if (Request::segment(5) == 'edit')
                    <img src="{{ $user->photo }}" alt="Photo" class="mt-3" width="120px"/>
                @endif
            </div>
        </div>
        
        @if (Request::segment(4) != 'mi')
            <h4>ASAL SEKOLAH</h4>
            <div class="form-group row align-items-center mb-4">
                <div class="col-md-4">Nama Sekolah <small class="text-danger">*</small></div>
                <div class="col-md-4"><input type="text" name="previous_school" value="{{ old('previous_school', $user->previous_school ?? '') }}" id="previous_school" placeholder="Masukan asal sekolah " class="form-control"></div>
            </div>
            <div class="form-group row align-items-center mb-4">
                <div class="col-md-4">Alamat Sekolah <small class="text-danger">*</small></div>
                <div class="col-md-4"><textarea name="previous_school_address" id="previous_school_address" rows="5" placeholder="Masukan alamat asal sekolah " class="form-control">{{ old('previous_school_address', $user->previous_school_address ?? '') }}</textarea></div>
            </div>
        @endif

        <h5>ORANG TUA</h5>
        <div class="form-group row align-items-center mb-4">
            <div class="col-md-4">Nama & Pekerjaan Ayah <small class="text-danger">*</small></div>
            <div class="col-md-4"><input type="text" name="father_name" id="father_name" value="{{ old('father_name', $user->father_job  ?? '') }}" placeholder="Masukan nama ayah " class="form-control"></div>
            <div class="col-md-4"><input type="text" name="father_job" id="father_job" value="{{ old('father_job', $user->father_job  ?? '') }}" placeholder="Masukan pekerjaan ayah " class="form-control"></div>
        </div>
        <div class="form-group row align-items-center mb-4">
            <div class="col-md-4">Nama & Pekerjaan Ibu <small class="text-danger">*</small></div>
            <div class="col-md-4"><input type="text" name="mother_name" id="mother_name" value="{{ old('mother_name', $user->mother_name  ?? '') }}" placeholder="Masukan nama ibu " class="form-control"></div>
            <div class="col-md-4"><input type="text" name="mother_job" id="mother_job" value="{{ old('mother_job', $user->mother_job  ?? '') }}" placeholder="Masukan pekerjaan ibu " class="form-control"></div>
        </div>
        <div class="form-group row align-items-center mb-4">
            <div class="col-md-4">Alamat Orang Tua <small class="text-danger">*</small></div>
            <div class="col-md-4"><textarea name="parents_address" id="parents_address" rows="5" placeholder="Masukan alamat asal sekolah " class="form-control">{{ old('parents_address', $user->parents_address ?? '') }}</textarea></div>
        </div>
        <div class="form-group row align-items-center mb-4">
            <div class="col-md-4">No. Handphone <small class="text-danger">*</small></div>
            <div class="col-md-4"><input type="number" name="parents_phone" id="parents_phone" value="{{ old('parents_phone', $user->parents_phone ?? '') }}" placeholder="62821xxxxxxx" class="form-control"></div>
        </div>
        <div class="form-group row align-items-center mb-4">
            <div class="col-md-4">{{ Request::segment(4) != 'mi' ? 'Kartu Keluarga & Ijazah' : 'Kartu Keluarga' }} <small class="text-danger">*</small></div>
            <div class="col-md-4">
                <input type="file" name="kk" id="kk" class="form-control"/>
                <small class="text-danger">* Format PDF</small>
                @if (isset($user->kk))
                    <p><small><a href="{{ $user->kk  ?? ''}}"><i class="bi bi-file-earmark-pdf-fill"></i> Download PDF </a></small></p>
                @endif
            </div>

            @if (Request::segment(4) != 'mi')
                <div class="col-md-4">
                    <input type="file" name="ijazah" id="ijazah" class="form-control">
                    <small class="text-danger">* Format PDF</small>
                    @if (isset($user->ijazah))
                        <p><small><a href="{{ $user->ijazah ?? '' }}"><i class="bi bi-file-earmark-pdf-fill"></i> Download PDF </a></small></p>
                    @endif
                </div>
            @endif
        </div>
        <div class="form-group text-end">
            <button type="submit" class="btn btn-primary px-5 py-3">SIMPAN</button>
        </div>
    </div>
</form>