<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Kelola Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f1f4f2;
            margin: 0;
            padding: 90px;
            color: #0D4715;
        }

        .navbar {
            background-color: white !important;
            box-shadow: 0 2px 10px rgba(0,0,0,0.08);
            border-radius: 0 0 30px 30px;
        }

        .navbar-brand img {
            width: 70px;
            margin-right: 10px;
        }

        .navbar-brand span {
            color: #0D4715;
            font-weight: 700;
        }

        .nav-link {
            color: #333 !important;
            font-weight: 500;
            margin: 0 10px;
            transition: 0.3s;
        }

        .nav-link:hover {
            color: #0D4715 !important;
        }

        .btn-login {
            border-radius: 20px;
            background-color: #0D4715;
            border: none;
            color: white;
            padding: 6px 20px;
            font-size: 0.95rem;
            transition: 0.3s;
        }

        .btn-login:hover {
            background-color: white;
            color: #0D4715;
            border: 1px solid #0D4715;
        }

        h2 {
            text-align: center;
            margin-bottom: 10px;
            margin-top: 20px;
        }

        .welcome {
            text-align: center;
            font-weight: bold;
            margin-bottom: 30px;
            color: #0D4715;
        }

        .wrapper {
            display: flex;
            gap: 30px;
            background-color: #ffffff;
            border-radius: 14px;
            padding: 30px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.08);
        }

        .form-container {
            flex: 1;
            border-right: 1px solid #e0e0e0;
            padding-right: 25px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        input[type="text"],
        input[type="email"],
        input[type="password"],
        select {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 6px;
            box-sizing: border-box;
        }

        input:disabled {
            background-color: #e0e0e0;
            cursor: not-allowed;
        }

        button {
            width: 100%;
            background-color: #0D4715;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 6px;
            font-size: 15px;
            cursor: pointer;
        }

        button:hover {
            background-color: #0b3a12;
        }

        .success, .error {
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 15px;
            font-size: 14px;
        }

        .success {
            background-color: #d4edda;
            color: #155724;
        }

        .error {
            background-color: #f8d7da;
            color: #721c24;
        }

        .table-container {
            flex: 2;
            padding-left: 25px;
        }

        .table-container h3 {
            margin-top: 0;
            margin-bottom: 10px;
            font-size: 18px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 5px;
        }

        th, td {
            padding: 12px;
            text-align: center;
        }

        th {
            background-color: #0D4715;
            color: #fff;
            font-weight: normal;
        }

        th:last-child, td:last-child {
            min-width: 100px;
        }

        tr:nth-child(even) {
            background-color: #f9faf9;
        }

        tr:hover {
            background-color: #f0f3f0;
        }

        .switch {
            position: relative;
            display: inline-block;
            width: 50px;
            height: 28px;
        }

        .switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }

        .slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #ccc;
            transition: 0.4s;
            border-radius: 34px;
        }

        .slider:before {
            position: absolute;
            content: "";
            height: 22px;
            width: 22px;
            left: 3px;
            bottom: 3px;
            background-color: white;
            transition: .4s;
            border-radius: 50%;
        }

        input:checked + .slider {
            background-color: #0D4715;
        }

        input:checked + .slider:before {
            transform: translateX(22px);
        }

        .edit-btn, .delete-btn {
            color: white;
            border: none;
            border-radius: 6px;
            padding: 6px 10px;
            cursor: pointer;
            transition: 0.3s;
            width: 36px;
            height: 36px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 14px;
            line-height: 1;
            box-sizing: border-box;
        }

        .edit-btn {
            background-color: #3498db;
        }

        .edit-btn:hover {
            background-color: #2980b9;
        }

        .delete-btn {
            background-color: #c0392b;
        }

        .delete-btn:hover {
            background-color: #e74c3c;
        }

        .action-buttons {
            display: flex;
            justify-content: center;
            gap: 6px;
            align-items: center;
        }

        .action-buttons form {
            display: inline;
            margin: 0;
        }

        @media (max-width: 900px) {
            .wrapper {
                flex-direction: column;
            }

            .form-container {
                border-right: none;
                border-bottom: 1px solid #e0e0e0;
                padding-right: 0;
                padding-bottom: 25px;
            }

            .table-container {
                padding-left: 0;
                padding-top: 15px;
            }

            th:last-child, td:last-child {
                min-width: 90px;
            }

            .edit-btn, .delete-btn {
                width: 32px;
                height: 32px;
            }
        }

        .profile-overlay, .edit-user-overlay {
            display: none;
            position: fixed;
            z-index: 1050;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0,0,0,0.3);
            backdrop-filter: blur(3px);
            justify-content: center;
            align-items: center;
        }

        .profile-overlay.show, .edit-user-overlay.show {
            display: flex;
            animation: fadeIn 0.3s ease;
        }

        .overlay-content {
            background: #fff;
            padding: 20px;
            border-radius: 12px;
            width: 320px;
            max-width: 90%;
            box-shadow: 0 4px 15px rgba(0,0,0,0.2);
        }

        .overlay-content input, .overlay-content select {
            width: 100%;
            padding: 8px;
            margin-bottom: 8px;
            border: 1px solid #ccc;
            border-radius: 6px;
            font-size: 0.9rem;
        }

        .overlay-content input:disabled {
            background-color: #e0e0e0;
            cursor: not-allowed;
        }

        .overlay-content button {
            padding: 6px 12px;
            border-radius: 6px;
            font-size: 0.9rem;
            cursor: pointer;
        }

        .btn-success {
            background-color: #0D4715;
            color: white;
            border: none;
            margin-top: 5px;
        }

        .btn-success:hover {
            background-color: #0b3a12;
        }

        .btn-secondary {
            background-color: #aaa;
            color: white;
            border: none;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: scale(0.95); }
            to { opacity: 1; transform: scale(1); }
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg fixed-top">
        <div class="container d-flex justify-content-between align-items-center">
            <a class="navbar-brand d-flex align-items-center" href="#">
                <img src="{{ asset('assets/img/navbar/logo 1.png') }}" alt="Logo">
                <div>
                    <span>Desa Driyorejo</span><br>
                    <small style="color:#555;">Kec. Driyorejo, Kab. Magetan</small>
                </div>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="d-flex align-items-center" style="gap: 15px;">
                <a href="javascript:void(0)" id="profileIcon" class="text-dark d-flex align-items-center" style="font-size:2rem; text-decoration:none;" title="Profil Saya">
                    <i class="bi bi-person-circle" style="transition:0.3s; cursor:pointer;"></i>
                </a>
                @auth
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="btn btn-login">Logout</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="btn btn-login">Login</a>
                @endauth
            </div>
        </div>  
    </nav>

    <div id="profileOverlay" class="profile-overlay">
        <div class="overlay-content shadow">
            <h6 style="text-align:center; font-weight:bold; color:#0D4715;">Profil Akun</h6>
            <hr style="margin:8px 0;">
            <form id="updateProfileForm" method="POST" action="{{ route('profile.update') }}">
                @csrf
                <label>Email</label>
                <p>{{ auth()->user()->email ?? 'Tidak tersedia' }}</p>
                <label>Nama Pengguna</label>
                <input type="text" name="nama_pengguna" value="{{ auth()->user()->nama_pengguna ?? '' }}" required>
                <label>Password</label>
                <input type="password" name="kata_sandi" placeholder="Masukkan password baru">
                <label>Konfirmasi Password</label>
                <input type="password" name="kata_sandi_confirmation" placeholder="Konfirmasi password baru">
                <div style="text-align:right; margin-top:10px;">
                    <button type="button" class="btn btn-secondary" id="closeProfileOverlay">Batal</button>
                    <button type="submit" class="btn btn-success">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    <div id="editUserOverlay" class="edit-user-overlay">
        <div class="overlay-content shadow">
            <h6 style="text-align:center; font-weight:bold; color:#0D4715;">Edit Pengguna</h6>
            <hr style="margin:8px 0;">
            <form id="editUserForm" method="POST" action="">
                @csrf
                @method('PUT')
                <input type="hidden" name="id_pengguna" value="">
                <label>Email</label>
                <p class="user-email"></p>
                <label>Nama Pengguna</label>
                <input type="text" name="nama_pengguna" value="" required>
                <label>Peran</label>
                <select name="peran" required>
                    <option value="admin">Admin</option>
                    <option value="superadmin">Superadmin</option>
                </select>
                <label>Status</label>
                <p class="user-status"></p>
                <label>Password Baru (Kosongkan jika tidak ingin mengubah)</label>
                <input type="password" name="kata_sandi" placeholder="Masukkan password baru">
                <div style="text-align:right; margin-top:10px;">
                    <button type="button" class="btn btn-secondary" id="closeEditUserOverlay">Batal</button>
                    <button type="submit" class="btn btn-success">Simpan</button>
                </div>
            </form>
        </div>
    </div>
    
    <h2>Manajemen Pengguna</h2>
    <p class="welcome">Selamat datang, {{ auth()->user()->nama_pengguna }}</p>

    <div class="wrapper">
        <div class="form-container">
            @if(session('success'))
                <div class="success">{{ session('success') }}</div>
            @endif
            @if($errors->any())
                <div class="error">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form method="POST" action="{{ route('superadmin.addAdmin.submit') }}" autocomplete="off">
                @csrf
                <label>Nama Pengguna:</label>
                <input type="text" name="nama_pengguna" autocomplete="off" required>
                <label>Email:</label>
                <input type="email" name="email" autocomplete="off" required>
                <label>Password:</label>
                <input type="password" name="kata_sandi" autocomplete="off" required>
                <label>Peran:</label>
                <select name="peran" required>
                    <option value="">-- Pilih Peran --</option>
                    <option value="admin" {{ old('peran') == 'admin' ? 'selected' : '' }}>Admin</option>
                    <option value="superadmin" {{ old('peran') == 'superadmin' ? 'selected' : '' }}>Superadmin</option>
                </select>
                <button type="submit">Tambah Pengguna</button>
            </form>
        </div>

        <div class="table-container">
            <h3><b>Daftar Pengguna</b></h3>
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Admin</th>
                        <th>Email</th>
                        <th>Peran</th>
                        <th>Status</th>
                        <th>Aksi</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($penggunas as $index => $pengguna)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $pengguna->nama_pengguna }}</td>
                            <td>{{ $pengguna->email }}</td>
                            <td>{{ $pengguna->peran }}</td>
                            <td id="status-{{ $pengguna->id_pengguna }}">{{ $pengguna->status }}</td>
                            <td>
                                <label class="switch">
                                    <input type="checkbox" 
                                        class="toggle-admin" 
                                        data-id="{{ $pengguna->id_pengguna }}" 
                                        {{ $pengguna->status === 'Aktif' ? 'checked' : '' }}>
                                    <span class="slider"></span>
                                </label>
                            </td>
                            <td>
                                <div class="action-buttons">
                                    <button type="button" class="edit-btn" 
                                            data-id="{{ $pengguna->id_pengguna }}"
                                            data-nama="{{ $pengguna->nama_pengguna }}"
                                            data-email="{{ $pengguna->email }}"
                                            data-peran="{{ $pengguna->peran }}"
                                            data-status="{{ $pengguna->status }}"
                                            title="Edit Pengguna">
                                        <i class="bi bi-pencil"></i>
                                    </button>
                                    <form action="{{ route('superadmin.deletePengguna', $pengguna->id_pengguna) }}" 
                                          method="POST" 
                                          class="action-buttons"
                                          onsubmit="return confirm('Yakin ingin menghapus admin ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="delete-btn" title="Hapus Pengguna">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // Profile overlay
            const profileIcon = document.getElementById('profileIcon');
            const profileOverlay = document.getElementById('profileOverlay');
            const closeProfileOverlay = document.getElementById('closeProfileOverlay');
            const editUserOverlay = document.getElementById('editUserOverlay');
            const closeEditUserOverlay = document.getElementById('closeEditUserOverlay');
            const editButtons = document.querySelectorAll('.edit-btn');

            // Profile overlay handling
            if (profileIcon && profileOverlay && closeProfileOverlay) {
                profileIcon.addEventListener('click', () => {
                    profileOverlay.classList.toggle('show');
                    editUserOverlay.classList.remove('show');
                });

                closeProfileOverlay.addEventListener('click', () => {
                    profileOverlay.classList.remove('show');
                });

                document.addEventListener('click', (e) => {
                    if (!profileOverlay.contains(e.target) && !profileIcon.contains(e.target)) {
                        profileOverlay.classList.remove('show');
                    }
                });
            } else {
                console.error('Profile overlay elements not found');
            }

            // Edit user overlay handling
            if (editUserOverlay && closeEditUserOverlay && editButtons) {
                editButtons.forEach(button => {
                    button.addEventListener('click', () => {
                        const id = button.dataset.id;
                        const nama = button.dataset.nama;
                        const email = button.dataset.email;
                        const peran = button.dataset.peran;
                        const status = button.dataset.status;

                        // Isi form di overlay
                        const form = document.getElementById('editUserForm');
                        form.action = `/superadmin/update-pengguna/${id}`;
                        form.querySelector('input[name="id_pengguna"]').value = id;
                        form.querySelector('input[name="nama_pengguna"]').value = nama;
                        form.querySelector('.user-email').textContent = email;
                        form.querySelector('select[name="peran"]').value = peran.toLowerCase();
                        form.querySelector('.user-status').textContent = status;

                        editUserOverlay.classList.add('show');
                        profileOverlay.classList.remove('show');
                    });
                });

                closeEditUserOverlay.addEventListener('click', () => {
                    editUserOverlay.classList.remove('show');
                });

                document.addEventListener('click', (e) => {
                    if (!editUserOverlay.contains(e.target) && !e.target.classList.contains('edit-btn')) {
                        editUserOverlay.classList.remove('show');
                    }
                });
            } else {
                console.error('Edit user overlay elements not found');
            }

            // Toggle admin status
            const toggleAdmins = document.querySelectorAll('.toggle-admin');
            if (toggleAdmins) {
                toggleAdmins.forEach(toggle => {
                    toggle.addEventListener('change', async function() {
                        const id = this.dataset.id;
                        const csrf = '{{ csrf_token() }}';
                        const checked = this.checked;
                        const statusCell = document.getElementById(`status-${id}`);

                        try {
                            const response = await fetch(`/toggle-admin-ajax/${id}`, {
                                method: 'POST',
                                headers: {
                                    'X-CSRF-TOKEN': csrf,
                                    'Accept': 'application/json',
                                },
                            });

                            const result = await response.json();
                            console.log('Toggle Response:', result);

                            if (result.success) {
                                const newStatus = result.status === 'Aktif' ? 'Aktif' : 'Tidak Aktif';
                                statusCell.textContent = newStatus;
                                statusCell.style.color = result.status === 'Aktif' ? '#0D4715' : '#888';
                            } else {
                                alert('Gagal memperbarui status.');
                                this.checked = !checked;
                            }
                        } catch (err) {
                            console.error('Toggle Error:', err);
                            alert('Gagal terhubung ke server.');
                            this.checked = !checked;
                        }
                    });
                });
            } else {
                console.error('Toggle admin elements not found');
            }
        });
    </script>
</body>
</html>