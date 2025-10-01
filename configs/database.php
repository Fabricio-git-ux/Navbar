<?php

Class DataBase{
    private $host = "127.0.0.1:3307";
    private $banco = "c.tarefas";
    private $usuario = "root";
    private $senha = "";
    public $con;

    public function conectar(){
        $this->con = null;

        try {
            $this->con = new PDO("mysql:host=$this->host;dbname=$this->banco", $this->usuario, $this->senha);
        } catch (PDOException $e) {
            echo "Erro ao conectar: " . $e->getMessage();
        }
        return $this->con;
    }
}

?>