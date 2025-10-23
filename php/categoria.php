<?php

include_once(__DIR__ . '../../configs/database.php');

Class categoria
{
    public $id_categoria;
    public $nome_categoria;
    public $id_usuario;

    private $bd;

    public function __construct($bd)
    {
        $this->bd = $bd;
    }

    public function contarCategorias($idUsuario)
    {
        $sql = "SELECT COUNT(*) FROM categoria WHERE id_usuario = :id_usuario";
        $stmt = $this->bd->prepare($sql);
        $stmt->execute([':id_usuario' => $idUsuario]);
        return $stmt->fetchColumn();
    }


    public function lerTodos()
    {
        $sql = "SELECT * FROM categoria";
        $stmt = $this->bd->query($sql);
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function lerCategoria($nome_categoria)
    {
        $nome_categoria = "%" . $nome_categoria . "%";
        $sql = "SELECT * FROM categoria WHERE nome_categoria LIKE :nome_categoria";
        $stmt = $this->bd->prepare($sql);
        $stmt->bindParam(':nome_categoria', $nome_categoria, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function pesquisarCategoriaID($id_categoria)
    {
        $sql = "SELECT * FROM categoria WHERE id_categoria = :id_categoria";
        $stmt = $this->bd->prepare($sql);
        $stmt->bindParam(':id_categoria', $id_categoria, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    public function pesquisarCategoriaNome($nome)
    {
        $sql = "SELECT id_categoria, nome_categoria FROM categoria WHERE nome_categoria LIKE :nome";
        $stmt = $this->bd->prepare($sql);
        $nome = "%" . $nome . "%";
        $stmt->bindParam(':nome', $nome, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function cadastrar()
    {
        $sql = "INSERT INTO categoria(nome_categoria, id_categoria, id_usuario) VALUES (:nome_categoria, :id_categoria, :id_usuario)";
        $stmt = $this->bd->prepare($sql);
        $stmt->bindParam(':id_categoria', $this->id_categoria, PDO::PARAM_INT);
        $stmt->bindParam(':nome_categoria', $this->nome_categoria, PDO::PARAM_STR);
        $stmt->bindParam(':id_usuario', $this->id_usuario, PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function atualizar()
    {
        $sql = "UPDATE categoria SET nome_categoria = :nome_categoria WHERE id_categoria = :id_categoria";
        $stmt = $this->bd->prepare($sql);
        $stmt->bindParam(':nome_categoria', $this->nome_categoria, PDO::PARAM_STR);
        $stmt->bindParam(':id_categoria', $this->id_categoria, PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function excluir()
    {
        $sql = "DELETE FROM categoria WHERE id_categoria = :id_categoria";
        $stmt = $this->bd->prepare($sql);
        $stmt->bindParam(':id_categoria', $this->id_categoria, PDO::PARAM_INT);
        return $stmt->execute();
    }
}
