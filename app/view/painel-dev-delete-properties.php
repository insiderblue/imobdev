<?php if(!isset($_SESSION["dev-mode"])) : exit; endif; ?>

<?php if(isset($_GET["confirm"])) : ?>

<div class="card shadow-lg mt-4">
    <h5 class="card-header bg-success text-light">
        Todos os imóveis foram deletados com sucesso!
    </h5>
    <div class="card-body">
        <a href="./?properties">Clique aqui</a> para voltar para a página inicial.
    </div>
</div>

<?php else : ?>

<div class="card shadow-lg mt-4">
    <h5 class="card-header bg-warning text-dark">
        Esta ação removerá todos os imóveis cadastrados. Não será possível recuperá-los!
    </h5>
    <div class="card-body">
        <a href="./?dev-delete-properties&confirm">Clique aqui</a> para confirmar.
    </div>
</div>

<?php endif; ?>