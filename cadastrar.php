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
            <p><strong>CRUD</strong></p>
        <p>Novo Cadastro</p>
            <form  method="POST" class="w-50 mx-auto">
                <div class="form-group">
                    <label for="name">Nome</label>
                    <input type="text" name="nome" class="form-control text-center" required>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" class="form-control text-center" required>
                </div>
                <div class="form-group">
                    <label for="senha">Senha</label>
                    <input type="password" name="senha" class="form-control text-center" required>
                </div>
                <button type="submit" class="btn btn-success"><i class="fas fa-user-check"></i> Cadastrar</button>
                <a href="javascript:history.go(-1)" class="btn btn-primary"><i class="fas fa-reply"></i> Voltar</a>
            </form>
        <?php
        include_once('usuarios.class.php');
        session_start();
        $login = isset($_SESSION['login'])? $_SESSION['login']:'';
        $admin = new Usuarios($login);
        $status = $admin->getStatus();

        $nome = isset($_POST['nome'])? addslashes($_POST['nome']) : '';
        $email = isset($_POST['email'])? addslashes($_POST['email']) : '';
        $senha = isset($_POST['senha'])? addslashes(md5($_POST['senha'])) : '';

        if(!empty($_POST['nome']) && !empty($_POST['email']) && !empty($_POST['senha'])){            
            $id = null;
            $user = new Usuarios($id);
            $user->setNome($nome);
            $user->setSenha($senha);
            
            if($user->setEmail($email) == true){
                echo '<script type="text/javascript">Swal.fire({
                    icon: "error",
                    title: "Oops...",
                    text: "Este Email já possui cadastro!"
                  })</script>';          
                
                }else if(!empty($_SESSION['login']) && $status == 1){
                    
                    $user->salvar(); 
                echo '<script type="text/javascript">                
                       window.location.href = "javascript:history.go(-2)"</script>'; 
                
                    }else{
                        $user->salvar();
                        $res = $user->login($email, $senha);
                        $id = $res['id']; 
                        echo '<script type="text/javascript">
                        Swal.fire({ 
                            icon: "success",
                            title: "PARABÉNS!",
                            text: "Cadastro efetuado com sucesso!",
                            type: "success"}).then(okay => {
                            if (okay) {
                            window.location.href = "cadastro.php?id='.$id.'";
                            }
                        });</script>'; 
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
