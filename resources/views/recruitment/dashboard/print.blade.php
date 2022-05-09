<x-app-layout>

    @push('styles')
        <style>
            .container-card {
                width: 500px;
                background: #fff;
                border: 2px dashed rgba(0,0,0,0.5);
                padding: 10px;
            }
            .card-header {
                display: flex;
                align-items: center;
                border: 1px solid rgba(0,0,0,0.2);
                padding: 20px;
            }

            .card-header h5 {
                font-size: 14px;
                font-weight: bold;
            }

            .card-header p {
                font-size: 12px;
                margin: 0;
            }

            .card-body {
                padding: 20px;
                border: 1px solid rgba(0,0,0,0.2);
                font-size: 12px;
            }
            .card-footer {
                border: 1px solid rgba(0,0,0,0.2);
                font-size: 12px;
                text-align: center;
            }
        </style>
    @endpush

    <div class="container-card">
        <div class="card-header">
            <div class="me-4">
               <img src="{{ asset('img/logo.png') }}" alt="logo" width="100px"/>
            </div>
            <div>
                <h5>Yayasan Sendikasih Sandika</h5>
                <p>Jl. Palembang - Betung No.KM.14.5, Sukajadi, Kec. Talang Klp., Kab. Banyuasin, Sumatera Selatan 30953</p>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-3">
                    <img src="{{ Auth::guard('recruitment')->user()->student->photo ?? Auth::guard('recruitment')->user()->teacher->photo ??  Auth::guard('recruitment')->user()->staff->photo ?? '' }}" width="100%" alt="">
                </div>
                <div class="col-md-9">
                    <div class="form-grup row align-items-center mb-2">
                        <div class="col-md-4">No. Pendaftaran</div>
                        <div class="col-md-8">: {{ Auth::guard('recruitment')->user()->recruitment->no_registration ?? '' }}</div>
                    </div>
                    <div class="form-grup row align-items-center mb-2">
                        <div class="col-md-4">Nama</div>
                        <div class="col-md-8">: {{ Auth::guard('recruitment')->user()->student->name ?? Auth::guard('recruitment')->user()->teacher->name ??  Auth::guard('recruitment')->user()->staff->name ?? '' }}</div>
                    </div>
                    <div class="form-grup row align-items-center mb-2">
                        <div class="col-md-4">Jenis Kelamin</div>
                        <div class="col-md-8" style="text-transform: capitalize;">: {{ Auth::guard('recruitment')->user()->student->gender ?? Auth::guard('recruitment')->user()->teacher->gender ??  Auth::guard('recruitment')->user()->staff->gender ?? '' }}</div>
                    </div>
                    <div class="form-grup row align-items-center mb-2">
                        <div class="col-md-4">TTL</div>
                        <div class="col-md-8" style="text-transform: capitalize;">: 
                            {{ 
                                Auth::guard('recruitment')->user()->student->birthday_at ?? Auth::guard('recruitment')->user()->teacher->birthday_at ??  Auth::guard('recruitment')->user()->staff->birthday_at ?? ''
                            }}, 
                            {{
                                Auth::guard('recruitment')->user()->student->birthday ?? Auth::guard('recruitment')->user()->teacher->birthday ??  Auth::guard('recruitment')->user()->staff->birthday ?? '' 
                            }}
                        </div>
                    </div>
                    <div class="form-grup row align-items-center mb-2">
                        <div class="col-md-4">No. Handphone</div>
                        <div class="col-md-8">: {{ Auth::guard('recruitment')->user()->student->phone ?? Auth::guard('recruitment')->user()->teacher->phone ??  Auth::guard('recruitment')->user()->staff->phone ?? '' }}</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer">
            Peserta dinyatakan lolos seleksi penerimaan {{ Auth::guard('recruitment')->user()->unit_id == 1 ? 'Guru & Karyawan' : 'Peserta Didik' }} Yayasan Sendikasih Sandika.
        </div>
    </div>

    <script type="text/javascript">
        $(document).ready(function () {
            window.print();
        });
    </script>
</x-app-layout>