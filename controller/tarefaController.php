<?php

include_once(__DIR__ . '/../configs/database.php');
include_once(__DIR__ . '/../controller/categoriaController.php');
include_once(__DIR__ . '/../php/categoria.php');
include_once(__DIR__ . '/../php/tarefa.php');

class tarefaController
{
    private $bd;
    private $tarefa;

    public function __construct()
    {
        $banco = new DataBase();
        $this->bd = $banco->conectar();
        $this->tarefa = new tarefa($this->bd);
    }

    public function pesquisarTarefa($titulo)
    {
        return $this->tarefa->lerTarefa($titulo);
    }

    public function localizarTarefa($id_tarefa)
    {
        return $this->tarefa->pesquisarTarefa($id_tarefa);
    }

    public function cadastrarTarefa($dados)
    {
        $this->tarefa->titulo = $dados['titulo'];
        $this->tarefa->descricao = $dados['descricao'];
        $this->tarefa->status = $dados['status'];

        // Aqui você define o usuário logado e a categoria escolhida
        $this->tarefa->id_usuario = 1; // Exemplo fixo (depois pode pegar de $_SESSION)
        $this->tarefa->id_categoria = 1; // Exemplo fixo (ou pegar de um select do formulário)*/

        return $this->tarefa->cadastrar();
    }


    public function atuzalizarTarefa($dados)
    {
        $this->tarefa->id_tarefa = $dados['id_tarefa'];
        $this->tarefa->titulo = $dados['titulo'];
        $this->tarefa->descricao = $dados['descricao'];
        $this->tarefa->status = $dados['status'];

        if ($this->tarefa->atualizar()) {
            header("Location: #");
            exit();
        }
        return false;
    }

    public function excluirTarefa($id_tarefa)
    {
        header("Location: index.php");
        exit();
    }
}
