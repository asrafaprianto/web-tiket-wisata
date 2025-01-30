<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="e-Tiket Wisata">
    <meta name="author" content="Sentana Teknologi">
    <title>Daftar ke e-Tiket Wisata</title>

    <link href="/css/bootstrap.min.css" rel="stylesheet">

    <!-- Favicons -->
    <link rel="icon" href="/img/favicon.ico">
    <meta name="theme-color" content="#712cf9">

    <style>
    body {
        font-family: 'Nunito', sans-serif;
        background: linear-gradient(to right, #6a11cb, #2575fc);
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        margin: 0;
    }

    .form-signin {
        background: #fff;
        padding: 30px;
        border-radius: 15px;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
        max-width: 400px;
        width: 100%;
        text-align: center;
    }

    .form-signin h1 {
        font-size: 1.8rem;
        margin-bottom: 20px;
        color: #333;
    }

    .form-signin p {
        margin-bottom: 20px;
        font-size: 0.9rem;
        color: #555;
    }

    .form-floating label {
        color: #666;
    }

    .form-control {
        background: #f9f9f9;
        border: 1px solid #ddd;
        border-radius: 10px;
        padding: 10px 15px;
        font-size: 1rem;
        margin-bottom: 15px;
        color: #333;
    }

    .form-control:focus {
        border-color: #6a11cb;
        box-shadow: 0 0 5px rgba(106, 17, 203, 0.5);
    }

    .btn-primary {
        background-color: #6a11cb;
        border: none;
        border-radius: 10px;
        padding: 10px 20px;
        font-size: 1rem;
        font-weight: bold;
        transition: all 0.3s ease;
    }

    .btn-primary:hover {
        background-color: #2575fc;
    }

    .form-signin a {
        color: #6a11cb;
        text-decoration: none;
        font-weight: bold;
    }

    .form-signin a:hover {
        color: #2575fc;
    }

    .footer {
        margin-top: 20px;
        font-size: 0.9rem;
        color: #aaa;
    }
    </style>
</head>

<body>
    <main class="form-signin">
        <form action="/doregister" method="POST">
            @csrf
            <h1>Daftar Baru</h1>
            <p>Bergabunglah dengan e-Tiket Wisata dan nikmati kemudahan perjalanan Anda!</p>

            <div class="form-floating">
                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                    id="floatingName" placeholder="Nama Lengkap" value="{{ old('name') }}">
                <label for="floatingName">Nama</label>
                @error('name')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
                @enderror
            </div>

            <div class="form-floating">
                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                    id="floatingEmail" placeholder="name@example.com" value="{{ old('email') }}">
                <label for="floatingEmail">Alamat Email</label>
                @error('email')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
                @enderror
            </div>

            <div class="form-floating">
                <input type="password" name="password" class="form-control @error('password') is-invalid @enderror"
                    id="floatingPassword" placeholder="Kata Sandi">
                <label for="floatingPassword">Kata Sandi</label>
                @error('password')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
                @enderror
            </div>

            <button class="w-100 btn btn-lg btn-primary" type="submit">Daftar</button>
            <p class="footer">Sudah punya akun? <a href="/login">Masuk Sekarang</a></p>
        </form>
    </main>
</body>

</html>