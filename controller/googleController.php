<?php

include_once(__DIR__ . '/../configs/database.php');
include_once(__DIR__ . '/../model/usuarioGoogle.php');

class googleController
{
    private $gi;
    private $usuario_google;

    public function __construct()
    {
        $banco = new DataBase();
        $this->gi = $banco->conectar();
        $this->usuario_google = new usuarioGoogle($this->gi);
    }

    public function cadastrarGoogle($dados)
    {
        $this->usuario_google->google_id = $dados['google_id'];
        $this->usuario_google->nome = $dados['nome'];
        $this->usuario_google->email = $dados['email'];
        $this->usuario_google->picture = $dados['picture'];

        return $this->usuario_google->cadastroGoogle();
    }

    public function atualizarGoogle($dados)
    {
        $this->usuario_google->google_id = $dados['google_id'];
        $this->usuario_google->nome = $dados['nome'];
        $this->usuario_google->email = $dados['email'];
        $this->usuario_google->picture = $dados['picture'];

        if ($this->usuario_google->atualizarGoogle()) {
            header("Location: /Navbar/index.php");
            exit();
        }
        return false;
    }

    public function excluirConta($id)
    {
        $this->usuario_google->id = $id;

        if ($this->usuario_google->excluirConta()) {
            header("Location: index.php");
            exit();
        }
    }

    public function loginGoogle($dados)
    {
        $this->usuario_google->email = $dados['email'];
        $existe = $this->usuario_google->buscarPorEmail($dados['email']);

        if ($existe) {
            return $this->usuario_google->loginGoogle();
        } else {
            $this->cadastrarGoogle($dados);
            return $this->usuario_google->loginGoogle();
        }
    }
}
