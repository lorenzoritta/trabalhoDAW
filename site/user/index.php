<!doctype html>
<html lang="pt-BR">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Loja - Usuário</title>
  <link rel="stylesheet" href="/assets/css/style.css">
</head>
<body>
  <header class="header">
    <div class="logo"><img src="/assets/img/logo.svg" alt="logo"><div class="brand-title">Minha Loja</div></div>
    <nav style="margin-left:auto;display:flex;gap:8px;align-items:center">
      <a href="/admin/index.html" class="text-muted">Área administrativa</a>
      <a href="#" class="btn">Entrar</a>
    </nav>
  </header>

  <main class="container">
    <div id="alerts"></div>

    <div class="card">
      <div class="topbar">
        <div>
          <h2>Bem-vindo à loja</h2>
          <p class="text-muted">Explore nossos produtos.</p>
        </div>
        <div>
          <a class="btn secondary" href="#" data-action="simulate" data-target="#alerts">Adicionar ao carrinho (simular)</a>
        </div>
      </div>

      <div class="user-cards">
        <div class="card">Produto A<br><small class="text-muted">R$ 45,00</small><div style="margin-top:8px"><a href="#" class="btn" data-action="simulate" data-target="#alerts">Comprar</a></div></div>
        <div class="card">Produto B<br><small class="text-muted">R$ 89,00</small><div style="margin-top:8px"><a href="#" class="btn" data-action="simulate" data-target="#alerts">Comprar</a></div></div>
        <div class="card">Produto C<br><small class="text-muted">R$ 120,00</small><div style="margin-top:8px"><a href="#" class="btn" data-action="simulate" data-target="#alerts">Comprar</a></div></div>
      </div>
    </div>

  </main>

  <script src="/assets/js/main.js"></script>
</body>
</html>