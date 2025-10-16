<?php
if(session_status() !== PHP_SESSION_ACTIVE) session_start();
?>
<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>Loja - Usuário</title>
  <link rel="stylesheet" href="/assets/site.css">
</head>
<body>
  <header style="background:#1e88e5;color:#fff;padding:12px;">
    <div style="max-width:1100px;margin:0 auto;display:flex;justify-content:space-between;align-items:center">
      <div>
        <img src="/assets/logo.png" alt="Logo" style="height:40px;vertical-align:middle">
        <span style="font-weight:700;margin-left:8px">Manga Mania</span>
      </div>
      <nav>
        <a href="/site/index.php" style="color:#fff;margin-right:12px">Home</a>
        <a href="/site/listar.php" style="color:#fff;margin-right:12px">Produtos</a>
        <a href="/site/carrinho.php" style="color:#fff;margin-right:12px">Carrinho</a>
        <a href="/vendas/admin_vendas.php" style="color:#fff">Área ADM</a>
        <a href="/logout.php" style="color:#fff;margin-left:18px">Sair</a>
      </nav>
    </div>
  </header>
  <main style="max-width:1100px;margin:18px auto">
<?php include __DIR__ . '/flash.php'; ?>
