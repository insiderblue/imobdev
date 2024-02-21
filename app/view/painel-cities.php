

<?php if (isset($_GET["deleted"])) {

include("painel-city-deleted.php");

} else { ?>

<form method="post" enctype="multipart/form-data">

    <input type="hidden" name="new_city" value="true" />

    <div class="card text-white bg-secondary shadow-lg mt-4">

        <div class="card-header toggle_content" content="new_city" style="font-size: 19px; font-weight: 600; cursor: pointer">
            <span class="iconify" data-icon="akar-icons:circle-plus-fill"></span> Cadastrar cidade
        </div>

        <div class="card-body bg-white text-dark new_city p-4" style="display: block">

            <div class="row">

                <div class="mb-3 col">
                    <label for="city_title" class="form-label">Cidade</label>
                    <input autofocus autocomplete="off" type="text" class="form-control" name="city_title">
                </div>

            </div>


        </div>


        <div class="card-footer bg-light text-end new_city" style="display: block">

            <div class="row">

                <div class="col">
                    <button type="submit" class="btn btn-primary">Cadastrar cidade</button>

                </div>
            </div>


        </div>

    </div>

</form>

<div class="card text-white bg-secondary shadow-lg mt-4">
    <div class="card-header toggle_content" content="cities" style="font-size: 19px; font-weight: 600; cursor: pointer">
        <span class="iconify" data-icon="icon-park-solid:city"></span> Cidades cadastradas
    </div>
</div>

<div class="row cities mt-0">
    <?php

    foreach ($cities as $row) {
    ?>

        <div class="col-12">

            <div class="card shadow-lg mt-0 p-0">


                <div class="card-body p-2 ps-3">
                    <?= $row["city_title"] ?> - <a class="text-danger delete-city" href="./?cities&city_id=<?= $row["city_id"] ?>&delete">Excluir<a>
                </div>


            </div>

        </div>


    <?php } ?>
</div>

<?php } ?>