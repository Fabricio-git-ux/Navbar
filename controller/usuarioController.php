<?php

include_once(__DIR__ . '/../configs/database.php');
include_once(__DIR__ . '/../php/usuario.php');

Class usuarioController{
    private $bd;
    private $usuario;

    public function __construct() {
        $banco = new DataBase();
        $this->bd = $banco->conectar();
        $this->usuario =  new usuario($this->bd);
    }

    public function pesquisarUsuario($nome){
        return $this->usuario->lerUsuario($nome);
    }

    public function localizarUsuario($id){
        return $this->usuario->pesquisarUsuario($id);
    }

    public function cadastrarUsuario($dados){
        $this->usuario->nome = $dados['nome'];
        $this->usuario->email = $dados['email'];
        $this->usuario->senha = $dados['senha'];
        $this->usuario->telefone = $dados['telefone'];

        return $this->usuario->Cadastrar();
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

        if($this->usuario->excluir()){
            header("Location: index.php");
            exit();
        }
    }

    public function loginUsuario($email, $senha){
        $this->usuario->email = $email;
        $this->usuario->senha = $senha;
        $resultado = $this->usuario->login();

        if($resultado){
            header("Location: index.php");
            exit;
        } else {
            header("Location: /pages/login.php");
            exit;
        }
    }
}


?>