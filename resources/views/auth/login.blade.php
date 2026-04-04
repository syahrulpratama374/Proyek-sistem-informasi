<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login - Salero Bundo</title>
</head>
<body style="display: flex; justify-content: center; align-items: center; height: 100vh; background-color: #f4f6f9; font-family: sans-serif;">

    <div style="background: white; padding: 40px; border-radius: 8px; box-shadow: 0 4px 8px rgba(0,0,0,0.1); width: 300px;">
        <h2 style="text-align: center; margin-bottom: 20px;">Masuk</h2>
        <form action="/login" method="POST">
            <div style="margin-bottom: 15px;">
                <label style="display: block; margin-bottom: 5px;">Email / Username</label>
                <input type="text" style="width: 100%; padding: 8px; box-sizing: border-box;" placeholder="Masukkan email">
            </div>
            <div style="margin-bottom: 20px;">
                <label style="display: block; margin-bottom: 5px;">Password</label>
                <input type="password" style="width: 100%; padding: 8px; box-sizing: border-box;" placeholder="Masukkan password">
            </div>
            <button style="width: 100%; padding: 10px; background: orange; border: none; color: white; font-weight: bold; cursor: pointer;">Login</button>
        </form>
        <p style="text-align: center; margin-top: 15px; font-size: 14px;">Belum punya akun? <a href="/register">Daftar di sini</a></p>
    </div>

</body>
</html>