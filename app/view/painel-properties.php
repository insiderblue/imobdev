<?php if ($error) { ?>
    <div class="card text-white bg-danger shadow-lg mt-4">
        <div class="card-header">
            Erro ao enviar imagens
        </div>
        <div class="card-b  ody">
            <?php foreach ($error as $key => &$row) {
                $i = $key + 1;
                echo $i . " - " . $row . "<BR/>";
            } ?>
        </div>
    </div>
<?php } ?>


<?php if ($total_properties <= @$_SESSION["real_estate_maximum_properties"]) { ?>

    <form method="post" enctype="multipart/form-data">

        <input type="hidden" name="new_property" value="true" />

        <div class="card text-white bg-secondary shadow-lg mt-4">

            <div class="card-header toggle_content" content="new_property" style="font-size: 19px; font-weight: 600; cursor: pointer">
                <span class="iconify" data-icon="fa6-solid:house-chimney-medical"></span> Cadastrar imóvel
            </div>

            <div class="card-body bg-white text-dark new_property p-4" style="display: none">

                <div class="row">

                    <div class="mb-3 col-12">

                        <label for="property_public" class="form-label">Visibilidade do imóvel no site</label>

                        <select class="form-select" name="property_public">

                            <option selected value="1">
                                Imóvel visível
                            </option>

                            <option value="0">
                                Imóvel oculto
                            </option>

                        </select>
                    </div>

                    <div class="mb-3 col-12">

                        <label for="property_fixed" class="form-label">Imóvel fixado</label>

                        <select class="form-select" name="property_fixed">


                            <option selected value="0">
                                Não
                            </option>

                            <option value="1">
                                Sim
                            </option>


                        </select>
                    </div>


                    <div class="mb-3 col-sm-12">
                        <label for="property_type_id" class="form-label">Tipo de imóvel</label>

                        <select class="form-select" name="property_type_id">
                            <?php

                            foreach ($property_types as $row) { ?>

                                <option value="<?= $row["property_type_id"] ?>">
                                    <?= $row["property_type_title"] ?>
                                </option>

                            <?php } ?>
                        </select>
                    </div>

                    <div class="mb-3 col-sm-12">
                        <label for="property_goal_id" class="form-label">Finalidade</label>

                        <select class="form-select" name="property_goal_id">
                            <?php

                            foreach ($property_goals as $row) { ?>

                                <option value="<?= $row["property_goal_id"] ?>">
                                    <?= $row["property_goal_title"] ?>
                                </option>

                            <?php } ?>
                        </select>
                    </div>

                    <div class="mb-3 col-sm-12">
                        <label for="property_price" class="form-label">Valor (R$)</label>
                        <input type="text" class="form-control js-mask-money" name="property_price">
                    </div>

                </div>

                <div class="row">
                    <div class="col-12">
                        <div class="mb-3 col-12">
                            <label for="property_area" class="form-label">Área construída</label>
                            <input type="number" class="form-control" name="property_area">
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="mb-3 col-12">
                            <label for="property_area_total" class="form-label">Área do terreno</label>
                            <input type="number" class="form-control" name="property_area_total">
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="mb-3 col-12">
                            <label for="property_measure" class="form-label">Unidade de medida</label>
                            <select class="form-select" name="property_measure">
                                <option value="m²">Metro quadrado (m²)</option>
                                <option value="a">Are (a)</option>
                                <option value="ha">Hectare (ha)</option>
                                <option value="ca">Centiare (ca)</option>
                                <option value="alq">Alqueire (alq)</option>
                            </select>
                        </div>
                    </div>

                </div>

                <div class="row">
                    <div class="mb-3 col-12">
                        <label for="property_bedrooms" class="form-label">Quartos</label>
                        <select class="form-select" name="property_bedrooms">
                            <option value="0">Nenhum quarto</option>
                            <option value="1">1 quarto</option>
                            <option value="2">2 quartos</option>
                            <option value="3">3 quartos</option>
                            <option value="4">4 quartos</option>
                            <option value="5">6 quartos</option>
                            <option value="6">6 quartos</option>
                            <option value="7">7 quartos</option>
                            <option value="8">8 quartos</option>
                            <option value="9">9 quartos</option>
                            <option value="10">10 quartos</option>
                        </select>
                    </div>
                    <div class="mb-3 col-12">
                        <label for="property_bathrooms" class="form-label">Banheiros</label>
                        <select class="form-select" name="property_bathrooms">
                            <option value="0">Nenhum banheiro</option>
                            <option value="1">1 banheiro</option>
                            <option value="2">2 banheiros</option>
                            <option value="3">3 banheiros</option>
                            <option value="4">4 banheiros</option>
                            <option value="5">6 banheiros</option>
                            <option value="6">6 banheiros</option>
                            <option value="7">7 banheiros</option>
                            <option value="8">8 banheiros</option>
                            <option value="9">9 banheiros</option>
                            <option value="10">10 banheiros</option>
                        </select>
                    </div>
                    <div class="mb-3 col-12">
                        <label for="property_suites" class="form-label">Suítes</label>
                        <select class="form-select" name="property_suites">
                            <option value="0">Nenhuma suíte</option>
                            <option value="1">1 suíte</option>
                            <option value="2">2 suítes</option>
                            <option value="3">3 suítes</option>
                            <option value="4">4 suítes</option>
                            <option value="5">6 suítes</option>
                            <option value="6">6 suítes</option>
                            <option value="7">7 suítes</option>
                            <option value="8">8 suítes</option>
                            <option value="9">9 suítes</option>
                            <option value="10">10 suítes</option>
                        </select>
                    </div>
                    <div class="mb-3 col-12">
                        <label for="property_parking_spaces" class="form-label">Vagas de garagem</label>
                        <select class="form-select" name="property_parking_spaces">
                            <option value="0">Nenhuma vaga de garagem</option>
                            <option value="1">1 vaga de garagem</option>
                            <option value="2">2 vagas de garagem</option>
                            <option value="3">3 vagas de garagem</option>
                            <option value="4">4 vagas de garagem</option>
                            <option value="5">6 vagas de garagem</option>
                            <option value="6">6 vagas de garagem</option>
                            <option value="7">7 vagas de garagem</option>
                            <option value="8">8 vagas de garagem</option>
                            <option value="9">9 vagas de garagem</option>
                            <option value="10">10 vagas de garagem</option>
                        </select>
                    </div>
                </div>

                <div class="row">

                    <div class="mb-3 col-12">
                        <label for="property_address" class="form-label">Endereço <span class="text-danger">*</span></label>
                        <input required type="text" class="form-control" name="property_address" placeholder="">
                    </div>

                    <div class="mb-3 col-12">

                        <label for="neighborhood_id" class="form-label">Bairro <span class="text-danger">*</span></label>

                        <select required class="form-select neighborhood" name="neighborhood_id">

                            <option value="" disabled selected></option>

                            <?php

                            $last_city = "";

                            foreach ($neighborhoods_cities as $row) { ?>

                                <?php

                                if ($last_city !== $row["city_title"]) {
                                    echo "</optgroup>";
                                    echo "<optgroup city_id='{$row["city_id"]}' label='{$row["city_title"]}'>";
                                } ?>

                                <option value="<?= $row["neighborhood_id"] ?>">
                                    <?= $row["neighborhood_title"] ?>
                                </option>

                                <?php

                                $last_city = $row["city_title"];

                                ?>

                            <?php } ?>
                        </select>

                    </div>

                    <div class="mb-3 col-12">
                        <label for="city_id" class="form-label">Cidade <span class="text-danger">*</span></label>
                        <input type="text" class="form-control city_show bg-light" disabled name="city_show" placeholder="">
                        <select required class="form-select city" style="display: none" name="city_id">
                        </select>
                    </div>




                </div>

                <div class="row">
                    <div class="mb-3 col-12">
                        <label for="property_description" class="form-label">Descrição</label>
                        <textarea rows="4" class="form-control" name="property_description"></textarea>
                    </div>
                </div>

                <div class="row">
                    <div class="mb-3 col-12">
                        <label for="property_description" class="form-label">Proximidades (separe por vírgula)</label>
                        <input placeholder="Ex: Padaria, Supermercado, Escola" type="text" class="form-control" name="property_nearby" />
                    </div>
                </div>

                <div class="row">

                    <input type="hidden" id="max_images" value="<?= $_SESSION["real_estate_maximum_pictures_per_property"] ?>">

                    <label for="property_images" class="form-label">Imagens do imóvel (<span class="property_pics_view">0</span>/<?= $_SESSION["real_estate_maximum_pictures_per_property"] ?>)</label>

                    <input type="hidden" name="property_pics" id="property_pics" value="0" class="property_pics" />


                    <div id="none">
                        <span class="text-danger">* Ao menos uma foto deve ser adicionada. Clique em "Adicionar imagem".</span>
                    </div>


                    <div id="modelo" style="display: none">
                        <div class="py-2 prev col-12">
                            <div class="">
                                <label class="clickable">
                                    <img class="image-preview fixed-image bordered" src="src/img/white.png"></img>
                                    <input style="display:none" name="property_image[]" type="file" class="form-control ps-3 property_images" accept="image/*" />
                                </label>

                                <Div class="row my-2">
                                    <div class="col text-center">
                                        <a href="javascript:void(0)" class="text-danger remove-image"><span class="iconify" data-icon="gala:remove"></span> Excluir</a>

                                    </div>


                                </Div>

                            </div>
                        </div>
                    </div>

                    <div id="images" class="row">

                    </div>


                </div>

            </div>


            <div class="card-footer bg-light text-end new_property" style="display: none">

                <div class="row">
                    <div class="col text-start">
                        <a href="javascript:void(0)" class="btn btn-light add-image"><span class="iconify" data-icon="bx:image-add"></span> Adicionar imagem</a>

                    </div>
                    <div class="col">
                        <button type="submit" class="btn btn-primary">Cadastrar imóvel</button>

                    </div>
                </div>


            </div>

        </div>

    </form>
<?php } else { ?>


    <div class="card text-white bg-secondary shadow-lg mt-4">

        <div class="card-header toggle_content" content="new_property" style="font-size: 19px; font-weight: 600; cursor: pointer">
            <span class="iconify" data-icon="fa6-solid:house-chimney-medical"></span> Cadastrar imóvel
        </div>

        <div class="card-body bg-white text-dark new_property p-4" style="display: none">
            O número máximo de imóveis do seu plano foi atingido. Realize o upgrade para poder adicionar mais.
        </div>

    </div>

<?php } ?>

