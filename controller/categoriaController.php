<?php

include_once(__DIR__ . '/../configs/database.php');
include_once(__DIR__ . '/../php/categoria.php');

class categoriaController {
    private $bd;
    private $categoria;

    public function __construct() {
        try {
            $banco = new DataBase();
            $this->bd = $banco->conectar();

            if (!$this->bd) {
                $this->categoria = null;
            } else {
                $this->categoria = new categoria($this->bd);
            }
        } catch (\Throwable $e) {
            error_log("Erro no categoriaController: " . $e->getMessage());
            $this->bd = null;
            $this->categoria = null;
        }
    }

    // Pesquisa categorias pelo nome (LIKE)
    public function pesquisarCategoria($nome_categoria){
        if ($this->categoria) {
            return $this->categoria->lerCategoria($nome_categoria);
        }

        // Mock temporário para teste do select
        return [
            ['id_categoria' => 1, 'nome_categoria' => 'Categoria de teste'],
        ];
    }

    // Localizar categoria pelo ID
    public function localizarCategoriaPorID($id_categoria){
        if ($this->categoria) {
            return $this->categoria->pesquisarCategoriaID($id_categoria);
        }
        return null;
    }

    // Localizar categoria pelo nome
    public function localizarCategoriaPorNome($nome_categoria){
        if ($this->categoria) {
            return $this->categoria->pesquisarCategoriaNome($nome_categoria);
        }
        return [];
    }

    // Cadastrar nova categoria
    public function cadastrarCategoria($dados){
        if (!$this->categoria) return false;
        $this->categoria->nome_categoria = $dados['nome_categoria'] ?? '';
        return $this->categoria->cadastrar();
    }

    // Atualizar categoria existente
    public function atualizarCategoria($dados){
        if (!$this->categoria) return false;

        $this->categoria->id_categoria = $dados['id_categoria'] ?? 0;
        $this->categoria->nome_categoria = $dados['nome_categoria'] ?? '';

        if($this->categoria->atualizar()){
            header("Location: editar_categoria.php");
            exit();
        }
        return false;
    }

    // Excluir categoria
    public function excluirCategoria($id_categoria){
        if (!$this->categoria) return false;

        $this->categoria->id_categoria = $id_categoria;
        if($this->categoria->excluir()){
            header("Location: add_categoria.php");
            exit();
        }
        return false;
    }
}

?>
