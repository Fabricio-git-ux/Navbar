<?php

include_once(__DIR__ . '/../configs/database.php');
include_once(__DIR__ . '/../php/tarefa.php');

class tarefaController
{
    private $bd;
    private $tarefa;

    public function __construct()
    {
        try {
            $banco = new DataBase();
            $this->bd = $banco->conectar();

            if (!$this->bd) {
                // Caso a conexão falhe, inicializa $tarefa como null
                $this->tarefa = null;
            } else {
                $this->tarefa = new tarefa($this->bd);
            }
        } catch (\Throwable $e) {
            // Se houver qualquer erro, captura e continua sem travar a página
            error_log("Erro no tarefaController: " . $e->getMessage());
            $this->bd = null;
            $this->tarefa = null;
        }
    }

    // Retorna tarefas (mock se $tarefa não estiver inicializado)
    public function pesquisarTarefa($titulo)
    {
        if ($this->tarefa) {
            return $this->tarefa->lerTarefa($titulo);
        }

        // Mock temporário: evita erro e permite teste do HTML
        return [
            (object)[
                'id_tarefa' => 1,
                'titulo' => 'Tarefa de teste',
                'descricao' => 'Descrição de teste',
                'status' => 'Pendente'
            ],
        ];
    }

    public function cadastrarTarefa($dados)
    {
        if (!$this->tarefa) return false;

        $this->tarefa->titulo = $dados['titulo'] ?? '';
        $this->tarefa->descricao = $dados['descricao'] ?? '';
        $this->tarefa->status = $dados['status'] ?? 'Pendente';

        $this->tarefa->id_usuario = 1; // Exemplo fixo
        $this->tarefa->id_categoria = $dados['id_categoria'] ?? 0;

        return $this->tarefa->cadastrar();
    }

    public function localizarTarefa($id_tarefa)
    {
        if (!$this->tarefa) return null;
        return $this->tarefa->pesquisarTarefa($id_tarefa);
    }

    public function atualizarTarefa($dados)
    {
        if (!$this->tarefa) return false;

        $this->tarefa->id_tarefa = $dados['id_tarefa'] ?? 0;
        $this->tarefa->titulo = $dados['titulo'] ?? '';
        $this->tarefa->descricao = $dados['descricao'] ?? '';
        $this->tarefa->status = $dados['status'] ?? 'Pendente';

        return $this->tarefa->atualizar();
    }

    public function excluirTarefa($id_tarefa)
    {
        if ($this->tarefa) {
            $this->tarefa->id_tarefa = $id_tarefa;
            return $this->tarefa->excluir();
        }
        return false;
    }
}
