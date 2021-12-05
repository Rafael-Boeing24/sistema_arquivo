<?php $render('header'); ?>

<div class="container mt-4">
    <form method="POST" action="<?= $base; ?>/arquivo/novo">
        <div class="mb-3">
            <label for="nomeArquivo" class="form-label">Nome Arquivo</label>
            <input type="text" class="form-control" id="nomeArquivo" name="nomeArquivo">
        </div>
        <div class="mb-3">
            <label for="coteudoArquivo" class="form-label">Conteúdo Arquivo</label>
            <textarea class="form-control" id="coteudoArquivo" name="coteudoArquivo" rows="3"></textarea>
        </div>
        <input type="submit" value="Criar Arquivo" class="btn btn-success">
    </form>
</div>

<?php $render('footer'); ?>