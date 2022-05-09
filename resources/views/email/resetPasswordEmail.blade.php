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
    <p>Anda melakukan permintaan reset password, jika anda merasa tidak melakukannya abaikan saja. Jika anda ingin melakukan permintaan reset password akun, silakan klik tombol reset dibawah ini. Link berlaku sampai dengan {{ $data['expired_at'] }}</p>
    <p>
        <a href="{{ url('reset-password-user?token=' . $data['token'] ) }}" class="text-white" style="color: #ffffff;">
            <div class="btn btn-primary text-white">RESET</div>
        </a>
    </p>
    <p>Terimakasih.</p>
</body>
</html>