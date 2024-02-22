<div class="container-fluid content-fluid content-web">
    <div class="row">

        <div class="col-md-3 mt-4 fixed-bar-1">

            <div class="card shadow-lg">
                <div class="card-header bg-dark text-white" style="font-size: 19px; font-weight: 600">
                    <span class="iconify" data-icon="akar-icons:link-chain"></span> Menu</a>
                </div>

                <div class="card-body p-0">
                    <a class="btn btn-light w-100 text-start" href="./"><span class="iconify" data-icon="bi:house"></span> Imóveis</a>
                    <a class="btn btn-light w-100 text-start" href="./?cities"><span class="iconify" data-icon="icon-park-outline:city"></span> Cidades</a>
                    <a class="btn btn-light w-100 text-start" href="./?neighborhoods"><span class="iconify" data-icon="bi:pin-map"></span> Bairros</a>
                    <a target="_blank" class="btn btn-light w-100 text-start load-site" href="<?= $_SESSION["real_estate_website"] ?>"><span class="iconify" data-icon="bx:link-external"></span> Site</a>
                </div>
            </div>

            <div class="card shadow-lg mt-3">
                <div class="card-header bg-dark text-white" style="font-size: 19px; font-weight: 600">
                    <span class="iconify" data-icon="entypo:lab-flask"></span> Modo desenvolvedor</a>
                </div>

                <div class="card-body p-0">
                    <a class="btn btn-light w-100 text-start" href="./?dev-random_properties"><span class="iconify" data-icon="fe:random"></span> Cadastrar imóveis aleatórios</a>
                </div>
            </div>



        </div>

        <div class="col-md-9 offset-md-3">

            <?php if (!isset($_GET["property_id"])) {

                $page = "properties";

                if (isset($_GET["cities"])) {
                    $page = "cities";
                }

                if (isset($_GET["neighborhoods"])) {
                    $page = "neighborhoods";
                }

                include("app/view/painel-" . $page . ".php");
            } else {

                include("app/view/painel-property.php");
            } ?>


        </div>


    </div>

</div>

<?php if ($_SESSION["codigo"] == 0) { ?>


    <form id="cadastrarSite" action="cadastrarSite">

        <div class="modal fade" id="mCadastrarSite" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-fullscreen-md-down">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel"><span class="iconify" data-icon="icon-park-outline:web-page"></span> Cadastro de site</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body" style="display: none">

                        <input class="form-control codigo__" type="hidden" name="codigo" />

                        <div class="mb-3 ml-3 btn btn-dark p-1 ps-2 w-100 text-start disabled" style="font-weight: 500">
                            Informações do domínio
                        </div>

                        <div class="mb-3">
                            <label for="dominio">Endereço</label>
                            <input class="form-control gerar_senha" type="text" name="dominio" />
                        </div>

                        <div class="mb-3">
                            <label for="valor_dominio">Valor renovação <span class="text-muted" style="font-size: 14px"> (0.00)</span></label>
                            <input class="form-control" type="text" name="valor_dominio" />
                        </div>

                        <div class="mb-3">
                            <label for="renovacao_dominio">Data renovação <span class="text-muted" style="font-size: 14px"> (mês/ano)</span></label>
                            <input class="form-control" type="text" name="renovacao_dominio" />
                        </div>




                        <div class="mb-3 ml-3 btn btn-dark p-1 ps-2 w-100 text-start disabled mt-3" style="font-weight: 500">
                            Informações do plano
                        </div>

                        <div class="mb-3">
                            <label for="tipo">Tipo</label>
                            <select name="tipo" class="form-select">
                                <?php while ($row = $tipos->fetch()) { ?>
                                    <option value="<?= $row["codigo"] ?>"><?= $row["descricao"] ?> - R$ <?= $row["valor"] ?></option>
                                <?php } ?>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="vencimento">Dia de vencimento <span class="text-muted" style="font-size: 14px"> (Entre os dias 10 e 28)</span></label>
                            <input class="form-control" type="number" name="vencimento" />
                        </div>


                        <div class="mb-3 ml-3 btn btn-dark p-1 ps-2 w-100 text-start disabled mt-3" style="font-weight: 500">
                            Informações do Wordpress
                        </div>

                        <div class="mb-3">
                            <label for="autologin">Autologin</label>
                            <input class="form-control" type="text" name="autologin" />
                        </div>

                        <div class="mb-3 ml-3 btn btn-dark p-1 ps-2 w-100 text-start disabled mt-3" style="font-weight: 500">
                            Informações do cliente e dados de acesso
                        </div>

                        <div class="mb-3">
                            <label for="responsavel">Responsável</label>
                            <input class="form-control" type="text" name="responsavel" />
                        </div>

                        <div class="mb-3">
                            <label for="email">E-mail</label>
                            <input class="form-control" type="email" name="email" />
                        </div>

                        <div class="mb-3">
                            <label for="senha">Senha de acesso</label>
                            <input class="form-control senha_gerada" readonly type="text" name="senha" />
                        </div>

                        <div class="mb-3 link_gerar_senha_nova" style="display: none">
                            <a href="javascript:void(0)" class="gerar_senha_nova">Gerar outra senha</a>
                        </div>

                    </div>
                    <div class="modal-footer" style="display: none">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-dark submit">Salvar</button>
                    </div>
                </div>
            </div>
        </div>

    </form>

<?php } ?>

