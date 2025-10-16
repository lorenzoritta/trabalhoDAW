<?php
include 'configBD.php';
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: index.php'); exit;
}
$id = (int)($_POST['id_manga'] ?? 0);
$q = max(1, (int)($_POST['q'] ?? 1));
if ($id <=0) { header('Location: index.php'); exit; }
$stmt = $pdo->prepare('SELECT id_manga, nome, preco FROM mangas WHERE id_manga = ?');
$stmt->execute([$id]);
$m = $stmt->fetch();
if (!$m) { header('Location: index.php'); exit; }
if (!isset($_SESSION['cart'])) $_SESSION['cart'] = [];
// se já existe adiciona quantidade
if (isset($_SESSION['cart'][$id])) {
    $_SESSION['cart'][$id]['q'] += $q;
} else {
    $_SESSION['cart'][$id] = ['id'=>$m['id_manga'], 'nome'=>$m['nome'], 'preco'=>$m['preco'], 'q'=>$q];
}
header('Location: cart.php'); exit;
?>