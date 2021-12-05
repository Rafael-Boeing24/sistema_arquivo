<?php
use core\Router;

$router = new Router();

$router->get('/', 'HomeController@index');

// ======================================================== ARQUIVO ========================================================

$router->get ('/arquivo/novo'            , 'ArquivoController@carregaTelaNovoArquivo');
$router->post('/arquivo/novo'            , 'ArquivoController@novoArquivo');
$router->get ('/arquivo/alterar/{codigo}', 'ArquivoController@carregaTelaAlteraArquivo');
$router->post('/arquivo/alterar'         , 'ArquivoController@alteraArquivo');
$router->get ('/arquivo/excluir/{codigo}', 'ArquivoController@excluirArquivo');