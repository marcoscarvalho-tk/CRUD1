<?php
require 'usuarios.class.php';
session_start();

$id = isset($_GET['id'])? $_GET['id']:'';
$user = new Usuarios($_SESSION['login']);
$sec = $_SESSION['login'];

if(!empty($_GET['id']) && !empty($_GET['id'])){
    $dados = $user->getDates();
    $status = $dados['status'];
    
    if($_GET['id'] == $_SESSION['login']){
       $user = new Usuarios($id);
       $user->delete();
       header("Location: exit.php"); 
       
    }else if(!empty($_SESSION['login']) && $status == 1){
       $user = new Usuarios($id);
       $user->delete();
       echo '<script type="text/javascript">
                window.location.href = "javascript:history.go(-1)"</script>';
    }

    $msg = "Usuário ".$sec." deletou o cadastro id: ".$id."";
            $user->log($id, $msg);
}
?>