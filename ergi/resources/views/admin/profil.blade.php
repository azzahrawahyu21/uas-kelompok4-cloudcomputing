<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Admin</title>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f4f6f4;
            margin: 0;
            padding: 40px 0;
            display: flex;
            justify-content: center;
            align-items: flex-start;
            min-height: 100vh;
        }

        .profile-wrapper {
            background-color: #ffffff;
            border-radius: 20px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
            padding: 40px 60px;
            width: 600px;
            max-width: 90%;
            display: flex;
            align-items: center;
            gap: 40px;
        }

        .profile-info {
            flex: 1;
        }

        h2 {
            margin: 0 0 20px;
            color: rgba(13, 71, 21, 1);
            font-size: 26px;
        }

        .info-item {
            margin-bottom: 15px;
        }

        .info-item label {
            display: block;
            font-weight: 600;
            color: #555;
            margin-bottom: 4px;
        }

        .info-item p {
            background-color: #f0f0f0;
            border-radius: 8px;
            padding: 10px 15px;
            color: #333;
            margin: 0;
            font-size: 15px;
        }

        .edit-btn {
            display: inline-block;
            background-color: #f97316;
            color: #fff;
            padding: 12px 25px;
            border: none;
            border-radius: 10px;
            text-decoration: none;
            font-weight: bold;
            transition: 0.3s;
            margin-top: 20px;
        }

        .edit-btn:hover {
            background-color: #a84702;
            transform: translateY(-2px);
        }

        @media (max-width: 600px) {
            .profile-wrapper {
                flex-direction: column;
                text-align: center;
                padding: 30px 20px;
            }
            .avatar {
                margin-bottom: 20px;
            }
            .profile-info {
                width: 100%;
            }
        }
    </style>
</head>
<body>
    <div class="profile-wrapper">

        <div class="profile-info">
            <h2>Profil Admin</h2>

            <div class="info-item">
                <label>Nama Lengkap</label>
                <p>{{ $admin->nama_pengguna }}</p>
            </div>

            <div class="info-item">
                <label>Email</label>
                <p>{{ $admin->email }}</p>
            </div>

            <div class="info-item">
                <label>Password</label>
                <p>********</p>
            </div>

            <a href="{{ route('admin.edit') }}" class="edit-btn">Edit Profil</a>
        </div>
    </div>
</body>
</html>
