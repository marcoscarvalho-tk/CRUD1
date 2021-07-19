<?php
include_once('usuarios.class.php');
session_start();

$id = isset($_POST['id'])? $_POST['id']:'';
$status = isset($_POST['status'])? $_POST['status']:'';
$admin = new Usuarios($id);
$admin->setStatus($status);

?>