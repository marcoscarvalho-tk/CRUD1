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
        <h1><strong> Login</strong></h1>
        <form method="POST" class="w-50 mx-auto" action="login.php">
                <div class="form-group">               
                    <label for="email">Email</label>
                    <input type="email" name="email" class="form-control text-center">                
                </div>
                <div class="form-group">               
                    <label for="senha">Senha</label>
                    <input type="password" name="senha" class="form-control text-center">                
                </div>
                <button type="submit" class="btn btn-success"><i class="fas fa-sign-in-alt"></i> Entrar</button> 
                <a href="cadastrar.php" class="btn btn-primary"><i class="fas fa-user-plus"></i> Novo</a> 
        </form> 
        <?php 
        session_start();
        $alert = isset($_GET['info'])? $_GET['info']:'';

        if(!empty($alert) && empty($_SESSION['login'])): ?> 
            <?php if( $alert == 1): ?>
            <script type="text/javascript">Swal.fire({
                    icon: "error",
                    title: "Oops...",
                    text: "Email e/ou senha incorreta!"
                  })</script> 
                <hr/>
                  <p class="alert alert-warning w-50 mx-auto">
                        <i class="fas fa-exclamation-triangle">
                        </i> Esqueceu sua senha?<a href="passrecovery.php"> Clique aqui!</a> </p> 
            <?php endif; ?>
            <?php if( $alert == 2): ?>
                <script type="text/javascript">Swal.fire({
                    icon: "error",
                    title: "Oops...",
                    text: "Preencha todos os campos!"
                  })</script>
            <?php endif;?>
        <?php endif;?>
        
    <footer>
        <p>&copy;B7Web</p>
    </footer>
    </div>
   
    
</body>
</html>
