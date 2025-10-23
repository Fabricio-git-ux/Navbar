<?php

include_once(__DIR__ . '/../configs/database.php');
include_once(__DIR__ . '/../controller/categoriaController.php');
include_once(__DIR__ . '/../php/tarefa.php');
include_once(__DIR__ . '/../controller/usuarioController.php');

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

    public function contarTarefas(){
        $idUsuario = $_SESSION['id_usuario'];
        return $this->tarefa->contarTarefa($idUsuario);
    }

    public function contarTarefasConcluidas(){
        $idUsuario = $_SESSION['id_usuario'];
        return $this->tarefa->contarTarefasConcluidas($idUsuario);
    }

    public function contarTarefasPendente(){
        $idUsuario = $_SESSION['id_usuario'];
        return $this->tarefa->contarTarefaPendente($idUsuario);
    }

    public function contarTarefasEmAndamento(){
        $idUsuario = $_SESSION['id_usuario'];
        return $this->tarefa->contarTarefaEmAndamento($idUsuario);
    }


    public function pesquisarTarefa($titulo)
    {
        return $this->tarefa->lerTarefa($titulo);
    }

    public function listarPorUsuario($id_usuario)
    {
        $tarefa = new tarefa($this->bd);
        return $tarefa->buscarPorUsuario($id_usuario);
    }


    public function cadastrarTarefa($dados)
    {
        session_start(); // Inicia a sessão para acessar o ID do usuário

    if (!isset($_SESSION['id_usuario'])) {
        die("Usuário não logado."); // Segurança: evita cadastro sem login
    }
        $this->tarefa->titulo = $dados['titulo'] ?? '';
        $this->tarefa->descricao = $dados['descricao'] ?? '';
        $this->tarefa->status = $dados['status'] ?? 'Pendente';
        $this->tarefa->id_usuario = $_SESSION['id_usuario'];
        $this->tarefa->id_categoria = $dados['id_categoria'] ?? 0;

        if ($this->tarefa->cadastrar()) {
            header("Location: ../pages/tarefa.php");
            exit();
        }
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
