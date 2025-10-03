<?php

Class usuario{
    public $id;
    public $nome;
    public $email;
    public $senha;
    public $telefone;

    private $bd;

    public function __construct($bd){
        $this->bd = $bd;
    }

    public function lerTodos(){
        $sql = "SELECT * FROM usuario";
        $resultado = $this->bd->query($sql);
        $resultado->execute();

        return $resultado->fetchAll(PDO::FETCH_OBJ);
    }

    public function lerUsuario($nome){
        $nome = "%" . $nome . "%";
        $sql = "SELECT * FROM usuario WHERE nome LIKE :nome";
    }

    public function pesquisarUsuario($id){
        $sql = "SELECT * FROM usuario WHERE id LIKE :id";
        $resultado = $this->bd->prepare($sql);
        $resultado->bindParam(':id', $id);
        $resultado->execute();

        return $resultado->fetch(PDO::FETCH_OBJ);
    }

    public function Cadastrar(){
        $senha_hash = password_hash($this->senha, PASSWORD_DEFAULT);
        $sql = "INSERT INTO usuario(nome, email, senha, telefone) VALUES (:nome, :email, :senha, :telefone)";
        $stmt = $this->bd->prepare($sql);
        $stmt->bindParam(':nome', $this->nome, PDO::PARAM_STR);        
        $stmt->bindParam(':email', $this->email, PDO::PARAM_STR);
        $stmt->bindParam(':senha',$senha_hash, PDO::PARAM_STR);
        $stmt->bindParam(':telefone', $this->telefone, PDO::PARAM_STR);

        if($stmt->execute()){
            return true;
        } else {
            return false;
        }
    }

    public function atualizar(){
        $senha_hash = password_hash($this->senha, PASSWORD_DEFAULT);
        $sql = "UPDATE usuario SET nome = :nome, email = :email, senha = :senha, telefone = :telefone WHERE id = :id";
        $stmt = $this->bd->prepare($sql);
        $stmt->bindParam(':nome', $this->nome, PDO::PARAM_STR);        
        $stmt->bindParam(':email', $this->email, PDO::PARAM_STR);
        $stmt->bindParam(':senha', $senha_hash, PDO::PARAM_STR);
        $stmt->bindParam(':telefone', $this->telefone, PDO::PARAM_STR);
        $stmt->bindParam(':id', $this->id, PDO::PARAM_INT);

        if($stmt->execute()){
            return true;
        } else {
            return false;
        }
    }

    public function excluir(){
        $sql = "DELETE FROM usuario WHERE id = :id";
        $stmt = $this->bd->prepare($sql);
        $stmt->bindParam(':id', $this->id, PDO::PARAM_INT);

        if($stmt->execute()){
            return true;
        } else {
            return false;
        }
    }

    public function login(){
        $sql = "SELECT * FROM usuario WHERE email = :email";
        $stmt = $this->bd->prepare($sql);
        $stmt->bindParam(':email', $this->email, PDO::PARAM_STR);
        $stmt->execute();
        $resultado = $stmt->fetch(PDO::FETCH_OBJ);

        if($resultado){
            if(password_verify($this->senha, $resultado->senha)){
                session_start();
                $_SESSION['usuario'] = $resultado;
                return true;
                exit();
            } else {
                session_start();
                $_SESSION['erro'] = "Email ou senha incorretos.";
                header("Location: ../pages/login.php");
                exit();
            }
        } else {
            session_start();
            $_SESSION['erros'] = "Usuario nao cadastrado.";
            header("Location: ../pages/login.php");
            exit();
        }
    }
    
}

?>