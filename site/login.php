<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=], initial-scale=1.0">
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <title>Document</title>
</head>

<body>

    <form action="login_ok.php" method="post">
        email: <input type="email" name="email">
        <br>
        senha: <input type="password" name="senha">
        <br>
        <button type="submit">Enviar</button>
    </form>
    <p><a href="recuperar.php">Esqueci minha senha</a></p>
    <div class="mb-3">
        <div class="g-recaptcha" data-sitekey="6Ld-kvsrAAAAAPmQGHBh-Vk6FIY90pJAmQfuS76R"></div>
    </div>
</body>

</html>