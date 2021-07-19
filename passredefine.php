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
    require 'config.php';

    if(!empty($_GET['token'])){
            $token = isset($_GET['token'])? $_GET['token']:'';
            $id_user = null;

            $sql = "SELECT * FROM token WHERE hash = '$token'";
            $sql = $pdo->query($sql);
            if($sql->rowCount() > 0){
                $row = $sql->fetch();
                $id_token = $row['id'];
                $id_user = $row['id_usuario'];
            }
        
        if(!empty($_POST['senha'])){
            $senha = isset($_POST['senha'])? $_POST['senha']:'';

                $sql = "SELECT * FROM token WHERE id_usuario = :id_user 
                AND hash = :hash AND used = 0 AND expired_in > NOW()";
                $sql = $pdo->prepare($sql);
                $sql->bindValue(":id_user", $id_user);
                $sql->bindValue(":hash", $token);
                $sql->execute();

                if($sql->rowCount() > 0){
                $row = $sql->fetch();
                    $id_user = $row['id_usuario'];
                    $id_token = $row['id'];

                    $sql = "UPDATE cadastro SET senha = :senha WHERE id = :id_user";
                    $sql = $pdo->prepare($sql);
                    $sql->bindValue(":senha", md5($senha));
                    $sql->bindValue(":id_user", $id_user);
                    $sql->execute();

                    $sql = "UPDATE token SET used = 1 WHERE id = :id_token";
                    $sql = $pdo->prepare($sql);
                    $sql->bindValue(":id_token", $id_token);
                    $sql->execute();

                    echo '<script type="text/javascript">
                    Swal.fire({ 
                        icon: "success",
                        title: "TUDO CERTO!",
                        text: "Senha redefinida com sucesso!",
                        type: "success"}).then(okay => {
                        if (okay) {
                        window.location.href = "index.php";
                        }
                    });
                        </script>';
                }else{
                    echo '<script type="text/javascript">
                    Swal.fire({ 
                        icon: "error",
                        title: "Oops..!",
                        text: "Erro na recuperação da senha!",
                        type: "error"}).then(okay => {
                        if (okay) {
                        window.location.href = "index.php";
                        }
                    });
                        </script>';
                }
        }
        ?>
         <p><strong>CRUD</strong></p>
        <h1><strong>Nova Senha</strong></h1>
        <form method="POST" class="w-50 mx-auto">                
                <div class="form-group">               
                    <label for="senha">Digite a nova senha</label>
                    <input type="password" name="senha" class="form-control text-center">                
                </div>
                <input type="submit" value="Enviar" class="btn btn-success"> 
                <a href="index.php" class="btn btn-primary">Voltar</a> 
        </form> 
        <?php           
    }       
   ?>
        
    <footer>
        <p>&copy;B7Web</p>
    </footer>
    </div>
   
    
</body>
</html>


