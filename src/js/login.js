$(document).ready(function () {

    $('form').submit(function (e) {

        e.preventDefault();

        var dados = $(this).serialize();

        $('button').addClass('disabled');

        jQuery.ajax({
            type: "POST",
            url: "app/model/login.php?user_login=true",
            data: dados,
            success: function (response) {

                $('button').removeClass('disabled');
                
                if(response == 1){
                    $(".form-control").removeClass('is-invalid');
                    $(".form-control").addClass('is-valid');
                    location.reload();
                } else {
                    $(".form-control").removeClass('is-valid');
                    $(".form-control").addClass('is-invalid');
                }
                
            }
        });


    });


});
