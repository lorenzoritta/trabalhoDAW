<?php
session_start(); // inicia a sessão
session_unset(); // remove todas as variáveis da sessão
session_destroy(); // destrói a sessão

header("Location: index.php"); // redireciona para a página inicial
exit();
?>
