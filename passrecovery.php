<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Curso PHP</title>    
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css">
    <link rel="stylesheet" href="style.css">
    <script type="text/javascript" src="../assets/js/jquery.min.js"></script>   
    <script type="text/javascript" src="../assets/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="../assets/js/script.js"></script>
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
    require 'usuarios.class.php';

    $user = new Usuarios();
    $id_user = null;

    if(!empty($_POST['email'])){
        $email = isset($_POST['email'])? $_POST['email']:'';
        $date = $user->passrecovery($email);
        $id_user = $date['id'];
        $token = md5(time().rand(0, 9999).rand(0, 9999));
        $time = date('Y-m-d H:i', strtotime('+2 months'));

        $sql = "INSERT INTO token VALUES (NULL, $id_user, '$token', 0, '$time')";
        $sql = $pdo->prepare($sql);
        $sql->execute();
        echo "Link para recuperação de senha abaixo.</br>";
        echo '<a href="passredefine.php?token='.$token.'">Click aqui!</a>';
        echo "<hr/>";
        //###################### OBSERVAÇÃO ############################
        echo "<font size=20; color=red>Este método permite fazer uma recuperação de senha através de email
        usando um servidor externo. Para isso basta inserir a função mail() com os 
        parametros, incluindo o link de redirecionamento.</font red>";

        exit;

    }
    ?>
        <p><strong>CRUD</strong></p>
        <h1><strong>Nova Senha</strong></h1>
        <form method="POST" class="w-50 mx-auto">                
                <div class="form-group">               
                    <label for="email">digite seu Email</label>
                    <input type="email" name="email" class="form-control text-center">                
                </div>
                <input type="submit" value="Enviar" class="btn btn-success"> 
                <a href="_index.php" class="btn btn-primary">Voltar</a> 
        </form> 
        
    <footer>
        <p>&copy;B7Web</p>
    </footer>
    </div>
   
    
</body>
</html>
