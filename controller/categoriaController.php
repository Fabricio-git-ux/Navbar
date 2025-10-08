<?php

include_once(__DIR__ . '/../configs/database.php');
include_once(__DIR__ . '/../php/categoria.php');

class categoriaController {
    private $bd;
    private $categoria;

    public function __construct() {
        $banco = new DataBase();
        $this->bd = $banco->conectar();
        $this->categoria = new categoria($this->bd);
    }

    // Pesquisa categorias pelo nome (LIKE)
    public function pesquisarCategoria($nome_categoria){
        return $this->categoria->lerCategoria($nome_categoria);
    }

    // Localizar categoria pelo ID
    public function localizarCategoriaPorID($id_categoria){
        return $this->categoria->pesquisarCategoriaID($id_categoria);
    }

    // Localizar categoria pelo nome (pode retornar várias)
    public function localizarCategoriaPorNome($nome_categoria){
        return $this->categoria->pesquisarCategoriaNome($nome_categoria);
    }

    // Cadastrar nova categoria
    public function cadastrarCategoria($dados){
        $this->categoria->nome_categoria = $dados['nome_categoria'];
        return $this->categoria->cadastrar();
    }

    // Atualizar categoria existente
    public function atualizarCategoria($dados){
        $this->categoria->id_categoria = $dados['id_categoria'];
        $this->categoria->nome_categoria = $dados['nome_categoria'];

        if($this->categoria->atualizar()){
            header("Location: index.php"); // redireciona após atualizar
            exit();
        }
        return false;
    }

    // Excluir categoria
    public function excluirCategoria($id_categoria){
        $this->categoria->id_categoria = $id_categoria;
        if($this->categoria->excluir()){
            header("Location: index.php"); // redireciona após excluir
            exit();
        }
        return false;
    }
}

?>
