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
        <h5 class="card-header bg-info text-light">
            Esta ação preencherá a plataforma com o número máximo de imóveis permitidos, contendo informações aleatórias.
        </h5>
        <div class="card-body">
            <a href="./?dev-random-properties&confirm">Clique aqui</a> para realizar esta ação.
        </div>
    </div>

<?php endif; ?>