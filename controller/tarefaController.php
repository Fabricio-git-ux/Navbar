<?php

include_once(__DIR__ . '/../configs/database.php');
include_once(__DIR__ . '/../controller/categoriaController.php');
include_once(__DIR__ . '/../php/tarefa.php');

class tarefaController
{
    private $bd;
    private $tarefa;

    public function __construct()
    {
        $banco = new DataBase();
        $this->bd = $banco->conectar();
        $this->tarefa =  new tarefa($this->bd);
    }

    public function pesquisarTarefa($titulo)
    {
        return $this->tarefa->lerTarefa($titulo);
    }

    public function cadastrarTarefa($dados)
    {
        if (!$this->tarefa) return false;

        $this->tarefa->titulo = $dados['titulo'] ?? '';
        $this->tarefa->descricao = $dados['descricao'] ?? '';
        $this->tarefa->status = $dados['status'] ?? 'Pendente';

        $this->tarefa->id_usuario = 1;
        $this->tarefa->id_categoria = $dados['id_categoria'] ?? 0;

        return $this->tarefa->cadastrar();
    }

    public function localizarTarefa($id_tarefa)
    {
        return $this->tarefa->pesquisarTarefa($id_tarefa);
    }

    public function atualizarTarefa($dados)
    {
        $this->tarefa->id_tarefa = $dados['id_tarefa'];
        $this->tarefa->titulo = $dados['titulo'];
        $this->tarefa->descricao = $dados['descricao'];
        $this->tarefa->status = $dados['status'];

        date_default_timezone_set('America/Sao_Paulo');
        $this->tarefa->data_atualizacao =  date('Y-m-d H:i:s');


        if ($this->tarefa->atualizar()) {
            header("Location: tarefa.php");
            exit();
        }
    }


    public function excluirTarefa($id_tarefa)
    {
        if ($this->tarefa) {
            $this->tarefa->id_tarefa = $id_tarefa;
            return $this->tarefa->excluir();
        }
        return false;
    }
}