<!-- Modal -->
<div class="modal fade" id="pagamento" tabindex="-1" aria-labelledby="pagamentoLabel" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen-sm-down">
        <div class="modal-content">
            <div class="modal-header" style="height: 60px">

                <div id="generating" style="display: none">
                    <div class="d-flex align-items-center">
                        <div class="spinner-border ms-auto" role="status" aria-hidden="true"></div>
                        <strong>  Carregando fatura...</strong>
                    </div>
                </div>

                <div id="generated" style="display: none">
                    <strong>Fatura nº <span id="numero_fatura"></span></strong>
                </div>

                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div id="payment" style="display: none">



                <div class="modal-body">

                    <div id="payment-pending" style="display: none">
                        <div class="mb-3 text-center">
                            <img src="" id="qrcode_img" style="width: 250px">
                        </div>

                        <div class="mb-3 text-center">
                            <span style="font-weight: 500">Leia o código acima com o seu celular ou se preferir copie e cole o código abaixo no app do seu banco:</span>
                        </div>

                        <div class="mb-3 text-center">
                            <textarea rows="3" id="codigo_pix" class="form-control mt-1"></textarea>
                        </div>

                        <div class="mb-1 text-center">
                            <span style="font-size: 30px; font-weight: 650" class="mb-4">R$ <span id="valor_fatura"></span></span><br />
                            Esta fatura vence em <b><span id="vencimento_fatura"></span></b>
                        </div>
                    </div>


                    <div id="payment-success" style="display: none">
                        <div class="mb-1">

                            <b>Site:</b> <span id="site_fatura"></span><br />
                            <b>Valor:</b> R$ <span id="valor_fatura_paga"></span><br />
                            <b>Vencimento:</b> <span id="vencimento_fatura_paga"></span><br />
                            <b>Situação:</b> Pago
                        </div>
                    </div>


                </div>


                <?php if ($_SESSION["codigo"] == 0) { ?>
                    <div class="modal-footer d-flex justify-content-center">

                        <div class="form-check form-switch ">
                            <input class="form-check-input" type="checkbox" id="paymentStatus">
                            <label class="form-check-label" for="paymentStatus"> Pagamento recebido</label>
                        </div>
                    </div>
                <?php } ?>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary w-100" data-bs-dismiss="modal">Pronto</button>
                </div>
            </div>

        </div>
    </div>
</div>