<?php
session_start();
include_once "../class/vendasDAO.class.php";

$vendasDAO = new VendasDAO();
$vendas = $vendasDAO->listar();

$msg = isset($_GET['msg']) ? $_GET['msg'] : '';
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Painel de Vendas</title>
    <style>
        table { border-collapse: collapse; width: 100%; }
        th, td { border: 1px solid #ccc; padding: 8px; text-align: center; }
        form { display: inline-block; }
    </style>
</head>
<body>

<h1>Painel de Vendas</h1>

<?php if ($msg): ?>
    <p style="color: green;"><strong><?= htmlspecialchars($msg) ?></strong></p>
<?php endif; ?>

<?php if (count($vendas) > 0): ?>
    <table>
        <thead>
            <tr>
                <th>ID Venda</th>
                <th>ID Cliente</th>
                <th>Data</th>
                <th>Forma de Pagamento</th>
                <th>Endereço</th>
                <th>Status Atual</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($vendas as $venda): ?>
                <tr>
                    <td><?= $venda['id_vendas'] ?></td>
                    <td><?= $venda['id_cliente'] ?></td>
                    <td><?= $venda['data_venda'] ?></td>
                    <td><?= $venda['forma_pagamento'] ?></td>
                    <td><?= $venda['entrega'] ?></td>
                    <td><strong><?= $venda['status_venda'] ?></strong></td>
                    <td>
                        <form action="atualizar_status.php" method="POST">
                            <input type="hidden" name="id_vendas" value="<?= $venda['id_vendas'] ?>">
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php else: ?>
    <p>Nenhuma venda encontrada.</p>
<?php endif; ?>

</body>
</html>
