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
    <link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css" rel="stylesheet">
    <script type="text/javascript" src="../assets/js/jquery.min.js"></script>
    <script type="text/javascript" src="../assets/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="../assets/js/script.js"></script>
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
        <div class="row">
            <div class="col-4">               
                <form method="GET" class="form-inline ">
                    <p class="mx-auto"><strong>Pesquisa avançada:</strong></p>
                    <div class="form-group">
                      <input type="date" name="date" class="form-control form-control-sm m-1" >  
                    </div>                  
                      <input type="submit" class="btn-sm btn-secondary">        
                </form>
            </div>
            <div class="col-4">
            <p><strong>Registro de Atividades</strong></p>
            </div>
            <div class="col-4">

            </div>
        </div>
        
        <table class="table table-striped text-center">
        <tr>
            <th>ID log</th>
            <th>ID usuário</th>
            <th>Data/Hora</th>
            <th>Atividades</th>
            <th>Visualizar cadastro</th>
           
        </tr>
        <?php   

        require 'usuarios.class.php';
        require 'config.php';
        session_start();
        $user = new Usuarios();
        $res = $user->getLog();
        $sql = null;
        $total_reg = null;
        $total_paginas = null;
        $pgn = null;
        $pg = null;

        $date = isset($_GET['date'])? $_GET['date']:'';
        //$comut = " WHERE id_usuario = ".$id." ORDER BY date_action ";
        $comut = " WHERE DATE(date_action) ='".$date."' ORDER BY id ";
            if(isset($date)){
                $sql = "SELECT COUNT(*) as c FROM log WHERE DATE(date_action) = '$date'";
                $sql = $pdo->query($sql);
                $sql = $sql->fetch();
                $total_reg = $sql['c'];
                $total_paginas = ceil($total_reg / 5);

                $res = $user->getLogDate($date);
                $sql = $res;

            }
                   

        $pg = 1;
        if(isset($_GET['p']) && !empty($_GET['p'])){
            $pg = addslashes( $_GET['p']);
        }

        $p = ($pg - 1) * 5;
        $pgn = $pg;

        $sql = "SELECT * FROM log $comut DESC LIMIT $p, 5";
        $sql = $pdo->query($sql);


        if($sql->rowCount() > 0) : ?>
            <?php foreach($sql->fetchAll() as $row): ?>
            <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo $row['id_usuario']; ?></td>
                <td><?php echo $row['date_action']; ?></td>
                <td><?php echo $row['action']; ?></td>
                <td><a href="cadastro.php?id=<?php echo $row['id_usuario']; ?>" class="btn-sm btn-dark"><i class="fas fa-eye"></i> </a> </td>
            </tr>
            <?php endforeach; ?>
        <?php endif; ?>
        
        </table> 

        <ul class="pagination justify-content-center">
            <?php if($pg > 1):?>  
            <li class="page-item">  
            <a class="page-link" href="logfilter.php?p=<?php echo ($pg -1); ?>&date=<?php echo $date; ?>" aria-label="Anterior">
                <span aria-hidden="true">&laquo;</span>
                <span class="sr-only">Anterior</span>
            </a>
            </li>
            <?php endif; ?> 

                <?php for($a=0;$a<6;$a++,$pgn++) :?>
                    <?php if($pgn <= $total_paginas): ?>
                    <li class="page-item <?php echo $pgn == $pg? "active":''; ?> ">
                    <a class="page-link" href="logfilter.php?p=<?php echo $pgn; ?>&date=<?php echo $date; ?>"><?php echo $pgn; ?></a></li>
                    <?php endif; ?>                
                <?php endfor; ?>

             <?php if($pg < $total_paginas): ?>
            <li class="page-item">
            <a class="page-link" href="logfilter.php?p=<?php echo ($pg + 1); ?>&date=<?php echo $date; ?>" aria-label="Próximo">
                <span aria-hidden="true">&raquo;</span>
                <span class="sr-only">Próximo</span>
            </a>
            </li>
            <?php endif; ?>     
        </ul>
        <?php 
        echo $total_reg; echo $date; echo $comut?>
         
            <a href="cadastro_geral.php?id=<?php echo $_SESSION['login'] ?>" class="btn btn-primary mr-1">Voltar</a>
    </section>        
    <footer>
        <p>&copy;B7Web</p>
    </footer>
    </div>
   
    
</body>
</html>
