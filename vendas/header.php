<?php
// vendas/header.php
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Painel Admin</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <style>
        .sidebar {
            width: 200px;
            height: 100vh;
            background: #2c3e50;
            color: #fff;
            float: left;
            padding: 20px;
        }
        .sidebar a {
            display: block;
            color: #fff;
            margin: 10px 0;
        }
        .content {
            margin-left: 220px;
            padding: 20px;
        }
    </style>
</head>
<body>
<div class="sidebar">
    <img src="../img/dbz.webp" alt="Logo" style="width:100%; border-radius:8px;">
    <h3>Painel Admin</h3>
    <a href="painel_de_vendas.php">Dashboard</a>
    <a href="admin_vendas.php">Gerenciar Vendas</a>
    <a href="listar.php">Produtos</a>
    <a href="../site/index.php">Ir para o Site</a>
</div>
<div class="content">