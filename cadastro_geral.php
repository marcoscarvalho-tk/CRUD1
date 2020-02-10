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
    <link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css" rel="stylesheet">
    <script type="text/javascript" src="assets/js/jquery.min.js"></script>   
    <script type="text/javascript" src="webapps/js/1.7.1/jquery.min.js"></script>
    <script type="text/javascript" src="assets/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="assets/js/script.js"></script>
    <script type="text/javascript" src="script.js"></script>
    <script type="text/javascript" src="sweetalert2.all.js"></script>
    <script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>

</head>
<body>
    <div class ="container">
     <header>
        <h1>Curso PHP</h1> 

    </header>
    <section>
        <p><strong>CRUD</strong></p>
        <p>Cadastro Geral</p>
        <table class="table table-striped text-center">
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Email</th>
            <th>Ações</th>
            <th>ADM</th>
        </tr>
        <?php
        

        require 'usuarios.class.php';
        session_start();
        
        $id = isset($_GET['id'])? $_GET['id']:'';
        $user = new Usuarios($id);
        $status = $user->getStatus();

        if(!empty($id) && !empty($_SESSION['login']) && $status == 1){           
            
            $cad = $user->getAll();
            $act = "Usuário acessou o cadastro geral";
            $user->log($id, $act);
            if($cad->rowCount() > 0):?>            
            
            <?php foreach($cad->fetchAll() as $row): ?>
            
                <tr class="<?php echo $row['status'] == 1 ?'bg-warning':''; ?>">
                    <td> <?php echo $row['id'];?></td>
                    <td><?php echo $row['nome'];?></td>
                    <td><?php echo $row['email'];?></td>
                    <td>
                    <div>
                        <a href="editar.php?id=<?php echo $row['id']; ?>"><button class="btn-sm btn-success "><i class="fas fa-pen"></i> Editar</button></a> 
                        <button type="button" onclick="excluir(<?php echo $row['id']; ?>)" class="btn-sm btn-danger"><i class="fas fa-trash"></i> Excluir</button>
                    </div>
                    </td>

                    <td>
                    <div class="onoffswitch">
                        <input type="hidden" id="usrid" value="<?php echo $row['id']; ?>">
                        <input type="hidden" id="check" value="<?php echo $row['status'] ?>">
                        <input type="checkbox" data-size="sm" value="<?php echo $row['status']; ?>" 
                            <?php echo $row['status'] == '1'? 'checked' : '' ;?> 
                            data-onstyle="danger" data-offstyle="dark" data-toggle="toggle"/>                    
                    </div>                    
                    </td>
                </tr>
                
            <?php endforeach; ?>
            <?php endif; ?>
         </table>           
        
        <?php    
        }else{
            header("Location: _index.php");
        }
        
        ?>
            <a href="cadastrar.php" class="btn btn-secondary mr-1"><i class="fas fa-user-plus"></i> Cadastrar</a>
            <a href="loglist.php" class="btn btn-dark mr-1"><i class="fas fa-book"></i> Reg. de ações</a>
            <a href="cadastro.php?id=<?php echo $id; ?>" class="btn btn-primary mr-1"><i class="fas fa-reply"></i> Voltar</a>
            <a href="exit.php"  class="btn btn-warning mr-1"><i class="fas fa-sign-out-alt"></i> Sair</a>
    </section>        
    <footer>
        <p>&copy;B7Web</p>
    </footer>
    </div>
   
    
</body>
</html>
