<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Mangamania</title>

    <link rel="stylesheet" href="assets/style.css">
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>

    <style>
        /* Ajuste visual do card de login */
        .login-card {
            max-width: 420px;
            margin: auto;
            margin-top: 40px;
            padding: 25px;
            background: #fff;
            border-radius: 14px;
            box-shadow: 0 6px 18px rgba(0,0,0,0.1);
        }

        .form-group {
            margin-bottom: 15px;
            display: flex;
            flex-direction: column;
        }

        .form-group label {
            font-weight: 600;
            margin-bottom: 6px;
        }

        input[type=email],
        input[type=password] {
            padding: 10px;
            border-radius: 8px;
            border: 1px solid #ccc;
            width: 100%;
        }

        .btn {
            width: 100%;
            padding: 12px;
            background: #333;
            color: #fff;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            font-size: 16px;
        }

        .btn:hover {
            background: #555;
        }

        .rec {
            margin-top: 10px;
            text-align: center;
        }

        .rec a {
            text-decoration: none;
            color: #0066cc;
        }

        .rec a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>

<header class="brand">
    <img src="assets/logo.png" alt="logo" class="logo">
    <h1>Mangamania</h1>

    <nav>
        <a href="index.php">Home</a>
        <a href="site/listar.php">Mangás</a>
        <a href="login.php" class="active">Login</a>
    </nav>
</header>

<main class="container">
    <h2 class="text-center">Entrar na sua conta</h2>

    <form class="login-card" action="login_ok.php" method="post">

        <div class="form-group">
            <label>Email:</label>
            <input type="email" name="email" required>
        </div>

        <div class="form-group">
            <label>Senha:</label>
            <input type="password" name="senha" required>
        </div>

        <div class="g-recaptcha" data-sitekey="6Ld-kvsrAAAAAPmQGHBh-Vk6FIY90pJAmQfuS76R"></div>

        <button class="btn" type="submit">Entrar</button>

        <p class="rec"><a href="recuperar.php">Esqueci minha senha</a></p>
    </form>
</main>

<footer class="brand">
    <p>Mangamania &copy; <?= date('Y') ?></p>
</footer>

</body>
</html>
