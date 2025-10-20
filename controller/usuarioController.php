<?php

include_once(__DIR__ . '/../configs/database.php');
include_once(__DIR__ . '/../php/usuario.php');

Class usuarioController
{
    private $bd;
    private $usuario;

    public function __construct()
    {
        $banco = new DataBase();
        $this->bd = $banco->conectar();
        $this->usuario =  new usuario($this->bd);
    }

    public function pesquisarUsuario($nome)
    {
        return $this->usuario->lerUsuario($nome);
    }

    public function localizarUsuario($id_usuario)
    {
        return $this->usuario->pesquisarUsuario($id_usuario);
    }

    public function cadastrarUsuario($dados)
    {
        $this->usuario->nome = $dados['nome'];
        $this->usuario->email = $dados['email'];
        $this->usuario->senha = $dados['senha'];

        return $this->usuario->Cadastrar();
    }

    public function atualizarUsuario($dados)
    {
        $this->usuario->id_usuario = $dados['id_usuario'];
        $this->usuario->nome = $dados['nome'];
        $this->usuario->email = $dados['email'];
        $this->usuario->senha = $dados['senha'];

        if ($this->usuario->atualizar()) {
            header("Location: ../pages/pag_usuario.php");
            exit();
        }
        return false;
    }

    public function excluirUsuario($id_usuario)
    {
        $this->usuario->id_usuario = $id_usuario;

        if ($this->usuario->excluir()) {
            header("Location: index.php");
            exit();
        }
    }

    public function login($email, $senha)
    {
        $usuario = $this->usuario->buscarPorEmail($email);

        if ($usuario && password_verify($senha, $usuario->senha)) {
            // Login OK → inicia sessão e salva dados
            $_SESSION['id_usuario'] = $usuario->id_usuario;
            $_SESSION['nome'] = $usuario->nome;

            header("Location: ../index.php");
            exit();
        } else {
            //echo "<p style='color:red;'>E-mail ou senha inválidos.</p>";
        }
    }
}
