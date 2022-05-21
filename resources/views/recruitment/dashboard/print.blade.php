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
                overflow: hidden;
            }

            .card-body {
                padding: 20px;
                border: 1px solid rgba(0,0,0,0.2);
                font-size: 12px;
                height:300px;
            }
            .card-footer {
                border: 1px solid rgba(0,0,0,0.2);
                font-size: 12px;
                text-align: center;
            }
            .card-header .logo {
                float: left;
                width: 20%;
                overflow:hidden;
            }
            .card-header .address {
                width:100%;
            }
            .card-header .address p {
                line-height: 1;
            }
            
            .card-body .photo {
                float:left;
                width: 25%;
                overflow:hidden;
            }
            
            .card-body .biodata {
                width: 70%;
                float: right;
            }
            
            table tr, table td {
                padding:10px;
            }
            
            .card-footer p {
                line-height: 1.3;
            }
        </style>
    @endpush

    <div class="container-card">
        <div class="card-header">
            <div class="me-4 logo">
               <img src="{{ asset('img/logo.png') }}" alt="logo" width="100px"/>
            </div>
            <div class="address">
                <h5>Yayasan Sendikasih Sandika</h5>
                <p>Jl. Palembang - Betung No.KM.14.5, Sukajadi, Kec. Talang Klp., Kab. Banyuasin, Sumatera Selatan 30953</p>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-3 photo">
                    <img src="{{ Auth::guard('recruitment')->user()->student->photo ?? Auth::guard('recruitment')->user()->teacher->photo ??  Auth::guard('recruitment')->user()->staff->photo ?? '' }}" width="100%" alt="">
                </div>
                <div class="col-md-9 biodata">
                    <table>
                    <tr class="form-grup row align-items-center mb-2">
                        <td class="col-md-4">No. Pendaftaran</td>
                        <td class="col-md-8">: {{ Auth::guard('recruitment')->user()->recruitment->no_registration ?? '' }}</td>
                    </tr>
                    <tr class="form-grup row align-items-center mb-2">
                        <td class="col-md-4">Nama</td>
                        <td class="col-md-8">: {{ Auth::guard('recruitment')->user()->student->name ?? Auth::guard('recruitment')->user()->teacher->name ??  Auth::guard('recruitment')->user()->staff->name ?? '' }}</td>
                    </tr>
                    <tr class="form-grup row align-items-center mb-2">
                        <td class="col-md-4">Jenis Kelamin</td>
                        <td class="col-md-8" style="text-transform: capitalize;">: {{ Auth::guard('recruitment')->user()->student->gender ?? Auth::guard('recruitment')->user()->teacher->gender ??  Auth::guard('recruitment')->user()->staff->gender ?? '' }}</td>
                    </tr>
                    <tr class="form-grup row align-items-center mb-2">
                        <td class="col-md-4">TTL</td>
                        <td class="col-md-8" style="text-transform: capitalize;">: 
                            {{ 
                                Auth::guard('recruitment')->user()->student->birthday_at ?? Auth::guard('recruitment')->user()->teacher->birthday_at ??  Auth::guard('recruitment')->user()->staff->birthday_at ?? ''
                            }}, 
                            {{
                                Auth::guard('recruitment')->user()->student->birthday ?? Auth::guard('recruitment')->user()->teacher->birthday ??  Auth::guard('recruitment')->user()->staff->birthday ?? '' 
                            }}
                        </td>
                    </tr>
                    <tr class="form-grup row align-items-center mb-2">
                        <td class="col-md-4">No. Handphone</td>
                        <td class="col-md-8">: {{ Auth::guard('recruitment')->user()->student->phone ?? Auth::guard('recruitment')->user()->teacher->phone ??  Auth::guard('recruitment')->user()->staff->phone ?? '' }}</td>
                    </tr>
                </table>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <p>
            Peserta dinyatakan lolos seleksi penerimaan {{ Auth::guard('recruitment')->user()->unit_id == 1 ? 'Guru & Karyawan' : 'Peserta Didik' }} Yayasan Sendikasih Sandika.
            </p>
        </div>
    </div>

    <script type="text/javascript">
        $(document).ready(function () {
            window.print();
        });
    </script>
</x-app-layout>