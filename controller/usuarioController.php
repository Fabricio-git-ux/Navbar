<?php

include_once 'configs/database.php';
include_once 'php/usuario.php';

Class usuarioController{
    private $bd;
    private $usuarios;

    public function __construct() {
        $banco = new DataBase();
        $this->bd = $banco->conectar();
        $this->usuarios =  new Usuario($this->bd);
    }

    public function indexUsuario(){
        return $this->usuarios->lerTodos();
    }

    public function pesquisarUsuario($nome){
        return $this->usuarios->lerUsuario($nome);
    }

    public function localizarUsuario($id){
        return $this->usuarios->pesquisarUsuario($id);
    }

    public function cadastrarUsuario($usuario){
        $this->usuarios->nome = $usuario['nome'];
        $this->usuarios->email = $usuario['nome'];
        $this->usuarios->senha = password_hash($usuario['senha'], PASSWORD_DEFAULT);
        $this->usuarios->telefone = $usuario['telefone'];

        if($this->usuarios->Cadastrar()){
            header("Location: index.php");
            exit();
        }
        return false;
    }

    public function atualizarUsuario($dados){
        $senha_hash = password_hash($this->senha, PASSWORD_DEFAULT);
        $this->usuarios->id = $dados['id'];
        $this->usuarios->nome = $dados['nome'];
        $this->usuarios->email = $dados['email'];
        $this->usuarios->senha = $dados['senha'];
        $this->usuarios->telefone = $dados['telefone'];

        if($this->usuarios->atualizar()){
            header("Location: #");
            exit();
        }
        return false;
    }

    public function excluirUsuario($id){
        $this->usuarios->id = $id;

        if($this->usuarios->login()){
            header("Location: login.php");
            exit();
        }
    }

    public function login($email, $senha){
        $this->usuarios->email = $email;
        $this->usuarios->senha = $senha;
        $this->usuarios->login();

        if($this->usuarios->login()){
            header("Location: index.php");
            exit();
        } else {
            header("Location: login.php");
        }
    }
}


?>