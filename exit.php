<?php
session_start();
include 'usuarios.class.php';
$user = new Usuarios();

$sec = $_SESSION['login'];
$msg = "Usuário realizou o logoff";
$user->log($sec, $msg);
unset($_SESSION['login']);
header("Location: index.php");
?>