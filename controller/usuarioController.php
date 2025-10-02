<?php

include_once 'configs/database.php';
include_once 'php/usuario.php';

Class usuarioController{
    private $bd;
    private $usuario;

    public function __construct() {
        $banco = new DataBase();
        $this->bd = $banco->conectar();
        $this->usuario =  new Usuario($this->bd);
    }

    public function pesquisarUsuario($nome){
        return $this->usuario->lerUsuario($nome);
    }

    public function localizarUsuario($id){
        return $this->usuario->pesquisarUsuario($id);
    }

    public function cadastrarUsuario($usuario){
        var_dump("oi");
        die();
        $this->usuario->nome = $usuario['nome'];
        $this->usuario->email = $usuario['email'];
        $this->usuario->senha = $usuario['senha'];
        $this->usuario->telefone = $usuario['telefone'];

        if($this->usuario->Cadastrar()){
            header("Location: ../pages/index.php");
            exit();
        }
        return false;
    }

    public function atualizarUsuario($dados){
        $this->usuario->id = $dados['id'];
        $this->usuario->nome = $dados['nome'];
        $this->usuario->email = $dados['email'];
        $this->usuario->senha = $dados['senha'];
        $this->usuario->telefone = $dados['telefone'];

        if($this->usuario->atualizar()){
            header("Location: #");
            exit();
        }
        return false;
    }

    public function excluirUsuario($id){
        $this->usuario->id = $id;

        if($this->usuario->login()){
            header("Location: login.php");
            exit();
        }
    }

    public function login($email, $senha){
        $this->usuario->email = $email;
        $this->usuario->senha = $senha;
        $this->usuario->login();

        if($this->usuario->login()){
            header("Location: index.php");
            exit();
        } else {
            header("Location: login.php");
        }
    }
}


?>