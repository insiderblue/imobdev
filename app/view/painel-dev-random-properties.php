<?php if(!isset($_SESSION["dev-mode"])) : exit; endif; ?>

<?php if(isset($_GET["confirm"])) : ?>

    <div class="card shadow-lg mt-4">
        <h5 class="card-header bg-success text-light">
            Toda a capacidade de imóveis do site foi consumida com sucesso!
        </h5>
        <div class="card-body">
            <a href="./?properties">Clique aqui</a> visualizar a lista de imóveis cadastrados.
        </div>
    </div>

<?php else : ?>

    <div class="card shadow-lg mt-4">
        <h5 class="card-header bg-warning text-dark">
            Esta ação criará diversos imóveis contendo informações aleatórias. Utilize quantas vezes for necessário.
        </h5>
        <div class="card-body">
            <a href="./?dev-random-properties&confirm">Clique aqui</a> para confirmar.
        </div>
    </div>

<?php endif; ?>