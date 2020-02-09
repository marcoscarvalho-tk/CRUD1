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
    <script type="text/javascript" src="script.js"></script>
    <script type="text/javascript" src="sweetalert2.all.js"></script>
</head>
<body>
    <div class ="container">
     <header>
        <h1>Curso PHP</h1> 

    </header>
    <section>
        <p><strong>CRUD</strong></p>
        <p>Cadastro</p>
        <?php
        require 'usuarios.class.php';
        session_start();

        $sec = $_SESSION['login'];
        $id = isset($_GET['id'])? $_GET['id']:'';
        if(!empty($id) && !empty($sec)){
            
            $user = new Usuarios($id);
            $cad = $user->getDates();
            $status = $cad['status'];
            $msg = "Usuário acessou o cadastro";
            $user->log($id, $msg);
            ?>
            <table class="table table-striped text-left w-50 mx-auto">
                <tr>
                    <th class="col"><?php echo "ID número:";?></th>
                    <td><?php echo "$cad[id]";?></td>
                </tr>
                <tr>
                    <th class="col"><?php echo "Nome:";?></th>
                    <td><?php echo "$cad[nome]";?></td>
                </tr>
                <tr>
                    <th class="col"><?php echo "Email:";?></th>
                    <td><?php echo "$cad[email]";?></td>
                </tr>
                <tr>
                    <th class="col"><?php echo "Status:";?></th>
                    <td><?php echo $status==1?"<font color=green>Administrador</font>":"Geral";?></td>
                </tr>

            </table>           
        <div id="sum"></div>
        <?php    
        }else{
            header("Location: _index.php");
        }        
        ?>
            <a href="editar.php?id=<?php echo $id; ?>"  class="btn btn-success mr-1"><i class="fas fa-pen"></i> Editar</a>
            <a href="exit.php"  class="btn btn-warning mr-1"><i class="fas fa-sign-out-alt"></i> Sair</a>
            <?php if(($status == 1) && ($id == $sec)): ?>
            <a href="cadastro_geral.php?id=<?php echo $id; ?>" class="btn btn-dark"><i class="fas fa-key"></i> Gerenciar</a>
                <?php else: ?>                    
            <button type="button" class="btn btn-danger" onclick="excluir(<?php echo $id; ?>)" ><i class="fas fa-trash"></i> Excluir</button>
            <?php endif; ?>
    </section>
    <footer>
        <p>&copy;B7Web</p>
    </footer>
    </div>
   
    
</body>
</html>
