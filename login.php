<?php
require 'usuarios.class.php';                
session_start();
$email = isset($_POST['email'])? $_POST['email']: null;
$senha = isset($_POST['senha'])? md5($_POST['senha']): null;
$id = null;

if(!empty($email) && !empty($senha)){ 
    $senha = addslashes($senha);
    $email = addslashes($email);
    $user = new Usuarios();
    $res = $user->login($email, $senha);
    $sec = $_SESSION['login'];
    
    if(!empty($res)){
        $id = $res['id'];
        $msg = "Usuário realizou o login";
        $user->log($sec, $msg);
        header("Location: cadastro.php?id=$id");
    }else{
        header("Location: _index.php?info=1");
    }
}else{
    header("Location: _index.php?info=2");
}  

?>