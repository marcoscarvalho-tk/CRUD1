<?php
session_start();

$sec = $_SESSION['login'];
$conexao = mysqli_connect('localhost','root','');
$banco = mysqli_select_db($conexao, 'test'); 
if(isset($_POST['value']))
{
    $value=$_POST['value'];
    $id=$_POST['id'];
    $msg = "ADM id: ".$sec." alterou o status do id: ".$id."";
    
    mysqli_query($conexao,"UPDATE cadastro SET status =$value WHERE id=$id");
    mysqli_query($conexao,"INSERT INTO log SET id_usuario = $id, date_action = NOW(), action = '$msg'");
}
?>