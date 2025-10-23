<?php
include_once(__DIR__ . '/../php/categoria.php');

class tarefa
{
    public $id_tarefa;
    public $titulo;
    public $descricao;
    public $status;
    public $categoria;
    public $data_atualizacao;
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
        $stmt->bindParam(':titulo', $titulo, PDO::PARAM_STR);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function contarTarefa($idUsuario)
    {
        $sql = "SELECT COUNT(*) FROM tarefa WHERE id_usuario = :id_usuario";
        $stmt = $this->bd->prepare($sql);
        $stmt->execute([':id_usuario' => $idUsuario]);

        return $stmt->fetchColumn();
    }

    public function contarTarefasConcluidas($idUsuario)
    {
        $sql = "SELECT COUNT(*) FROM tarefa WHERE status = 'concluido' AND id_usuario = :id_usuario";
        $stmt = $this->bd->prepare($sql);
        $stmt->execute([':id_usuario' => $idUsuario]);

        return $stmt->fetchColumn();
    }

    public function contarTarefaPendente($idUsuario)
    {
        $sql = "SELECT COUNT(*) FROM tarefa WHERE status = 'pendente' AND id_usuario = :id_usuario";
        $stmt = $this->bd->prepare($sql);
        $stmt->execute([':id_usuario' => $idUsuario]);

        return $stmt->fetchColumn();
    }

    public function contarTarefaEmAndamento($idUsuario)
    {
        $sql = "SELECT COUNT(*) FROM tarefa WHERE status = 'em andamento' AND id_usuario = :id_usuario";
        $stmt = $this->bd->prepare($sql);
        $stmt->execute([':id_usuario' => $idUsuario]);

        return $stmt->fetchColumn();
    }

    public function pesquisarTarefa($id_tarefa)
    {
        $sql = "SELECT * FROM tarefa WHERE id_tarefa = :id_tarefa";
        $stmt = $this->bd->prepare($sql);
        $stmt->bindParam(':id_tarefa', $id_tarefa, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    public function buscarPorUsuario($id_usuario)
    {
        $sql = "SELECT * FROM tarefa WHERE id_usuario = :id_usuario";
        $stmt = $this->bd->prepare($sql);
        $stmt->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }


    public function cadastrar()
    {
        $sql = "INSERT INTO tarefa (titulo, descricao, status, id_usuario, id_categoria) VALUES (:titulo, :descricao, :status, :id_usuario, :id_categoria)";
        $stmt = $this->bd->prepare($sql);

        $stmt->bindParam(':titulo', $this->titulo, PDO::PARAM_STR);
        $stmt->bindParam(':descricao', $this->descricao, PDO::PARAM_STR);
        $stmt->bindParam(':status', $this->status, PDO::PARAM_STR);
        $stmt->bindParam(':id_usuario', $this->id_usuario, PDO::PARAM_INT);


        // Verifica se a categoria foi informada. Se não, insere NULL.
        $id_categoria = !empty($this->id_categoria) ? $this->id_categoria : null;
        $stmt->bindParam(':id_categoria', $id_categoria, PDO::PARAM_INT);

        return $stmt->execute();
    }

    public function atualizar()
    {
        $sql = "UPDATE tarefa SET titulo = :titulo, descricao = :descricao, status = :status, data_atualizacao = :data_atualizacao WHERE id_tarefa = :id_tarefa";
        $stmt = $this->bd->prepare($sql);
        $stmt->bindParam(':titulo', $this->titulo, PDO::PARAM_STR);
        $stmt->bindParam(':descricao', $this->descricao, PDO::PARAM_STR);
        $stmt->bindParam(':status', $this->status, PDO::PARAM_STR);

        date_default_timezone_set('America/Sao_Paulo');
        $this->data_atualizacao =  date('Y-m-d H:i:s');
        $stmt->bindValue(':data_atualizacao', $this->data_atualizacao, PDO::PARAM_STR);

        $stmt->bindParam(':id_tarefa', $this->id_tarefa, PDO::PARAM_INT);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function excluir()
    {
        $sql = "DELETE FROM tarefa WHERE id_tarefa = :id_tarefa";
        $stmt = $this->bd->prepare($sql);
        $stmt->bindParam(':id_tarefa', $this->id_tarefa, PDO::PARAM_INT);

        return $stmt->execute();
    }
}
