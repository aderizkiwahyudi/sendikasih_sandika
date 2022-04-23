<x-app-layout title="Sistem Akademik">

    @push('styles')
        <link rel="stylesheet" href="{{ asset('css/recruitment-register-login.css') }}">
    @endpush

    <div class="container">
        <main class="d-flex align-items-center justify-content-center">
            <div>
                <div class="main-header text-center">
                    <a href="/"><img src="{{ asset('img/logo.png') }}" alt="Logo" width="135px"/></a>
                    <div class="my-5">
                        <h4>SISTEM <strong>PENERIMAAN GURU & KAARYAWAN</strong></h4>
                        <p class="desc">Pilih Jenis Penerimaan yang ingin anda masukan</p>
                    </div>
                </div>
                <div class="x-alert"></div>
                <div class="main-body">
                        <form method="post">
                            @csrf
                            <div class="registration-step-1">
                                <div class="rounded border form-data">
                                    <div class="form-group">
                                        <label for="">JENIS POSISI LAMARAN</label>
                                        <select name="jenis" class="form-control-custom">
                                            <option value="" class="text-placeholder">Pilih Posisi</option>
                                            <option value="3">GURU</option>
                                            <option value="4">KARYAWAN</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group my-4">
                                    <button type="button" name="next" class="btn btn-primary w-100 py-3">SELANJUTNYA</button>
                                </div>
                            </div>
                            <div class="registration-step-2" style="display: none;">
                                <div class="rounded border form-data">
                                    <div class="form-group border-bottom">
                                        <label for="">NAMA</label>
                                        <input type="text" name="name" placeholder="Masukan nama anda" class="form-control-custom"/>
                                    </div>
                                    <div class="form-group border-bottom">
                                        <label for="">USERNAME</label>
                                        <input type="text" name="username" placeholder="Masukan username anda" class="form-control-custom"/>
                                    </div>
                                    <div class="form-group border-bottom">
                                        <label for="">EMAIL</label>
                                        <input type="email" name="email" placeholder="Masukan email anda" class="form-control-custom"/>
                                    </div>
                                    <div class="form-group">
                                        <label for="">PASSWORD</label>
                                        <input type="password" name="password" placeholder="********" class="form-control-custom"/>
                                    </div>
                                </div>
                                <div class="form-group my-4">
                                    <button type="button" name="registration" class="btn btn-primary w-100 py-3">DAFTAR</button>
                                </div>
                            </div>
                        </form>
                </div>
                <div class="main-footer">
                    <p>Yayasan Sendikasih Sandika © 2022</p>
                </div>
            </div>
        </main>
    </div>

    @push('script')
        <script>
            $(document).ready(() => {
                let formData = [];
                
                $('button[name="next"]').on('click', function() {
                    $('.x-alerta').html('');

                    /* Validation Select */
                    if($('select[name="jenis"]').find('option:selected').val() == ''){
                        alerta('Jenis Pendaftaran tidak boleh kosong');
                        return true;
                    }
                    /* End Validation Select */
                    
                    $('.desc').html(`Selanjutnya, silakan isi data pendaftaran akun anda dengan benar`);

                    $('.registration-step-1').hide();
                    $('.registration-step-2').show();
                });
                
                $('button[name="registration"]').on('click', function () {
                    let btn = $(this);
                    btn.attr('disabled', true).html(`
                        <div class="spinner-border spinner-border-sm" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                    `);

                    $.ajax({
                        type: "POST",
                        url: "{{ route('recruitment.registration.prosess', Request::segment(2)) }}",
                        data: $('form').serializeArray(),
                        success: function (response) {
                            btn.removeAttr('disabled').html('Daftar');
                            if(response.success){
                                $('form')[0].reset();
                                alerta(response.message, true);
                                return true;
                            }


                            alerta(response.message);
                            return true;
                        },
                        error: function(err) {
                            btn.removeAttr('disabled').html('Daftar');
                            alerta('Terjadi kesalahan teknis, silakan hubungi admin');
                            console.log(err);
                            return true;
                        },
                    });
                });
            })

            function alerta(text, success = false){
                if(success){
                    return $('.x-alert').html(`
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        ${text}
                    </div>
                `);
                }

                return $('.x-alert').html(`
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        ${text}
                    </div>
                `);
            }
        </script>
    @endpush

</x-app-layout>