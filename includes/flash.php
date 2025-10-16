<?php
if(!isset($_SESSION)) session_start();
if(!empty($_SESSION['flash'])) {
    foreach($_SESSION['flash'] as $f) {
        $type = isset($f['type']) ? $f['type'] : 'info';
        echo '<div class="flash '.htmlspecialchars($type).'">'.htmlspecialchars($f['message']).'</div>';
    }
    unset($_SESSION['flash']);
}
function flash_set($msg, $type='success') {
    if(!isset($_SESSION)) session_start();
    if(!isset($_SESSION['flash'])) $_SESSION['flash'] = [];
    $_SESSION['flash'][] = ['message'=>$msg,'type'=>$type];
}
?>