<div class="card text-white bg-secondary shadow-lg mt-4">
    <div class="card-header toggle_content" content="properties" style="font-size: 19px; font-weight: 600; cursor: pointer">
        <span class="iconify" data-icon="fa6-solid:house-chimney"></span> Imóveis cadastrados (<?= ($total_properties == 0 ? 0 : $total_properties) ?>/<?= @$_SESSION["real_estate_maximum_properties"] ?>)
    </div>
</div>

<div class="row properties">
    <?php

    foreach ($properties as $row) {
    ?>

        <div class="col-sm-3">

            <div class="card shadow-lg mt-4">

                <?php

                /*
                if ($row["property_thumb"] !== NULL) {
                    $path = "upload/real_estate_" . $row['real_estate_id'] . "/property_" . $row["property_id"] . "/" . $row["property_thumb"] . ".jpg";
                    $thumb = $path . "?" . filemtime($path);
                } else {
                    $dir = 'upload/real_estate_' . $_SESSION["real_estate_id"] . '/property_' . $row["property_id"] . "/";
                    $thumb = scandir($dir)[2];
                    $thumb = $dir . $thumb;
                }*/

                $path = "upload/real_estate_" . $row['real_estate_id'] . "/property_" . $row["property_id"] . "/" . $row["property_thumb"] . ".jpg";
                $thumb = $path . "?" . filemtime($path);

                ?>

                <div class="card-header p-0">
                    <input readonly disabled style="font-weight: 500" type="text" class="form-control p-2" value="<?= $row["property_type_title"] ?> - <?= $row["property_goal_title"] ?> (<?= $row["property_id"] ?>)" />
                </div>
                <div class="card-body p-0">
                    <img style="object-fit: cover; width: 100%; height: 180px" src="<?= $thumb ?>"></img>
                </div>



                <div class="card-footer py-0">
                    <div class="row">
                        <a href="?property_id=<?= $row["property_id"] ?>&delete" class="col btn btn-light text-danger w-100 p-2 delete-property">Excluir</a>
                        <a href="?property_id=<?= $row["property_id"] ?>" class="col btn btn-light w-100 p-2">Editar</a>
                    </div>
                </div>



            </div>



        </div>


    <?php } ?>
</div>