<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Inventory Management System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
        }
        .register-card {
            backdrop-filter: blur(10px);
            background: rgba(255, 255, 255, 0.9);
        }
    </style>
</head>
<body class="d-flex align-items-center justify-content-center">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-4">
                <div class="card register-card shadow-lg">
                    <div class="card-body p-5">
                        <div class="text-center mb-4">
                            <h2 class="fw-bold">Daftar Akun</h2>
                            <p class="text-muted">Buat akun baru untuk mengakses sistem</p>
                        </div>

                        @if($errors->any())
                            <div class="alert alert-danger">
                                @foreach($errors->all() as $error)
                                    <div>{{ $error }}</div>
                                @endforeach
                            </div>
                        @endif

                        <form id="registerForm">
                            <div class="mb-3">
                                <label for="name" class="form-label">Nama</label>
                                <input type="text" class="form-control" id="name" name="name" required>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>
                            <div class="mb-3">
                                <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
                            </div>
                            <button type="submit" class="btn btn-primary w-100">Daftar</button>
                        </form>
                        <div id="registerAlert" class="alert d-none mt-3"></div>
                        <script>
                        document.getElementById('registerForm').addEventListener('submit', async function(e) {
                            e.preventDefault();
                            const form = e.target;
                            const data = {
                                name: form.name.value,
                                email: form.email.value,
                                password: form.password.value,
                                password_confirmation: form.password_confirmation.value,
                                _token: '{{ csrf_token() }}'
                            };
                            const alertBox = document.getElementById('registerAlert');
                            alertBox.classList.add('d-none');
                            alertBox.classList.remove('alert-danger', 'alert-success');

                            try {
                                const response = await fetch('/api/register', {
                                    method: 'POST',
                                    headers: {
                                        'Content-Type': 'application/json',
                                        'Accept': 'application/json'
                                    },
                                    body: JSON.stringify(data)
                                });

                                const result = await response.json();

                                if (response.ok) {
                                    alertBox.textContent = 'Registrasi berhasil! Silakan login.';
                                    alertBox.classList.add('alert', 'alert-success', 'd-block');
                                    form.reset();
                                    // window.location.href = '/login';
                                } else {
                                    let msg = '';
                                    if (result.errors) {
                                        Object.values(result.errors).forEach(errArr => {
                                            msg += errArr.join(' ') + ' ';
                                        });
                                    } else if (result.message) {
                                        msg = result.message;
                                    } else {
                                        msg = 'Registrasi gagal.';
                                    }
                                    alertBox.textContent = msg;
                                    alertBox.classList.add('alert', 'alert-danger', 'd-block');
                                }
                            } catch (err) {
                                alertBox.textContent = 'Terjadi kesalahan. Silakan coba lagi.';
                                    alertBox.classList.add('alert', 'alert-danger', 'd-block');
                                }
                            } catch (err) {
                                alertBox.textContent = 'Terjadi kesalahan. Silakan coba lagi.';
                                alertBox.classList.add('alert', 'alert-danger', 'd-block');
                            }
                        });
                        </script>

                        <div class="text-center mt-3">
                            <p class="text-muted">Sudah punya akun? <a href="{{ route('login') }}">Login di sini</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
