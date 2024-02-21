$(document).ready(function () {

    // Mask
    $('.js-mask-money').mask('000.000.000.000.000,00', {reverse: true}).prepend("R$ ");

    $(".action-logout").click(function () {
        $.post("app/controller/logout.php", function () {

            window.location.href = "./";

        });
    });


    $(".money_format").keyup(function () {
        $(this).val(moneyFormat($(this).val()));
    });


    $(".toggle_content").click(function () {

        $("." + $(this).attr('content')).slideToggle();

    });


    $(document).on('change', '.property_images', function () {

        index = $(this).parent().parent().parent().index() + 1;

        image = '.image-preview';

        if ($("#edit_property").val()) {

            if ($(".prev").eq(index).hasClass('prev_f')) {

                old = $(image).eq(index).attr('src').split("/")[3];
                old = old.split("?")[0];

            }

        }

        var file = $(".property_images").get(index).files[0];

        getBase64(file).then(data => $(image).eq(index).attr('src', data));

        $(image).eq(index).removeClass('bordered');

        if ($("#edit_property").val()) {
            $("#change_images").append('<input value="' + old + '>>>' + file.name + '" type="hidden" name="change_image[]">');
        }

    });

    $(document).on('click', '.set-thumb', function () {

        ref = $(this).parent().parent().index() - 1;

        $("#property_cover").val(ref);

    });

    $(".add-image").click(function () {

        qty = parseInt($(".property_pics").val());

        if (parseInt($("#max_images").val()) > qty) {

            $("#images").append(function () {


                $(".property_pics").val(qty + 1);
                $(".property_pics_view").text(qty + 1);

                qty = parseInt($(".property_pics").val());

                if (qty == 0) {
                    $("#none").show();
                } else {
                    $("#none").hide();
                }

                return $('#modelo').html();

            });

        } else {

            alert('O seu plano permite apenas 10 imagens por imóvel. Contrate um novo plano para conseguir adicionar mais imagens a este imóvel.');

        }

    });

    $(".delete-property").click(function () {});

    $(document).on('click', '.remove-image', function () {

        qty = parseInt($(".property_pics").val());

        $(".property_pics").val(qty - 1);
        $(".property_pics_view").text(qty - 1);

        index = $(this).parent().parent().parent().parent().index() + 1;

        $(".prev").eq(index).remove();

        qty = parseInt($(".property_pics").val());

        if (qty == 0) {
            $("#none").show();
        } else {
            $("#none").hide();
        }

        src = $(this).parent().parent().parent().find('img').attr('src').split('?')[0];

        if ($("#edit_property").val()) {
            $("#remove_images").append('<input value="' + src + '" type="hidden" name = "remove_image[]">');
        }

    });

    $(document).on('click', '.set-thumb', function () {

        src = $(this).parent().parent().parent().find('img').attr('src').split('?')[0];
        src = src.split('/')[3];
        src = src.split('.')[0];

        $(".image-preview").removeClass('fixed-image');
        $('.remove-image').parent().show();
        $('.set-thumb').html('<span class="iconify" data-icon="bi:card-image"></span> Destacar');
        $('.set-thumb').removeClass('text-success');
        $('.set-thumb').addClass('text-primary');
        $('.set-thumb').parent().addClass('text-end');
        $('.set-thumb').parent().removeClass('text-center');

            $(this).parent().parent().parent().find('img').addClass('fixed-image');

            $(this).parent().parent().parent().find('.remove-image').parent().hide();
            $(this).parent().parent().parent().find('.set-thumb').parent().removeClass('text-end');
            $(this).parent().parent().parent().find('.set-thumb').parent().addClass('text-center');
            $(this).parent().parent().parent().find('.set-thumb').html('<span class="iconify" data-icon="akar-icons:circle-check"></span> Destacada');
            $(this).parent().parent().parent().find('.set-thumb').addClass('text-success');
            $(this).parent().parent().parent().find('.set-thumb').removeClass('text-primary');

            

            $("#property_thumb").val(src);



    });

    $(".neighborhood").change(function () {

        var city_title  = $('.neighborhood :selected').parent().attr('label');
        var city_id     = $('.neighborhood :selected').parent().attr('city_id');

        $(".city").html("<option value='"+city_id+"' selected>"+city_title+"</option>");
        $(".city_show").val(city_title);

        
    });

    $(".delete-property").click(function () {

        return confirm('ATENÇÃO! \n \nEste imóvel será excluído permanentemente. Caso queira apenas ocultá-lo do site, altere a visibilidade do imóvel ao invés de deletá-lo.  \n \nApenas clique em \'OK\' caso queira realmente excluir o imóvel.');

    });

    $('.delete-property').bind('contextmenu', function (e) {
        return false;
    });

    $(".delete-city").click(function () {

        return confirm('ATENÇÃO! \n \nEsta cidade será excluída permanentemente. \n \nConsequentemente todos os bairros atrelados a ela serão excluídos e os imóveis ficarão sem a localização. \n \nApenas clique em \'OK\' caso queira realmente excluir a cidade.');

    });

    $('.delete-city').bind('contextmenu', function (e) {
        return false;
    });

});


function getBase64(file) {
    return new Promise((resolve, reject) => {
        const reader = new FileReader();
        reader.readAsDataURL(file);
        reader.onload = () => resolve(reader.result);
        reader.onerror = error => reject(error);
    });
}

function moneyFormat(val) {

    if (val == 0) {

        valor = '0,00';

    } else {

        var valor = val;

        valor = valor + '';
        valor = parseInt(valor.replace(/[\D]+/g, ''));
        valor = valor + '';
        valor = valor.replace(/([0-9]{2})$/g, ",$1");

        if (valor.length > 6) {
            valor = valor.replace(/([0-9]{3}),([0-9]{2}$)/g, ".$1,$2");
        }

       
    }


    return valor;
}
