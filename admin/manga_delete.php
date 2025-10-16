<?php
include '../configBD.php';
if (empty($_SESSION['admin_logged'])) { header('Location: login.php'); exit; }
$id = (int)($_GET['id'] ?? 0);
if ($id>0) {
    $pdo->prepare('DELETE FROM mangas WHERE id_manga = ?')->execute([$id]);
}
header('Location: index.php'); exit;
?>