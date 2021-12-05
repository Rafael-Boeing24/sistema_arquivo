<?php
use core\Database;

$render('header');

?>

<div class="container mt-3">
    <div>
        <a class="btn btn-success mb-4" href="<?=$base?>/arquivo/novo">Inserir</a>
        <table class="position-absolute end-50">
            <tr>
                <td class="p-3">Id</td>
                <td class="p-3">Nome Arquivo</td>
                <td class="p-3">Ações</td>
            </tr>
            <?php
            $oConexao = Database::getInstance();
            $oPrepare = $oConexao->prepare('select arqcodigo as codigo,' . ENTER .
                                           '       arqnome as nome' . ENTER .
                                           '  from tbarquivo');

            $oPrepare->execute();
            while ($oRes = $oPrepare->fetchObject()) {
                $sRegistro = '<tr>' . ENTER .
                             '    <td class="p-3">' . $oRes->codigo . '</td>' . ENTER .
                             '    <td class="p-3">' . $oRes->nome . '</td>' . ENTER .
                             '    <td class="p-3">' .
                             '        <a href="' . $base . '/arquivo/alterar/' . $oRes->codigo . '" class="btn btn-primary">Alterar</a>' . ENTER .
                             '        <a href="' . $base . '/arquivo/excluir/' . $oRes->codigo . '" class="btn btn-danger">Excluir</a>' . ENTER .
                             '</td>' . ENTER .
                             '</tr>';

                echo $sRegistro;
            }
            ?>
        </table>
    </div>
</div>

<?php $render('footer');