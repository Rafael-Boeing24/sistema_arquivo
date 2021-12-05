<?php

/**
 * Arquivo Controller
 * @package Src
 * @subpackage Controller
 * @author Rafael Boeing
 * @since 02/12/2021
 */
namespace src\controllers;

use \core\Controller,
    \core\Database,
    \src\models\Arquivo;

class ArquivoController extends Controller {

    // ===============================================================================================================================
    // ====================================================== PROCESSA INCLUSÃO ======================================================
    // ===============================================================================================================================

    public function carregaTelaNovoArquivo() {
        $this->render('novoArquivo');
    }

    public function novoArquivo() {
        if ($this->processaInclusao()) {
            $sNewNomeArquivo  = strtolower(str_replace(' ', '_', filter_input(INPUT_POST, 'nomeArquivo')));
            $sConteudoArquivo = filter_input(INPUT_POST, 'coteudoArquivo');


            if (file_put_contents(dirname(__DIR__) . '/files/' . $sNewNomeArquivo . '.txt', $sConteudoArquivo)) {
                $this->redirect('/');
            } else {
                $this->redirect('/novoArquivo');
            }
        }
    }

    protected function processaInclusao() {
        if ($sNomeArquivo = filter_input(INPUT_POST, 'nomeArquivo')) {
            $sNomeFisicoArquivo = strtolower(str_replace(' ', '_', $sNomeArquivo));
            // Carrega a conexão para que seja processado as informações do arquivo.
            $oConexao = Database::getInstance();
            $oPrepare = $oConexao->prepare('insert into tbarquivo (arqnome, arqnomefisico)' . ENTER .
                                           'values (:nome, :nomeFisico)');

            return $oPrepare->execute(['nome' => $sNomeArquivo, 'nomeFisico' => $sNomeFisicoArquivo . '.txt']);
        }
    }

    // ===============================================================================================================================
    // ====================================================== PROCESSA ALTERAÇÃO =====================================================
    // ===============================================================================================================================

    public function carregaTelaAlteraArquivo($args) {
        // Carrega as informações do arquivo.
        $oArquivo = Arquivo::select()->where('arqcodigo', $args['codigo'])->one();

        if (file_exists(dirname(__DIR__) . '/files/' . $oArquivo['arqnomefisico'])) {
            $sContentFile = file_get_contents(dirname(__DIR__) . '/files/' . $oArquivo['arqnomefisico']);
            $this->render('alteraArquivo', [
                'arquivo'  => $oArquivo,
                'conteudo' => $sContentFile
            ]);
        } else {
            $this->render('alteraArquivo', [
                'arquivo'  => $oArquivo,
                'conteudo' => ''
            ]);
        }
    }

    public function alteraArquivo() {
        if ($sNomeArquivo = filter_input(INPUT_POST, 'nomeArquivoFisico')) {
            $sConteudoArquivo = filter_input(INPUT_POST, 'coteudoArquivo');
            file_put_contents(dirname(__DIR__) . '/files/' . $sNomeArquivo, $sConteudoArquivo);

            $this->redirect('/');
        }
    }

    // ===============================================================================================================================
    // ====================================================== PROCESSA EXCLUSÃO ======================================================
    // ===============================================================================================================================

    public function excluirArquivo($args) {
        $oArquivo = Arquivo::select()->where('arqcodigo', $args['codigo'])->one();
        // Se excluiu o registro corretamente, processa a exclusão do arquivo.
        if (Arquivo::delete()->where('arqcodigo', $args['codigo'])->execute()) {
            // Verifica se o arquivo existe para ser excluído.
            if (file_exists(dirname(__DIR__) . '/files/' . $oArquivo['arqnomefisico'])) {
                unlink(dirname(__DIR__) . '/files/' . $oArquivo['arqnomefisico']);
            }
        }
        $this->redirect('/');
    }

}
