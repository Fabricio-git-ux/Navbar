<?php

Class usuario{
    public $id;
    public $nome;
    public $email;
    public $senha;
    public $telefone;

    private $bd;

    public function __construct($bd){
        $this->bd = $bd;
    }

    public function lerTodos(){
        $sql = "SELECT * FROM usuario";
        $resultado = $this->bd->query($sql);
        $resultado->execute();

        return $resultado->fetchAll(PDO::FETCH_OBJ);
    }

    public function lerusuario($nome){
        $nome = "%" . $nome . "%";
        $sql = "SELECT * FROM usuario WHERE nome LIKE :nome";
    }
}

?>