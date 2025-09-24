<?php
session_start();
include_once "../class/vendasDAO.class.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_vendas = isset($_POST['id_vendas']) ? intval($_POST['id_vendas']) : null;
    $status_venda = isset($_POST['status_venda']) ? trim($_POST['status_venda']) : null;

    // Debug temporário (remova depois de testar)
    /*
    echo "<pre>";
    print_r($_POST);
    echo "</pre>";
    */

    if ($id_vendas && $status_venda) {
        $objVendasDAO = new VendasDAO();
        $sucesso = $objVendasDAO->atualizarStatus($id_vendas, $status_venda);

        if ($sucesso) {
            header("Location: painel_de_vendas.php?msg=Status atualizado com sucesso&id=$id_vendas");
            exit;
        } else {
            echo "<p>❌ Erro ao atualizar status da venda.</p>";
        }
    } else {
        echo "<p>⚠️ Dados incompletos. Verifique o ID e o status.</p>";
    }
} else {
    echo "<p>🚫 Método inválido. Acesse este recurso via POST.</p>";
}
?>
