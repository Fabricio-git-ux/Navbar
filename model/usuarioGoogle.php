<?php

class usuarioGoogle
{
    public $id;
    public $google_id;
    public $nome;
    public $email;
    public $picture;
    private $gi;

    public function __construct($gi)
    {
        $this->gi = $gi;
    }

    public function lerTodos()
    {
        $sql = "SELECT * FROM usuarios_google";
        $stmt = $this->gi->query($sql);
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function cadastroGoogle()
    {
        $sql = "INSERT INTO usuarios_google(google_id, nome, email, picture) VALUES (:google_id, :nome, :email, :picture)";
        $stmt = $this->gi->prepare($sql);
        $stmt->bindParam(':google_id', $this->google_id, PDO::PARAM_STR);
        $stmt->bindParam(':nome', $this->nome, PDO::PARAM_STR);
        $stmt->bindParam(':email', $this->email, PDO::PARAM_STR);
        $stmt->bindParam(':picture', $this->picture, PDO::PARAM_STR);

        return $stmt->execute();
    }

    public function atualizarGoogle()
    {
        $sql = "UPDATE usuarios_google SET google_id = :google_id, nome = :nome, email = :email, picture = :picture WHERE id = :id";
        $stmt = $this->gi->prepare($sql);
        $stmt->bindParam(':google_id', $this->google_id, PDO::PARAM_STR);
        $stmt->bindParam(':nome', $this->nome, PDO::PARAM_STR);
        $stmt->bindParam(':email', $this->email, PDO::PARAM_STR);
        $stmt->bindParam(':picture', $this->picture, PDO::PARAM_STR);
        $stmt->bindParam(':id', $this->id, PDO::PARAM_INT);

        return $stmt->execute();
    }

    public function excluirConta()
    {
        $sql = "DELETE FROM usuarios_google WHERE id = :id";
        $stmt = $this->gi->prepare($sql);
        $stmt->bindParam(':id', $this->id, PDO::PARAM_INT);

        return $stmt->execute();
    }

    public function loginGoogle()
    {
        $sql = "SELECT * FROM usuarios_google WHERE email = :email LIMIT 1";
        $stmt = $this->gi->prepare($sql);
        $stmt->bindParam(':email', $this->email, PDO::PARAM_STR);
        $stmt->execute();
        $resultado = $stmt->fetch(PDO::FETCH_OBJ);

        if ($resultado) {
            if (session_status() === PHP_SESSION_NONE) session_start();
            $_SESSION['usuarios_google'] = [
                'id' => $resultado->id,
                'nome' => $resultado->nome,
                'email' => $resultado->email,
                'picture' => $resultado->picture
            ];
            return true;
        } else {
            return false;
        }
    }

    public function buscarPorEmail($email)
    {
        $sql = "SELECT * FROM usuarios_google WHERE email = :email LIMIT 1";
        $stmt = $this->gi->prepare($sql);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_OBJ);
    }
}
