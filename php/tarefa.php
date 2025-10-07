<?php

Class tarefa{
    public $id_tarefa;
    public $titulo;
    public $descricao;
    public $status;
    public $data_criacao;

    private $bd;

    public function __construct($bd) {
        $this->bd = $bd;
    }

    public function lerTodos(){
        $sql = "SELECT * FROM tarefa";
        $stmt = $this->bd->query($sql);
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function lerTarefa($titulo){
        $titulo = "%" . $titulo . "%";
        $sql = "SELECT * FROM tarefa WHERE titulo LIKE :titulo";
        $stmt = $this->bd->prepare($sql);
        $stmt->bindParam('titulo', $titulo, PDO::PARAM_STR);

        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function pesquisarTarefa($id_tarefa){
        $sql = "SELECT * FROM tarefa WHERE id_tarefa = :id_tarefa";
        $stmt = $this->bd->prepare($sql);
        $stmt->bindParam(':id_tarefa', $id_tarefa, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    public function cadastrar(){
        $sql = "INSERT INTO tarefa(titulo, descricao, status, data_criacao) VALUES id_tarefa = :id_tarefa";
        $stmt = $this->bd->prepare($sql);
        $stmt->bindParam('titulo', $this->titulo, PDO::PARAM_STR);
        $stmt->bindParam('descricao', $this->descricao, PDO::PARAM_STR);
        $stmt->bindParam('status', $this->status, PDO::PARAM_STR);
        $stmt->bindParam('data_criacao', $this->data_criacao, PDO::PARAM_STR);
    }
}

?>