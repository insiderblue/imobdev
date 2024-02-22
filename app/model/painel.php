<?php

/** New property */

if ($_POST["new_property"] == true) {

    $code = date('Ymdis');

    $new_property = $pdo->prepare('

    INSERT INTO properties (

        property_area,
        property_area_total,
        property_measure,
        property_bedrooms,
        property_bathrooms,
        property_suites,
        property_parking_spaces,
        property_address,
        neighborhood_id,
        city_id,
        property_price,
        property_description,
        property_type_id,
        property_goal_id,
        property_nearby,

        property_thumb,

        property_public,
        property_fixed,

        real_estate_id
        
        )

        VALUES (

            :property_area,
            :property_area_total,
            :property_measure,
            :property_bedrooms,
            :property_bathrooms,
            :property_suites,
            :property_parking_spaces,
            :property_address,
            :neighborhood_id,
            :city_id,
            :property_price,
            :property_description,
            :property_type_id,
            :property_goal_id,
            :property_nearby,

            :property_thumb,

            :property_public,
            :property_fixed,

            :real_estate_id

        )
    ');

    if ($new_property->execute(
        array(
            'property_area'             => $_POST["property_area"],
            'property_area_total'       => $_POST["property_area_total"],
            'property_measure'          => $_POST["property_measure"],
            'property_bedrooms'         => $_POST["property_bedrooms"],
            'property_bathrooms'        => $_POST["property_bathrooms"],
            'property_suites'           => $_POST["property_suites"],
            'property_parking_spaces'   => $_POST["property_parking_spaces"],
            'property_address'          => $_POST["property_address"],
            'neighborhood_id'           => $_POST["neighborhood_id"],
            'city_id'                   => $_POST["city_id"],
            'property_price'            => $_POST["property_price"],
            'property_description'      => nl2br($_POST["property_description"]),
            'property_type_id'          => $_POST["property_type_id"],
            'property_goal_id'          => $_POST["property_goal_id"],
            'property_nearby'           => $_POST["property_nearby"],

            'property_thumb'            => $code,

            'property_public'           => $_POST["property_public"],
            'property_fixed'            => $_POST["property_fixed"],

            'real_estate_id'            => $_SESSION["real_estate_id"]
        )
    )) {



        $property_id = $pdo->lastInsertId();

        $upload_dir = 'upload/real_estate_' . $_SESSION["real_estate_id"] . '/property_' . $property_id . DIRECTORY_SEPARATOR;

        if (!file_exists($upload_dir)) {
            mkdir($upload_dir, 0777, true);
        }

        $property_pics = $_POST["property_pics"];
        $i = 1;

        while ($i <= $property_pics) {

            $error = array();
            $file_name = $_FILES['property_image']['name'][$i];
            $file_size = $_FILES['property_image']['size'][$i];
            $file_tmp = $_FILES['property_image']['tmp_name'][$i];
            $file_type = $_FILES['property_image']['type'][$i];
            $file_ext = strtolower(end(explode('.', $_FILES['property_image']['name'][$i])));

            $extensions = array("jpeg", "jpg", "png", "gif", "jfif", "bmp" ,"tiff", "exif", "webp");

            if (in_array($file_ext, $extensions) === false) {
                $error[] = "Um dos arquivos enviados não é uma imagem. Por favor envie apenas arquivos de formato .JPEG, .JPG, .PNG e .GIF";
            }

            if ($file_size > 2097152) {
                $error[] = 'Um dos seus arquivos excede o tamanho máximo de 2mb.';
            }

            if ($i > 1) {
                $code = date('Ymdis') + $i;
            }

            if (empty($errors) == true) {
                move_uploaded_file($file_tmp, $upload_dir . $code . ".jpg");
            } else {
            }

            $i++;
        }
    } else {

        $error[] = "Erro desconhecido ao cadastrar o imóvel. Tente novamente e caso o erro persista, entre em contato conosco através do e-mail suporte@aliendev.com.br ou Whatsapp (35) 9 9839-7889.";
    }

    if ($error) {
        $remove_property = $pdo->prepare("DELETE FROM properties WHERE property_id = $property_id");
        $remove_property->execute();
    }

    
}

/** Edit property */

if ($_POST["edit_property"] == true) {


    foreach ($_POST["remove_image"] as $filex) {
        unlink($filex);
    }

    $new_property = $pdo->prepare('

    UPDATE properties 
    
    SET

    property_area           = :property_area,
    property_area_total     = :property_area_total,
    property_measure        = :property_measure,
    property_bedrooms       = :property_bedrooms,
    property_bathrooms      = :property_bathrooms,
    property_suites         = :property_suites,
    property_parking_spaces = :property_parking_spaces,
    property_address        = :property_address,
    neighborhood_id         = :neighborhood_id,
    city_id                 = :city_id,
    property_price          = :property_price,
    property_description    = :property_description,
    property_type_id        = :property_type_id,
    property_goal_id        = :property_goal_id,
    property_public         = :property_public,
    property_fixed          = :property_fixed,
    property_thumb          = :property_thumb,
    property_nearby         = :property_nearby
    
    WHERE property_id = :property_id

    ');

    if ($new_property->execute(
        array(
            'property_area'             => $_POST["property_area"],
            'property_area_total'       => $_POST["property_area_total"],
            'property_measure'          => $_POST["property_measure"],
            'property_bedrooms'         => $_POST["property_bedrooms"],
            'property_bathrooms'        => $_POST["property_bathrooms"],
            'property_suites'           => $_POST["property_suites"],
            'property_parking_spaces'   => $_POST["property_parking_spaces"],
            'property_address'          => $_POST["property_address"],
            'neighborhood_id'           => $_POST["neighborhood_id"],
            'city_id'                   => $_POST["city_id"],
            'property_price'            => $_POST["property_price"],
            'property_description'      => nl2br($_POST["property_description"]),
            'property_type_id'          => $_POST["property_type_id"],
            'property_goal_id'          => $_POST["property_goal_id"],
            'property_public'           => $_POST["property_public"],
            'property_fixed'            => $_POST["property_fixed"],
            'property_thumb'            => $_POST["property_thumb"],
            'property_nearby'           => $_POST["property_nearby"],

            'property_id'               => $_GET["property_id"]
        )
    )) {


        $property_id = $_GET["property_id"];

        $upload_dir = 'upload/real_estate_' . $_SESSION["real_estate_id"] . '/property_' . $property_id . DIRECTORY_SEPARATOR;

        if (!file_exists($upload_dir)) {
            mkdir($upload_dir, 0777, true);
        }

        $the_old = array();
        $the_new = array();

        foreach ($_POST["change_image"] as $fileChange) {

            $old = array_push($the_old, explode('>>>', $fileChange)[0]);
            $new = array_push($the_new, explode('>>>', $fileChange)[1]);

            unlink($upload_dir . $old);
        }


        $property_pics = $_POST["property_pics"];

        $i = 1;

        while ($i <= $property_pics) {

            $error = array();
            $file_name = $_FILES['property_image']['name'][$i];
            $file_size = $_FILES['property_image']['size'][$i];
            $file_tmp = $_FILES['property_image']['tmp_name'][$i];
            $file_type = $_FILES['property_image']['type'][$i];
            $file_ext = strtolower(end(explode('.', $_FILES['property_image']['name'][$i])));

            $extensions = array("jpeg", "jpg", "png", "gif", "jfif", "bmp" ,"tiff", "exif", "webp");

            if (in_array($file_ext, $extensions) === false) {
                $error[] = "Um dos arquivos enviados não é uma imagem. Por favor envie apenas arquivos de formato .JPEG, .JPG, .PNG e .GIF";
            }

            if ($file_size > 2097152) {
                $error[] = 'Um dos seus arquivos excede o tamanho máximo de 2mb.';
            }


            $code = date('Ymdis') + $i;

            foreach ($the_new as $key => $newFile) {

                if ($file_name == $newFile) {

                    $oldName = str_replace(".jpg", "", $the_old[$key]);

                    $code = $oldName;
                }
            }

            if (empty($errors) == true) {
                move_uploaded_file($file_tmp, $upload_dir . $code . ".jpg");
            } else {
            }

            $i++;
        }


        // Ok

    }
}

/**
 * List of properties
 */

$properties = $pdo->prepare('
    SELECT
    a.property_id,
    a.property_address,
    a.neighborhood_id,
    a.city_id,
    a.property_price,
    a.real_estate_id,
    a.property_thumb,
    b.property_goal_title,
    c.property_type_title
    FROM properties a
    INNER JOIN property_goals b ON a.property_goal_id = b.property_goal_id
    INNER JOIN property_types c ON a.property_type_id = c.property_type_id
    WHERE a.real_estate_id = :real_estate_id
    AND property_deleted = :property_deleted
    ORDER BY a.property_id DESC
    ');

$properties->execute(
    array(
        'real_estate_id'    => $_SESSION["real_estate_id"],
        'property_deleted'  => 0
    )
);

$properties = $properties->fetchAll();

$total_properties = count($properties);

/**
 * Specific property
 */

if (isset($_GET["property_id"])) {

    $property = $pdo->prepare('
        SELECT
        a.property_id,
        a.property_address,
        a.city_id,
        a.neighborhood_id,
        REPLACE(a.property_description, "<br />","") property_description,
        a.property_area,
        a.property_area_total,
        a.property_measure,
        a.property_price,
        a.property_bedrooms,
        a.property_bathrooms,
        a.property_suites,
        a.property_parking_spaces,
        a.real_estate_id,
        a.property_thumb,
        a.property_type_id,
        a.property_goal_id,
        a.property_public,
        a.property_fixed,
        a.property_deleted,
        a.property_nearby
        FROM properties a
        INNER JOIN property_goals b ON a.property_goal_id = b.property_goal_id
        INNER JOIN property_types c ON a.property_type_id = c.property_type_id
        WHERE a.real_estate_id = :real_estate_id
        AND property_id = :property_id
        ORDER BY a.property_id DESC
        ');

    $property->execute(
        array(
            'real_estate_id' => $_SESSION["real_estate_id"],
            'property_id' => $_GET["property_id"]
        )
    );

    $property = $property->fetchAll()[0];

    if (isset($_GET["delete"])) {


        $delete_property = $pdo->prepare('UPDATE properties SET property_deleted = :property_deleted WHERE property_id = :property_id AND real_estate_id = :real_estate_id');

        if ($delete_property->execute(
            array(
                'property_id'               => $_GET["property_id"],
                'real_estate_id'            => $_SESSION["real_estate_id"],
                'property_deleted'          => 1
            )
        )) {

            // Deleted 

        }
    }
}


/**
 * List of types of property
 */

$property_types = $pdo->prepare('
SELECT
a.property_type_id,
a.property_type_title
FROM property_types a
WHERE a.real_estate_id = :real_estate_id
');

$property_types->execute(
    array(
        'real_estate_id' => $_SESSION["real_estate_id"]
    )
);

$property_types = $property_types->fetchAll();

$total_property_types = count($property_types);


/**
 * List of goals of property
 */

$property_goals = $pdo->prepare('
SELECT
a.property_goal_id,
a.property_goal_title
FROM property_goals a
WHERE a.real_estate_id = :real_estate_id
');

$property_goals->execute(
    array(
        'real_estate_id' => $_SESSION["real_estate_id"]
    )
);

$property_goals = $property_goals->fetchAll();

$total_property_goals = count($property_goals);


/**
 * List of neighborhoods w/ cities
 */

$neighborhoods_cities = $pdo->prepare('
SELECT
a.neighborhood_id,
a.neighborhood_title,
b.city_id,
b.city_title
FROM neighborhoods a
INNER JOIN cities b ON a.city_id = b.city_id
WHERE a.real_estate_id = :real_estate_id
AND a.neighborhood_deleted = 0
AND b.city_deleted = 0
ORDER BY b.city_title ASC, neighborhood_title ASC
');

$neighborhoods_cities->execute(
    array(
        'real_estate_id' => $_SESSION["real_estate_id"]
    )
);

$neighborhoods_cities = $neighborhoods_cities->fetchAll();



/**
 * List of cities
 */

$cities = $pdo->prepare('
SELECT
a.city_id,
a.city_title
FROM cities a
WHERE a.real_estate_id = :real_estate_id
AND a.city_deleted = 0
ORDER BY a.city_id DESC
');

$cities->execute(
    array(
        'real_estate_id' => $_SESSION["real_estate_id"]
    )
);

$cities = $cities->fetchAll();



/** New city */

if ($_POST["new_city"] == true) {

    $new_city = $pdo->prepare('

    INSERT INTO cities (

        city_title,
        real_estate_id
        
        )

        VALUES (

            :city_title,
            :real_estate_id

        )
    ');

    if ($new_city->execute(
        array(
            'city_title'             => $_POST["city_title"],
            'real_estate_id'         => $_SESSION["real_estate_id"]
        )
    )) {

        header("Refresh:0");
        exit;

    } else {
        $error[] = "Erro desconhecido ao cadastrar cidade. Tente novamente e caso o erro persista, entre em contato conosco através do e-mail suporte@aliendev.com.br ou Whatsapp (35) 9 9839-7889.";
    }

    if ($error) {
    }
}

/**
 * Delete city
 */

if (isset($_GET["city_id"])) {


    if (isset($_GET["delete"])) {


        $delete_city = $pdo->prepare('UPDATE cities SET city_deleted = :city_deleted WHERE city_id = :city_id AND real_estate_id = :real_estate_id');

        if ($delete_city->execute(
            array(
                'city_id'                   => $_GET["city_id"],
                'real_estate_id'            => $_SESSION["real_estate_id"],
                'city_deleted'              => 1
            )
        )) {

            $delete_neighborhoods = $pdo->prepare('UPDATE neighborhoods SET neighborhood_deleted = :neighborhood_deleted WHERE city_id = :city_id AND real_estate_id = :real_estate_id');

            if ($delete_neighborhoods->execute(
                array(
                    'city_id'                   => $_GET["city_id"],
                    'real_estate_id'            => $_SESSION["real_estate_id"],
                    'neighborhood_deleted'      => 1
                )
            )) {

                header('Location: ./?cities&deleted');

            } else {

                header('Location: ./?cities&deleted');

            }

            exit;

        } else {
            $error[] = "Erro desconhecido ao excluir cidade. Tente novamente e caso o erro persista, entre em contato conosco através do e-mail suporte@aliendev.com.br ou Whatsapp (35) 9 9839-7889.";
        }
    }
}


/** New neighborhood */

if ($_POST["new_neighborhood"] == true) {

    $new_neighborhood = $pdo->prepare('

    INSERT INTO neighborhoods (

        neighborhood_title,
        city_id,
        real_estate_id
        
        )

        VALUES (

            :neighborhood_title,
            :city_id,
            :real_estate_id

        )
    ');

    if ($new_neighborhood->execute(
        array(
            'neighborhood_title'        => $_POST["neighborhood_title"],
            'city_id'                   => $_POST["city_id"],
            'real_estate_id'            => $_SESSION["real_estate_id"]
        )
    )) {

        header("Refresh:0");
        exit;

    } else {
        $error[] = "Erro desconhecido ao cadastrar bairro. Tente novamente e caso o erro persista, entre em contato conosco através do e-mail suporte@aliendev.com.br ou Whatsapp (35) 9 9839-7889.";
    }

    if ($error) {
    }
}



/**
 * Delete neighborhood
 */

if (isset($_GET["neighborhood_id"])) {


    if (isset($_GET["delete"])) {


        $delete_neighborhood = $pdo->prepare('UPDATE neighborhoods SET neighborhood_deleted = :neighborhood_deleted WHERE neighborhood_id = :neighborhood_id AND real_estate_id = :real_estate_id');

        if ($delete_neighborhood->execute(
            array(
                'neighborhood_id'                   => $_GET["neighborhood_id"],
                'real_estate_id'                    => $_SESSION["real_estate_id"],
                'neighborhood_deleted'              => 1
            )
        )) {

         header('Location: ./?neighborhoods&deleted');

        
        } else {
            $error[] = "Erro desconhecido ao excluir cidade. Tente novamente e caso o erro persista, entre em contato conosco através do e-mail suporte@aliendev.com.br ou Whatsapp (35) 9 9839-7889.";
        }
    }
}

/**
 * DEV MODE
 */


 // Random properties

 if(isset($_GET["confirm"]) && isset($_GET["dev-random-properties"])) :
    
    $prices = ["100.000,00", "250.000,00", "300.000,00", "350.000,00"];
    $areas = ["100", "200", "250"];

    for ($i = 0; $i < 5; $i++) :

        $data = array(
            'new_property' = 1
            'property_public' => '1',
            'property_fixed' => '1',
            'property_type_id' => $property_types[rand(0,count($property_types))]["property_type_id"],
            'property_goal_id' => $property_goals[rand(0,count($property_goals))]["property_goal_id"],
            'property_price' => $prices[rand(0,count($prices))],
            'property_area_total' => $areas[rand(0,count($areas))],
            'property_measure' => $areas[rand(0,count($areas))],
            'property_bedrooms' => rand(0,4),
            'property_bathrooms' => rand(0,4),
            'property_suites' => rand(0,2),
            'property_parking_spaces' => rand(0,3),
            'property_address' => "Nome da rua",
            'neighborhood_id' => $neighborhoods_cities[rand(0,count($neighborhoods_cities))]["neighborhood_id"],
            'city_id' => $neighborhoods_cities[rand(0,count($neighborhoods_cities))]["city_id"],
            'property_description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas aliquet mi ac nisl semper, at pellentesque risus facilisis. Suspendisse lobortis libero in erat hendrerit, at mollis felis euismod. Quisque a magna placerat, ornare dolor ut, vehicula turpis. Cras aliquam sapien quis ligula molestie, ac dapibus diam commodo. Nulla non pharetra leo. Aenean vulputate vel tellus efficitur viverra. Phasellus faucibus euismod elit sit amet tristique.<br/><br/>Praesent ut cursus sapien. Vestibulum ultrices gravida diam, ac tempus nunc viverra id. Mauris et ullamcorper magna. Phasellus nunc odio, condimentum quis ante a, porttitor volutpat nulla. Nunc eu metus congue, bibendum libero sed, semper mi. Sed vel lorem in turpis aliquam bibendum. Sed quis faucibus lectus. In id velit eu eros dignissim malesuada nec ut risus.',
            'property_nearby' => ''
        );
        $url = 'https://insider.blue/imobdev/';
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        $response = curl_exec($curl);
        curl_close($curl);
        echo $response;

    endfor; 
    
 endif; 