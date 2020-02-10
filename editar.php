<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Curso PHP</title>    
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css">
    <link rel="stylesheet" href="style.css">
    <script type="text/javascript" src="assets/js/jquery.min.js"></script>   
    <script type="text/javascript" src="assets/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="assets/js/script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
</head>
<body>
    <div class ="container">
     <header>
        <h1>Curso PHP</h1>

    </header>
    <section>
    <?php
    require 'usuarios.class.php';
    session_start();
        
    $id = isset($_GET['id'])? $_GET['id']:'';
    $sec = isset($_SESSION['login'])? $_SESSION['login']:'';
    
    if(!empty($id) && !empty($_SESSION['login'])){
    $user = new Usuarios($id);
    $getDados = $user->getDates();
    $n = "$getDados[nome]";
    $e = "$getDados[email]";
    $s = "$getDados[senha]";
    $st= "$getDados[status]";        
    }else{
        header("Location: _index.php");
    }

    ?>
        <p><strong>CRUD</strong></p>
        <p>Editar Cadastro</p>
            <form  method="POST" class="w-50 mx-auto">
                <div class="form-group">
                    <label for="name">Nome</label>
                    <input type="text" name="nome" class="form-control text-center" placeholder="<?php echo $n;?>">
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" class="form-control text-center"  placeholder="<?php echo $e;?>">
                </div>
                <div class="form-group">
                    <label for="senha">Senha</label>
                    <input type="password" name="senha" class="form-control text-center" placeholder="*********">
                </div>
                <button type="submit" class="btn btn-success"><i class="fas fa-edit"></i> Editar</button>
                <a href="javascript:history.go(-1)"  class="btn btn-primary"><i class="fas fa-reply"></i> Voltar</a>
            </form>
        <?php
        include_once('usuarios.class.php') ;
    

        if(!empty($_POST['nome']) || !empty($_POST['email']) || !empty($_POST['senha'])){
            
            $nome = !empty($_POST['nome'])? addslashes($_POST['nome']) : $n;
            $email = !empty($_POST['email'])? addslashes($_POST['email']) : $e;
            $senha = !empty($_POST['senha'])? addslashes(md5($_POST['senha'])) : $s;
            
            $user->setNome($nome);
            $user->setSenha($senha);
            
            if($user->setEmail($email) == false){
            $user->salvar();
            $msg = "Usuário id: ".$sec." editou o cadastro id: ".$id."";
            $user->log($id, $msg);
            echo '<script type="text/javascript">
                Swal.fire({ 
                    icon: "success",
                    title: "TUDO CERTO!",
                    text: "Cadastro atualizado com sucesso!",
                    type: "success"}).then(okay => {
                      if (okay) {
                       window.location.href = "cadastro.php?id='.$id.'";
                     }
                   });</script>';            
            
            } else if(($user->getEmail() == $email) && $id == $sec){
                    $user->salvar();
                    $msg = "Usuário id: ".$sec." editou o cadastro id: ".$id."";
                    $user->log($id, $msg);
                    echo '<script type="text/javascript">
                Swal.fire({ 
                    icon: "success",
                    title: "TUDO CERTO!",
                    text: "Cadastro atualizado com sucesso!",
                    type: "success"}).then(okay => {
                    if (okay) {
                    window.location.href = "cadastro.php?id='.$id.'";
                    } 
                });</script>';
            } else if(($user->getEmail() == $email) && $status = 1){
                    $user->salvar();
                    $msg = "Usuário id: ".$sec." editou o cadastro id: ".$id."";
                    $user->log($id, $msg);
                    echo '<script type="text/javascript">
                Swal.fire({ 
                    icon: "success",
                    title: "TUDO CERTO!",
                    text: "Cadastro atualizado com sucesso!",
                    type: "success"}).then(okay => {
                    if (okay) {
                    window.location.href = "cadastro_geral.php?id='.$sec.'";
                    }
                });</script>';
            } else{
                echo '<script type="text/javascript">Swal.fire({
                    icon: "error",
                    title: "Oops...",
                    text: "Este Email já possui cadastro!"
                })</script>';
            }
            
        }    
        
       
        ?>
    </section>
    <footer>
        <p>&copy;B7Web</p>
    </footer>
    </div>
   
    
</body>
</html>
