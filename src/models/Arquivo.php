<?php

namespace src\models;

use core\Model;

class Arquivo extends Model {

    private $codigo;
    private $nome;
    private $nomeArquivo;

    // ==============================================================================================================
    // ============================================== GETTERS E SETTERS =============================================
    // ==============================================================================================================

    public function getCodigo() {
        return $this->codigo;
    }

    public function setCodigo($codigo) {
        $this->codigo = $codigo;
    }

    public function getNome() {
        return $this->nome;
    }

    public function setNome($nome) {
        $this->nome = $nome;
    }

    public function getNomeArquivo() {
        return $this->nomeArquivo;
    }

    public function setNomeArquivo($nomeArquivo) {
        $this->nomeArquivo = $nomeArquivo;
    }

    // ==============================================================================================================
    // ================================================ PROCESSAMENTO ===============================================
    // ==============================================================================================================

    public static function getTableName() {
        return 'tbarquivo';
    }

}
