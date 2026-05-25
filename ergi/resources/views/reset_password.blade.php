<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Kata Sandi</title>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #ffffff;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }
        .wrapper {
            display: flex;
            background: #fff;
            border-radius: 15px;
            overflow: hidden;
            width: 1000px;
            max-width: 95%;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.42);
        }
        .illustration {
            flex: 1;
            background: url("{{ asset('assets/img/login.png') }}") center/contain no-repeat;
            background-color: #fff;
        }
        .login-container {
            flex: 1;
            background-color: rgba(13, 71, 21, 1);
            padding: 60px 50px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            color: #fff;
        }
        h2 {
            text-align: center;
            color: #fff;
            margin-bottom: 35px;
            font-size: 26px;
            letter-spacing: 1px;
        }
        label {
            color: #fff;
            font-weight: 500;
            margin-bottom: 6px;
            display: block;
        }
        input[type="password"] {
            width: 100%;
            padding: 14px;
            margin-bottom: 22px;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 15px;
            outline: none;
            transition: 0.3s;
            background-color: #f8f8f8;
        }
        input:focus {
            border-color: #f97316;
            box-shadow: 0 0 5px rgba(244,162,97,0.5);
        }
        button {
            width: 100%;
            padding: 15px;
            background-color: #f97316;
            color: #fff;
            border: none;
            border-radius: 8px;
            font-size: 17px;
            font-weight: bold;
            cursor: pointer;
            transition: 0.3s;
        }
        button:hover {
            background-color: #a84702ff;
            transform: translateY(-1px);
        }
        .error, .success {
            padding: 10px;
            border-radius: 6px;
            margin-bottom: 15px;
            text-align: center;
        }
        .error {
            background-color: #fdecea;
            color: #d32f2f;
        }
        .success {
            background-color: #e6ffed;
            color: #2e7d32;
        }
        @media (max-width: 768px) {
            .wrapper {
                flex-direction: column;
                width: 95%;
            }
            .illustration {
                height: 250px;
            }
            .login-container {
                padding: 40px 30px;
            }
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="illustration"></div>
        <div class="login-container">
            <h2>RESET KATA SANDI</h2>

            @if (session('success'))
                <div class="success">{{ session('success') }}</div>
            @endif
            @if ($errors->any())
                <div class="error">{{ $errors->first() }}</div>
            @endif

            <form method="POST" action="{{ route('reset.password.submit') }}">
                @csrf
                <input type="hidden" name="email" value="{{ $email }}">
                <label for="kata_sandi">Kata Sandi Baru</label>
                <input type="password" id="kata_sandi" name="kata_sandi" placeholder="Masukkan kata sandi baru" required>
                <label for="kata_sandi_confirmation">Konfirmasi Kata Sandi</label>
                <input type="password" id="kata_sandi_confirmation" name="kata_sandi_confirmation" placeholder="Konfirmasi kata sandi" required>
                <button type="submit">RESET KATA SANDI</button>
            </form>
        </div>
    </div>
</body>
</html>