<?php if (isset($_GET["delete"]) || $property["property_deleted"] == 1) {

    include("painel-property-deleted.php");
} else { ?>

    <form method="post" enctype="multipart/form-data">

        <input type="hidden" name="edit_property" id="edit_property" value="true" />


        <div class="card text-white bg-secondary shadow-lg mt-4">


            <div class="card-header toggle_content" content="new_property" style="font-size: 19px; font-weight: 600; cursor: pointer">
                <span class="iconify" data-icon="fa6-solid:house-chimney"></span> Editar imóvel
            </div>

            <div class="card-body bg-white text-dark new_property p-4" style="display: block">

                <div class="row">

                    <div class="mb-3 col-12">

                        <label for="property_public" class="form-label">Visibilidade do imóvel no site</label>

                        <select class="form-select" name="property_public">

                            <option <?= ($property["property_public"] == 1 ? 'selected' : '') ?> value="1">
                                Imóvel visível
                            </option>

                            <option <?= ($property["property_public"] == 0 ? 'selected' : '') ?> value="0">
                                Imóvel oculto
                            </option>

                        </select>
                    </div>

                    <div class="mb-3 col-12">

                        <label for="property_fixed" class="form-label">Imóvel fixado</label>

                        <select class="form-select" name="property_fixed">


                            <option <?= ($property["property_fixed"] == 0 ? 'selected' : '') ?> value="0">
                                Não
                            </option>

                            <option <?= ($property["property_fixed"] == 1 ? 'selected' : '') ?> value="1">
                                Sim
                            </option>


                        </select>
                    </div>

                    <div class="mb-3 col-12">
                        <label for="property_type_id" class="form-label">Tipo de imóvel</label>

                        <select class="form-select" name="property_type_id">
                            <?php

                            foreach ($property_types as $row) { ?>

                                <option <?= ($property["property_type_id"] == $row["property_type_id"] ? 'selected' : '') ?> value="<?= $row["property_type_id"] ?>">
                                    <?= $row["property_type_title"] ?>
                                </option>

                            <?php } ?>
                        </select>
                    </div>

                    <div class="mb-3 col-12">
                        <label for="property_goal_id" class="form-label">Finalidade</label>

                        <select class="form-select" name="property_goal_id">
                            <?php

                            foreach ($property_goals as $row) { ?>

                                <option <?= ($property["property_goal_id"] == $row["property_goal_id"] ? 'selected' : '') ?> value="<?= $row["property_goal_id"] ?>">
                                    <?= $row["property_goal_title"] ?>
                                </option>

                            <?php } ?>
                        </select>
                    </div>

                    <div class="mb-3 col-12">
                        <label for="property_price" class="form-label">Valor</label>
                        <input value="<?= $property["property_price"] ?>" type="text" class="form-control js-mask-money" name="property_price">
                    </div>

                </div>



   

                <div class="row">
                    <div class="col-12">
                        <div class="mb-3 col-12">
                            <label for="property_area" class="form-label">Área construída</label>
                            <input value="<?= $property["property_area"] ?>" type="number" class="form-control" name="property_area">
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="mb-3 col-12">
                            <label for="property_area_total" class="form-label">Área do terreno</label>
                            <input value="<?= $property["property_area_total"] ?>" type="number" class="form-control" name="property_area_total">
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="mb-3 col-12">
                            <label for="property_measure" class="form-label">Unidade de medida</label>
                            <select class="form-select" name="property_measure">
                                <option <?= ($property["property_measure"] == 'm²' ? 'selected' : '') ?> value="m²">Metro quadrado (m²)</option>
                                <option <?= ($property["property_measure"] == 'a' ? 'selected' : '') ?> value="a">Are (a)</option>
                                <option <?= ($property["property_measure"] == 'ha' ? 'selected' : '') ?> value="ha">Hectare (ha)</option>
                                <option <?= ($property["property_measure"] == 'ca' ? 'selected' : '') ?> value="ca">Centiare (ca)</option>
                                <option <?= ($property["property_measure"] == 'alq' ? 'selected' : '') ?> value="alq">Alqueire (alq)</option>
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="mb-3 col-12">
                            <label for="property_bedrooms" class="form-label">Quartos</label>
                            <select class="form-select" name="property_bedrooms">
                                <option <?= ($property["property_bedrooms"] == 0 ? 'selected' : '') ?> value="0">Nenhum quarto</option>
                                <option <?= ($property["property_bedrooms"] == 1 ? 'selected' : '') ?> value="1">1 quarto</option>
                                <option <?= ($property["property_bedrooms"] == 2 ? 'selected' : '') ?> value="2">2 quartos</option>
                                <option <?= ($property["property_bedrooms"] == 3 ? 'selected' : '') ?> value="3">3 quartos</option>
                                <option <?= ($property["property_bedrooms"] == 4 ? 'selected' : '') ?> value="4">4 quartos</option>
                                <option <?= ($property["property_bedrooms"] == 5 ? 'selected' : '') ?> value="5">6 quartos</option>
                                <option <?= ($property["property_bedrooms"] == 6 ? 'selected' : '') ?> value="6">6 quartos</option>
                                <option <?= ($property["property_bedrooms"] == 7 ? 'selected' : '') ?> value="7">7 quartos</option>
                                <option <?= ($property["property_bedrooms"] == 8 ? 'selected' : '') ?> value="8">8 quartos</option>
                                <option <?= ($property["property_bedrooms"] == 9 ? 'selected' : '') ?> value="9">9 quartos</option>
                                <option <?= ($property["property_bedrooms"] == 10 ? 'selected' : '') ?> value="10">10 quartos</option>
                            </select>
                        </div>
                        <div class="mb-3 col-12">
                            <label for="property_bathrooms" class="form-label">Banheiros</label>
                            <select class="form-select" name="property_bathrooms">
                                <option <?= ($property["property_bathrooms"] == 0 ? 'selected' : '') ?> value="0">Nenhum banheiro</option>
                                <option <?= ($property["property_bathrooms"] == 1 ? 'selected' : '') ?> value="1">1 banheiro</option>
                                <option <?= ($property["property_bathrooms"] == 2 ? 'selected' : '') ?> value="2">2 banheiros</option>
                                <option <?= ($property["property_bathrooms"] == 3 ? 'selected' : '') ?> value="3">3 banheiros</option>
                                <option <?= ($property["property_bathrooms"] == 4 ? 'selected' : '') ?> value="4">4 banheiros</option>
                                <option <?= ($property["property_bathrooms"] == 5 ? 'selected' : '') ?> value="5">6 banheiros</option>
                                <option <?= ($property["property_bathrooms"] == 6 ? 'selected' : '') ?> value="6">6 banheiros</option>
                                <option <?= ($property["property_bathrooms"] == 7 ? 'selected' : '') ?> value="7">7 banheiros</option>
                                <option <?= ($property["property_bathrooms"] == 8 ? 'selected' : '') ?> value="8">8 banheiros</option>
                                <option <?= ($property["property_bathrooms"] == 9 ? 'selected' : '') ?> value="9">9 banheiros</option>
                                <option <?= ($property["property_bathrooms"] == 10 ? 'selected' : '') ?> value="10">10 banheiros</option>
                            </select>
                        </div>
                        <div class="mb-3 col-12">
                            <label for="property_suites" class="form-label">Suítes</label>
                            <select class="form-select" name="property_suites">
                                <option <?= ($property["property_suites"] == 0 ? 'selected' : '') ?> value="0">Nenhuma suíte</option>
                                <option <?= ($property["property_suites"] == 1 ? 'selected' : '') ?> value="1">1 suíte</option>
                                <option <?= ($property["property_suites"] == 2 ? 'selected' : '') ?> value="2">2 suítes</option>
                                <option <?= ($property["property_suites"] == 3 ? 'selected' : '') ?> value="3">3 suítes</option>
                                <option <?= ($property["property_suites"] == 4 ? 'selected' : '') ?> value="4">4 suítes</option>
                                <option <?= ($property["property_suites"] == 5 ? 'selected' : '') ?> value="5">6 suítes</option>
                                <option <?= ($property["property_suites"] == 6 ? 'selected' : '') ?> value="6">6 suítes</option>
                                <option <?= ($property["property_suites"] == 7 ? 'selected' : '') ?> value="7">7 suítes</option>
                                <option <?= ($property["property_suites"] == 8 ? 'selected' : '') ?> value="8">8 suítes</option>
                                <option <?= ($property["property_suites"] == 9 ? 'selected' : '') ?> value="9">9 suítes</option>
                                <option <?= ($property["property_suites"] == 10 ? 'selected' : '') ?> value="10">10 suítes</option>
                            </select>
                        </div>
                        <div class="mb-3 col-12">
                            <label for="property_parking_spaces" class="form-label">Vagas de garagem</label>
                            <select class="form-select" name="property_parking_spaces">
                                <option <?= ($property["property_parking_spaces"] == 0 ? 'selected' : '') ?> value="0">Nenhuma vaga de garagem</option>
                                <option <?= ($property["property_parking_spaces"] == 1 ? 'selected' : '') ?> value="1">1 vaga de garagem</option>
                                <option <?= ($property["property_parking_spaces"] == 2 ? 'selected' : '') ?> value="2">2 vagas de garagem</option>
                                <option <?= ($property["property_parking_spaces"] == 3 ? 'selected' : '') ?> value="3">3 vagas de garagem</option>
                                <option <?= ($property["property_parking_spaces"] == 4 ? 'selected' : '') ?> value="4">4 vagas de garagem</option>
                                <option <?= ($property["property_parking_spaces"] == 5 ? 'selected' : '') ?> value="5">6 vagas de garagem</option>
                                <option <?= ($property["property_parking_spaces"] == 6 ? 'selected' : '') ?> value="6">6 vagas de garagem</option>
                                <option <?= ($property["property_parking_spaces"] == 7 ? 'selected' : '') ?> value="7">7 vagas de garagem</option>
                                <option <?= ($property["property_parking_spaces"] == 8 ? 'selected' : '') ?> value="8">8 vagas de garagem</option>
                                <option <?= ($property["property_parking_spaces"] == 9 ? 'selected' : '') ?> value="9">9 vagas de garagem</option>
                                <option <?= ($property["property_parking_spaces"] == 10 ? 'selected' : '') ?> value="10">10 vagas de garagem</option>
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="mb-3 col-12">
                            <label for="property_address" class="form-label">Endereço</label>
                            <input value="<?= $property["property_address"] ?>" type="text" class="form-control" name="property_address" placeholder="">
                        </div>


                        <div class="mb-3 col-12">

                            <label for="neighborhood_id" class="form-label">Bairro</label>

                            <select class="form-select neighborhood" name="neighborhood_id">

                                <option value="" disabled selected></option>

                                <?php

                                $last_city = "";

                                foreach ($neighborhoods_cities as $row) { ?>

                                    <?php

                                    if ($last_city !== $row["city_title"]) {
                                        echo "</optgroup>";
                                        echo "<optgroup city_id='{$row["city_id"]}' label='{$row["city_title"]}'>";
                                    } ?>

                                    <option <?= ($property["neighborhood_id"] == $row["neighborhood_id"] ? 'selected' : '') ?> value="<?= $row["neighborhood_id"] ?>">
                                        <?= $row["neighborhood_title"] ?>
                                    </option>

                                    <?php

                                    if ($property["neighborhood_id"] == $row["neighborhood_id"]) {
                                        $city_title = $row["city_title"];
                                    }

                                    $last_city = $row["city_title"];

                                    ?>

                                <?php } ?>
                            </select>

                        </div>

                        <div class="mb-3 col-12">
                            <label for="city_id" class="form-label">Cidade</label>
                            <input value="<?= $city_title ?>" type="text" class="form-control city_show bg-light" disabled name="city_show" placeholder="">
                            <select class="form-select city" style="display: none" name="city_id">
                                <option value="<?= $row["city_id"] ?>" selected></option>
                            </select>
                        </div>

                    </div>

                    <div class="row">
                        <div class="mb-3 col-12">
                            <label for="property_description" class="form-label">Descrição</label>
                            <textarea rows="4" class="form-control" name="property_description"><?= $property["property_description"] ?></textarea>
                        </div>
                    </div>

                    <div class="row">
                        <div class="mb-3 col-12">
                            <label for="property_description" class="form-label">Proximidades (separe por vírgula)</label>
                            <input placeholder="Ex: Padaria, Supermercado, Escola" type="text" class="form-control" name="property_nearby" value="<?= $property["property_nearby"] ?>" />
                        </div>
                    </div>

                    <div class="row">

                        <input type="hidden" id="max_images" value="<?= $_SESSION["real_estate_maximum_pictures_per_property"] ?>">

                        <?php
                        $dir = 'upload/real_estate_' . $_SESSION["real_estate_id"] . '/property_' . $property["property_id"] . "/";
                        $files = scandir($dir); ?>

                        <label for="property_images" class="form-label">Imagens do imóvel (<span class="property_pics_view"><?= count($files) - 2 ?></span>/<?= $_SESSION["real_estate_maximum_pictures_per_property"] ?>)</label>

                        <input type="hidden" name="property_pics" id="property_pics" class="property_pics" value="<?= count($files) - 2 ?>" />

                        <div id="none" style="<?= (count($files) <= 2 ? 'display: block' : 'display: none') ?>">
                            Clique em "Adicionar imagem" para começar a enviar fotos do imóvel
                        </div>


                        <div id="modelo" style="display: none">
                            <div class="py-2 prev col-xs-12 col-sm-3">
                                <div class="">
                                    <label class="clickable">
                                        <img class="image-preview bordered" src="src/img/white.png"></img>
                                        <input style="display:none" name="property_image[]" type="file" class="form-control ps-3 property_images" accept="image/*" />
                                    </label>

                                    <Div class="row my-2">
                                        <div class="col">
                                            <a href="javascript:void(0)" class="text-danger remove-image"><span class="iconify" data-icon="gala:remove"></span> Excluir</a>

                                        </div>

                                        <div class="col text-end me-3">
                                            <a href="javascript:void(0)" class="text-primary set-thumb"><span class="iconify" data-icon="bi:card-image"></span> Destacar</a>

                                        </div>
                                    </Div>
                                </div>
                            </div>
                        </div>

                        <input name="property_thumb" id="property_thumb" type="hidden" value="<?= $property["property_thumb"] ?>" />


                        <div id="remove_images">

                        </div>

                        <div id="change_images">

                        </div>

                        </select>

                        <div id="images" class="row">

                            <?php

                            foreach ($files as $file) {
                                if ($file == "." || $file == "..") {
                                    continue;
                                }

                                $file_code = str_replace(".jpg", "", $file);

                            ?>

                                <div class="py-2 prev prev_f col-xs-12 col-sm-3">
                                    <div class="">


                                        <label class="clickable">
                                            <img class="image-preview <?= ($property["property_thumb"] == $file_code ? 'fixed-image' : '') ?>" src="<?= $dir . $file . "?" . filemtime($dir . $file) ?>"></img>
                                            <input style="display:none" name="property_image[]" type="file" class="form-control ps-3 property_images" accept="image/*" />
                                        </label>

                                        <Div class="row my-2">
                                            <div class="col" <?= ($property["property_thumb"] == $file_code ? 'style="display: none"' : '') ?>>
                                                <a href="javascript:void(0)" class="text-danger remove-image"><span class="iconify" data-icon="gala:remove"></span> Excluir</a>
                                            </div>

                                            <div class="col <?= ($property["property_thumb"] == $file_code ? 'text-center' : 'text-end') ?> me-3">
                                                <a href="javascript:void(0)" class="<?= ($property["property_thumb"] == $file_code ? 'text-success' : 'text-primary') ?> set-thumb">

                                                    <?= ($property["property_thumb"] == $file_code ? '<span class="iconify" data-icon="akar-icons:circle-check"></span> Destacada' : '<span class="iconify" data-icon="bi:card-image"></span> Destacar') ?>

                                                </a>

                                            </div>
                                        </Div>


                                    </div>
                                </div>


                            <?php




                            }

                            ?>

                        </div>

                    </div>

                </div>

                <div class="card-footer bg-light text-end new_property" style="display: block">

                    <div class="row">
                        <div class="col text-start">
                            <a href="javascript:void(0)" class="btn btn-light add-image"><span class="iconify" data-icon="bx:image-add"></span> Adicionar imagem</a>
                        </div>

                        <div class="col">
                            <a href="?property_id=<?= $_GET["property_id"] ?>&delete" class="btn btn-light text-danger delete-property">Excluir imóvel</a>
                            <button type="submit" class="btn btn-primary">Salvar imóvel</button>
                        </div>

                    </div>


                </div>



            </div>

    </form>

<?php
} ?>