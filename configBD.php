<?php
// configBD.php - conexão PDO com o banco mangamania
$host = '127.0.0.1';
$db   = 'mangamania';
$user = 'root';
$pass = '';
$charset = 'utf8mb4';
$opt = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];
try {
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=$charset", $user, $pass, $opt);
} catch (PDOException $e) {
    echo 'Erro ao conectar ao banco: ' . $e->getMessage();
    exit;
}
session_start();
?>