<?php

class usuario
{
    public $id_usuario;
    public $nome;
    public $email;
    public $senha;

    private $bd;

    public function __construct($bd)
    {
        $this->bd = $bd;
    }

    // Ler todos os usuários
    public function lerTodos()
    {
        $sql = "SELECT * FROM usuario";
        $stmt = $this->bd->query($sql);
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    // Ler usuários pelo nome (pesquisa parcial)
    public function lerUsuario($nome)
    {
        $nome = "%" . $nome . "%";
        $sql = "SELECT * FROM usuario WHERE nome LIKE :nome";
        $stmt = $this->bd->prepare($sql);
        $stmt->bindParam(':nome', $nome, PDO::PARAM_STR);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    // Pesquisar usuário por ID
    public function pesquisarUsuario($id_usuario)
    {
        $sql = "SELECT * FROM usuario WHERE id_usuario = :id_usuario LIMIT 1";
        $stmt = $this->bd->prepare($sql);
        $stmt->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    // Cadastrar novo usuário
    public function cadastrar()
    {
        $senha_hash = password_hash($this->senha, PASSWORD_DEFAULT);
        $sql = "INSERT INTO usuario(nome, email, senha) VALUES (:nome, :email, :senha)";
        $stmt = $this->bd->prepare($sql);
        $stmt->bindParam(':nome', $this->nome, PDO::PARAM_STR);
        $stmt->bindParam(':email', $this->email, PDO::PARAM_STR);
        $stmt->bindParam(':senha', $senha_hash, PDO::PARAM_STR);

        return $stmt->execute();
    }

    // Atualizar usuário
    public function atualizar()
    {
        $senha_hash = password_hash($this->senha, PASSWORD_DEFAULT);
        $sql = "UPDATE usuario SET nome = :nome, email = :email, senha = :senha WHERE id_usuario = :id_usuario";
        $stmt = $this->bd->prepare($sql);
        $stmt->bindParam(':nome', $this->nome, PDO::PARAM_STR);
        $stmt->bindParam(':email', $this->email, PDO::PARAM_STR);
        $stmt->bindParam(':senha', $senha_hash, PDO::PARAM_STR);
        $stmt->bindParam(':id_usuario', $this->id_usuario, PDO::PARAM_INT);

        return $stmt->execute();
    }

    // Excluir usuário
    public function excluir()
    {
        $sql = "DELETE FROM usuario WHERE id_usuario = :id_usuario";
        $stmt = $this->bd->prepare($sql);
        $stmt->bindParam(':id_usuario', $this->id_usuario, PDO::PARAM_INT);

        return $stmt->execute();
    }

    // Login
    public function login()
    {
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
                $_SESSION['erro'] = "Usuario ou senha invalido!";
                return false;
                header('Location: login.php');
                exit();
            }
        }
    }

    public function buscarPorEmail($email)
    {
        $sql = "SELECT * FROM usuario WHERE email = :email LIMIT 1";
        $stmt = $this->bd->prepare($sql);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->execute();

        // Retorna um objeto com os dados ou false se não encontrar
        return $stmt->fetch(PDO::FETCH_OBJ);
    }
}
