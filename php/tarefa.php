<?php

class tarefa
{
    public $id_tarefa;
    public $titulo;
    public $descricao;
    public $status;
    public $id_usuario;
    public $id_categoria;

    private $bd;

    public function __construct($bd)
    {
        $this->bd = $bd;
    }

    public function lerTodos()
    {
        $sql = "SELECT * FROM tarefa";
        $stmt = $this->bd->query($sql);
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function lerTarefa($titulo)
    {
        $titulo = "%" . $titulo . "%";
        $sql = "SELECT * FROM tarefa WHERE titulo LIKE :titulo";
        $stmt = $this->bd->prepare($sql);
        $stmt->bindParam('titulo', $titulo, PDO::PARAM_STR);

        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function pesquisarTarefa($id_tarefa)
    {
        $sql = "SELECT * FROM tarefa WHERE id_tarefa = :id_tarefa";
        $stmt = $this->bd->prepare($sql);
        $stmt->bindParam(':id_tarefa', $id_tarefa, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    public function cadastrar()
{
    $sql = "INSERT INTO tarefa (titulo, descricao, status, id_usuario, id_categoria) 
            VALUES (:titulo, :descricao, :status, :id_usuario, :id_categoria)";
    $stmt = $this->bd->prepare($sql);

    $stmt->bindParam(':titulo', $this->titulo, PDO::PARAM_STR);
    $stmt->bindParam(':descricao', $this->descricao, PDO::PARAM_STR);
    $stmt->bindParam(':status', $this->status, PDO::PARAM_STR);
    $stmt->bindParam(':id_usuario', $this->id_usuario, PDO::PARAM_INT);

    // ✅ Verifica se a categoria foi informada. Se não, insere NULL.
    $id_categoria = !empty($this->id_categoria) ? $this->id_categoria : null;
    $stmt->bindParam(':id_categoria', $id_categoria, PDO::PARAM_INT);

    return $stmt->execute();
}




    public function atualizar()
    {
        $sql = "UPDATE tarefa SET titulo = :titulo, descricao = :descricao, status = :status WHERE id_tarefa = :id_tarefa";
        $stmt = $this->bd->prepare($sql);
        $stmt->bindParam('titulo', $this->titulo, PDO::PARAM_STR);
        $stmt->bindParam('descricao', $this->descricao, PDO::PARAM_STR);
        $stmt->bindParam('status', $this->status, PDO::PARAM_STR);

        return $stmt->execute();
    }

    public function excluir()
    {
        $sql = "DELETE FROM tarefa WHERE id_tarefa = :id_tarefa";
        $stmt = $this->bd->prepare($sql);
        $stmt->bindParam(':id_tarefa', $this->id_tarefa, PDO::PARAM_INT);

        return $stmt->execute();
    }
}
