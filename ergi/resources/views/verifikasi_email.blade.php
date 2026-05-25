<!-- resources/views/login.blade.php -->
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifikasi Email</title>
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
        h4 {
            text-align: center;
            color: #fff;
            margin-bottom: 35px;
            font-size: 16px;
        }
        .input-verifemail {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }
        .code-input {
            width: 50px;
            height: 50px;
            text-align: center;
            font-size: 18px;
            border: 1px solid #ddd;
            border-radius: 8px;
            background-color: #f8f8f8;
            outline: none;
            transition: 0.3s;
        }
        .code-input:focus {
            border-color: #f97316;
            box-shadow: 0 0 5px rgba(244,162,97,0.5);
        }
        .timer {
            text-align: center;
            color: #fff;
            margin-bottom: 20px;
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
            <h2>VERIFIKASI EMAIL</h2>
            <h4>Masukkan kode 4 digit yang Anda terima di email</h4>

            @if (session('success'))
                <div class="success">{{ session('success') }}</div>
            @endif
            @if ($errors->any())
                <div class="error">{{ $errors->first() }}</div>
            @endif

            <form action="{{ route('verify.code.submit') }}" method="POST">
                @csrf
                <input type="hidden" name="email" value="{{ $email }}">
                <div class="input-verifemail">
                    <input type="text" maxlength="1" name="digit1" class="code-input" required>
                    <input type="text" maxlength="1" name="digit2" class="code-input" required>
                    <input type="text" maxlength="1" name="digit3" class="code-input" required>
                    <input type="text" maxlength="1" name="digit4" class="code-input" required>
                </div>
                <p id="timer" class="timer">600s</p>
                <button type="submit">MEMERIKSA</button>
            </form>
        </div>
    </div>
</body>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        let timeLeft = 600;
        const timerElement = document.getElementById('timer');

        function formatTime(seconds) {
            let minutes = Math.floor(seconds / 60);
            let secs = seconds % 60;
            return `${String(minutes).padStart(2, '0')}:${String(secs).padStart(2, '0')}`;
        }

        timerElement.textContent = formatTime(timeLeft); 

        const interval = setInterval(() => {
            timeLeft--;
            // timerElement.textContent = `${timeLeft}s`;
            timerElement.textContent = formatTime(timeLeft);
            if (timeLeft <= 0) {
                clearInterval(interval);
                timerElement.textContent = 'Kode telah kadaluarsa';
            }
        }, 1000);

        const inputs = document.querySelectorAll('.code-input');
        inputs.forEach((input, index) => {
            input.addEventListener('input', () => {
                if (input.value.length === 1 && index < inputs.length - 1) {
                    inputs[index + 1].focus();
                }
            });
            input.addEventListener('keydown', (e) => {
                if (e.key === 'Backspace' && input.value.length === 0 && index > 0) {
                    inputs[index - 1].focus();
                }
            });
        });
    });
</script>
</html>
