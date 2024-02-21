<?php if (isset($_GET["deleted"])) {

    include("painel-neighborhood-deleted.php");
} else { ?>

    <form method="post" enctype="multipart/form-data">

        <input type="hidden" name="new_neighborhood" value="true" />

        <div class="card text-white bg-secondary shadow-lg mt-4">

            <div class="card-header toggle_content" content="new_neighborhood" style="font-size: 19px; font-weight: 600; cursor: pointer">
                <span class="iconify" data-icon="akar-icons:circle-plus-fill"></span> Cadastrar bairro
            </div>

            <div class="card-body bg-white text-dark new_neighborhood p-4" style="display: block">

                <div class="row">

                    <div class="mb-3 col">
                        <label for="neighborhood_title" class="form-label">Bairro</label>
                        <input autofocus autocomplete="off" type="text" class="form-control" name="neighborhood_title">
                    </div>

                    <div class="mb-3 col">
                        <label for="city_id" class="form-label">Cidade</label>
                        <select class="form-select" name="city_id">
                            <?php foreach ($cities as $row) { ?>

                                <option value="<?= $row["city_id"] ?>"><?= $row["city_title"] ?></option>

                            <?php } ?>
                        </select>
                    </div>

                </div>


            </div>


            <div class="card-footer bg-light text-end new_neighborhood" style="display: block">

                <div class="row">

                    <div class="col">
                        <button type="submit" class="btn btn-primary">Cadastrar bairro</button>

                    </div>
                </div>


            </div>

        </div>

    </form>

    <div class="card text-white bg-secondary shadow-lg mt-4">
        <div class="card-header toggle_content" content="neighborhoods" style="font-size: 19px; font-weight: 600; cursor: pointer">
            <span class="iconify" data-icon="bi:pin-map-fill"></span> Bairros cadastrados
        </div>
    </div>

    <div class="row neighborhoods mt-0">
        <?php

        $last_city = "";
        foreach ($neighborhoods_cities as $row) {
        ?>

            <div class="col-12">

                <div class="card shadow-lg mt-0 p-0">

                    <?php if ($row["city_title"] !== $last_city) { ?>

                        <div class="card-body p-2 ps-3">
                            <b>- <?= $row["city_title"] ?> -</b>
                        </div>

                    <?php } ?>

                    <div class="card-body p-2 ps-3">
                        <?= $row["neighborhood_title"] ?> - <a class="text-danger delete-neighborhoods" href="./?neighborhoods&neighborhood_id=<?= $row["neighborhood_id"] ?>&delete">Excluir<a>
                    </div>

                    <?php $last_city = $row["city_title"] ?>

                </div>

            </div>


        <?php } ?>
    </div>

<?php } ?>