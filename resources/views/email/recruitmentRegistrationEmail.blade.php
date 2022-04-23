<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        a {
            text-decoration: none;
            color: #ffffff;
        }
        a:visited {
            color: #ffffff;
        }
        .btn {
            padding: 12px 24px;
            border-radius: 5px;
            width: fit-content;
        }
        .btn-primary {
            background: #0052D9;
            color: #ffffff;
        }
        .text-white {
            color: #ffffff;
        }
    </style>
</head>
<body>
    <h4>Halo, {{ $data['name'] }}</h4>
    <p>Anda telah berhasil melakukan pendaftaran akun. Untuk melakukan langkah selanjutnya, silakan lakukan aktivasi akun terlebih dahulu dengan mengklik tombol dibawah ini.</p>
    <p>
        <a href="{{ url('aktivasi?token=' . $data['token'] ) }}" class="text-white" style="color: #ffffff;">
            <div class="btn btn-primary text-white">AKTIFKAN AKUN</div>
        </a>
    </p>
    <p>Terimakasih.</p>
</body>
</html>