<!-- resources/views/login.blade.php -->
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lupa Kata Sandi</title>
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

        input[type="email"], input[type="password"] {
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
            width: 107%;
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

        .error {
            background-color: #fdecea;
            color: #d32f2f;
            padding: 10px;
            border-radius: 6px;
            margin-bottom: 15px;
            text-align: center;
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
            <h2>LUPA KATA SANDI</h2>
            <h4>Masukkan email Anda untuk proses verifikasi, kami akan mengirimkan kode 4 digit ke email Anda</h4>

            @if ($errors->any())
                <div class="error">{{ $errors->first() }}</div>
            @endif

            <form method="POST" action="{{ route('forgot.password.submit') }}">
                @csrf
                <label for="email">Email</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" placeholder="Masukkan email Anda" required>
                
                <button type="submit">MELANJUTKAN</button>
            </form>
        </div>
    </div>
</body>
</html>
