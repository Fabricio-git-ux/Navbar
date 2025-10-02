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
            $dsn = ("mysql:host=$this->host;dbname=$this->banco");
            $this->con = new PDO($dsn, $this->usuario, $this->senha);
        } catch (PDOException $e) {
            echo "Erro ao conectar: " . $e->getMessage();
        }
        return $this->con;
    }
}

?>