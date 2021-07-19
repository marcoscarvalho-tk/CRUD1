<?php
class Usuarios{

    private $id;
    private $nome;
    private $email;
    private $senha;
    private $status;

    private $pdo;

    public function __construct($i = null){
        try{
            $this->pdo = new PDO("mysql:dbname=test;host=localhost","root",""); 
        }catch(PDOExeption $e){
            echo "ERRO: ".$e->getMessage();
        }
        
        if(!empty($i)){
            $sql = "SELECT * FROM cadastro WHERE id = ?";
            $sql = $this->pdo->prepare($sql);
            $sql->execute(array($i));
            
            if($sql->rowCount() > 0){
                $data = $sql->fetch();
                $this->id = $data['id'];
                $this->nome = $data['nome'];
                $this->email= $data['email'];
                $this->senha = $data['senha'];
                $this->status = $data['status'];
            }
            
        }
               
    }
    
    public function getId(){
        return $this->id;
    }

    public function getNome(){
        return $this->nome;
    }

    public function setNome($n){
        $this->nome = $n;
        return true;
    } 

    public function getEmail(){
        return $this->email;
        
    }
    
    public function setEmail($e){
        $sql = "SELECT * FROM cadastro WHERE email = ?";
        $sql = $this->pdo->prepare($sql);
        $sql->execute(array($e));

        if($sql->rowCount() > 0){
           
            return true;
        }else{
            $this->email = $e;
            return false;
        }
        
    }

    public function getSenha(){
        return $this->senha;
    }

    public function setSenha($s){
        $this->senha = $s;
    }

    public function getStatus(){
        return $this->status;
    }

    public function setStatus($st){
        $this->status = $st;
    }

    public function getAll(){
        $sql = "SELECT * FROM cadastro";
        $sql = $this->pdo->query($sql);
        
        return $sql;
    }

    public function getDates(){
        $sql = "SELECT * FROM cadastro WHERE id = ?";
        $sql = $this->pdo->prepare($sql);
        $sql->execute(array($this->id));

        if($sql->rowCount() > 0){
            $data = $sql->fetch();
            return $data;
        }
    }

    public function login($e, $s){
        $sql = "SELECT * FROM cadastro WHERE 
        email = :email AND senha = :senha";
        $sql = $this->pdo->prepare($sql);
        $sql->bindValue(":email", $e);
        $sql->bindValue(":senha", $s);
        $sql->execute();

        if($sql->rowCount() > 0){
            $data = $sql->fetch();
            $_SESSION['login'] = $data['id'];
            return $data;
        }else{
            return false;
        }
    }

    public function passrecovery($e){        
            $sql = "SELECT * FROM cadastro WHERE 
            email = ?";
            $sql = $this->pdo->prepare($sql);
            $sql->execute(array($e));

            if($sql->rowCount() > 0){
                $row = $sql->fetch();

                return $row;
            }else{
                return false;
            }

    }

    public function log($i, $a){
        $sql = "INSERT INTO log SET id_usuario = $i,
         date_action = NOW(), action = '$a'";
        $sql = $this->pdo->prepare($sql);
        $sql->execute();
    }

    public function getLog(){
        $sql = "SELECT * FROM log";
        $sql = $this->pdo->query($sql);
        
        return $sql;
    }

    public function getLogDate($d){
       $sql = "SELECT * FROM log WHERE DATE(date_action) = '$d'";
       $sql = $this->pdo->query($sql);

        return $sql;
    }

    public function getLogId($i){
        $sql = "SELECT * FROM log WHERE id_usuario = $i";
        $sql = $this->pdo->query($sql);

        return $sql;
    }

    public function getLogIdDate($i,$d){
        $sql = "SELECT * FROM log WHERE DATE(date_action) = '$d'
                AND id_usuario = $i";
                $sql = $this->pdo->query($sql);
        
        return $sql;
    }
    
    public function salvar(){
        if(!empty($this->id)){
            $sql = "UPDATE cadastro SET 
            nome = ?,
            email = ?,
            senha = ?
            WHERE id = ?";
        $sql = $this->pdo->prepare($sql);
        $sql->execute(array(
            $this->nome,
            $this->email,
            $this->senha,
            $this->id));
        }else{
            $sql = "INSERT INTO cadastro SET
            nome = ?,
            email = ?,
            senha = ?";
        $sql = $this->pdo->prepare($sql);
        $sql->execute(array(
            $this->nome,
            $this->email,
            $this->senha));
        }

    }
    
    public function delete(){
        $sql = "DELETE FROM cadastro WHERE id = ?";
        $sql = $this->pdo->prepare($sql);
        $sql->execute(array($this->id));
    }
}
?>