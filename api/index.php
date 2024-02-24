<?php

header("Access-Control-Allow-Origin: *");
header('Content-Type: application/json; charset=utf-8');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../vendor/phpmailer/Exception.php';
require '../vendor/phpmailer/PHPMailer.php';
require '../vendor/phpmailer/SMTP.php';

include("../config.php");

/**
 * Form submission receive
 */

if (isset($_REQUEST["form_submission"])) {

    $real_estate = $pdo->prepare('
    SELECT
    *
    FROM real_estates a
    WHERE a.real_estate_id = ' . $_REQUEST["real_estate_id"] . '
    ');

    $real_estate->execute();

    $real_estate = $real_estate->fetchAll(PDO::FETCH_ASSOC);


    $form_submission_content = "";

    foreach ($_REQUEST["field"] as $key => &$field) {
        $form_submission_content .= "<b>$key:</b><br/>$field<br/><br/>";
    }

    $register_submission = $pdo->prepare('

    INSERT INTO form_submissions (

        form_submission_content,
        real_estate_id
        
        )

        VALUES (

            :form_submission_content,
            :real_estate_id

        )
    ');

    if ($register_submission->execute(
        array(
            'form_submission_content'           => $form_submission_content,
            'real_estate_id'                    => $_REQUEST["real_estate_id"]
        )
    )) {

        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = 'smtp.titan.email';
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = 'STARTTLS';
        $mail->Username = 'forms@insider.blue';
        $mail->Password = 'Insider@27D';
        $mail->Port = 587;
        $mail->CharSet = 'UTF-8';

        $mail->setFrom('forms@insider.blue','Insider Blue');
        $mail->addReplyTo('forms@insider.blue', 'Insider Blue');
        $mail->addAddress($real_estate[0]["real_estate_email"]);

        $mail->isHTML(true);
        $mail->Subject = 'Nova mensagem recebida';
        $mail->Body    = $form_submission_content;

        if (!$mail->send()) {
            echo json_encode('Erro: ' . $mail->ErrorInfo);
        } else {
            echo json_encode('E-mail enviado com sucesso!');
        }

    } else {
        echo json_encode('Erro desconhecido.');
    }

    exit;

}

/**
 * Check cache clear 
 */

 if (isset($_REQUEST["clear_cache"])) {

    $real_estate = $pdo->prepare('
    SELECT
    real_estate_clear_cache
    FROM real_estates a
    WHERE a.real_estate_id = ' . $_REQUEST["real_estate_id"] . '
    ');

    $real_estate->execute();

    $real_estate = $real_estate->fetchAll(PDO::FETCH_ASSOC);

    if($real_estate[0]['real_estate_clear_cache'] == 1) : 
        $cache_clear = $pdo->prepare('UPDATE real_estates SET real_estate_clear_cache = :real_estate_clear_cache WHERE real_estate_id = :real_estate_id');
        $cache_clear->execute(
            array(
                'real_estate_clear_cache'   => 0,
                'real_estate_id'            => $_REQUEST["real_estate_id"]
            )
        );
    endif;

    echo json_encode($real_estate);
}

/**
 * Real estate info
 */

if (isset($_REQUEST["real_estate_info"])) {

    $real_estate = $pdo->prepare('
    SELECT
    *
    FROM real_estates a
    WHERE a.real_estate_id = ' . $_REQUEST["real_estate_id"] . '
    ');

    $real_estate->execute();

    $real_estate = $real_estate->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($real_estate);
}



/**
 * Property types
 */

if (isset($_REQUEST["property_types"])) {

    $property_types = $pdo->prepare('
    SELECT
    a.property_type_id,
    a.property_type_title,
    a.property_type_title_plural,
    a.property_type_title_gender
    FROM property_types a
    INNER JOIN properties b ON a.property_type_id = b.property_type_id
    WHERE a.real_estate_id = ' . $_REQUEST["real_estate_id"] . '
    GROUP BY a.property_type_id, a.property_type_title

    ');

    $property_types->execute();

    $property_types = $property_types->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($property_types);
}


if (isset($_REQUEST["property_types_not_exclude"])) {

    $property_types = $pdo->prepare('
    SELECT
    a.property_type_id,
    a.property_type_title
    FROM property_types a
    WHERE a.real_estate_id = ' . $_REQUEST["real_estate_id"] . '

    ');

    $property_types->execute();

    $property_types = $property_types->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($property_types);
}


/**
 * Property goals
 */

if (isset($_REQUEST["property_goals"])) {

    $property_goals = $pdo->prepare('
    SELECT
    a.property_goal_id,
    a.property_goal_title
    FROM property_goals a
    INNER JOIN properties b ON a.property_goal_id = b.property_goal_id
    WHERE a.real_estate_id = ' . $_REQUEST["real_estate_id"] . '
    GROUP BY a.property_goal_id, a.property_goal_title
    ');

    $property_goals->execute();

    $property_goals = $property_goals->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($property_goals);
}


if (isset($_REQUEST["property_goals_not_exclude"])) {

    $property_goals = $pdo->prepare('
    SELECT
    a.property_goal_id,
    a.property_goal_title
    FROM property_goals a
    WHERE a.real_estate_id = ' . $_REQUEST["real_estate_id"] . '
    ');

    $property_goals->execute();

    $property_goals = $property_goals->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($property_goals);
}


/**
 * Cities
 */

if (isset($_REQUEST["cities"])) {

    $cities = $pdo->prepare('
    SELECT
    a.city_id,
    a.city_title
    FROM cities a
    WHERE a.real_estate_id = ' . $_REQUEST["real_estate_id"] . '
    AND a.city_deleted = 0
    ');

    $cities->execute();

    $cities = $cities->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($cities);
}

/**
 * Neighborhoods
 */

if (isset($_REQUEST["neighborhoods"])) {

    $neighborhoods = $pdo->prepare('
    SELECT
    a.neighborhood_id,
    a.neighborhood_title
    FROM neighborhoods a
    WHERE a.real_estate_id = ' . $_REQUEST["real_estate_id"] . '
    AND a.city_id = ' . $_REQUEST["city_id"] . '
    AND a.neighborhood_deleted = 0
    ');

    $neighborhoods->execute();

    $neighborhoods = $neighborhoods->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($neighborhoods);
}



/**
 * Maximum bedrooms
 */

if (isset($_REQUEST["maximum_bedrooms"])) {

    $maximum_bedrooms = $pdo->prepare('
    SELECT
    a.property_bedrooms
    FROM properties a
    WHERE a.real_estate_id = ' . $_REQUEST["real_estate_id"] . '
    ORDER BY a.property_bedrooms DESC LIMIT 1

    ');

    $maximum_bedrooms->execute();

    $maximum_bedrooms = $maximum_bedrooms->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($maximum_bedrooms);
}


/**
 * Maximum bathrooms
 */

if (isset($_REQUEST["maximum_bathrooms"])) {

    $maximum_bathrooms = $pdo->prepare('
    SELECT
    a.property_bathrooms
    FROM properties a
    WHERE a.real_estate_id = ' . $_REQUEST["real_estate_id"] . '
    ORDER BY a.property_bathrooms DESC LIMIT 1

    ');

    $maximum_bathrooms->execute();

    $maximum_bathrooms = $maximum_bathrooms->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($maximum_bathrooms);
}

/**
 * Maximum suites
 */

if (isset($_REQUEST["maximum_suites"])) {

    $maximum_suites = $pdo->prepare('
    SELECT
    a.property_suites
    FROM properties a
    WHERE a.real_estate_id = ' . $_REQUEST["real_estate_id"] . '
    ORDER BY a.property_suites DESC LIMIT 1

    ');

    $maximum_suites->execute();

    $maximum_suites = $maximum_suites->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($maximum_suites);
}

/**
 * Maximum parking spaces
 */

if (isset($_REQUEST["maximum_parking_spaces"])) {

    $maximum_parking_spaces = $pdo->prepare('
    SELECT
    a.property_parking_spaces
    FROM properties a
    WHERE a.real_estate_id = ' . $_REQUEST["real_estate_id"] . '
    ORDER BY a.property_parking_spaces DESC LIMIT 1

    ');

    $maximum_parking_spaces->execute();

    $maximum_parking_spaces = $maximum_parking_spaces->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($maximum_parking_spaces);
}


/**
 * Fixed properties
 */

if (isset($_REQUEST["fixed_properties"])) {

    $fixed_properties = $pdo->prepare('
    SELECT
    a.property_id,

    a.property_area,
    a.property_area_total,
    a.property_measure,
    a.property_bedrooms,
    a.property_bathrooms,
    a.property_parking_spaces,
    a.property_suites,

    a.property_thumb,
    a.property_price,
    b.city_title as property_city,
    c.neighborhood_title as property_neighborhood,
    d.property_type_title,
    d.property_type_title_gender,
    e.property_goal_title
    FROM properties a
    INNER JOIN cities b ON a.city_id = b.city_id
    INNER JOIN neighborhoods c ON a.neighborhood_id = c.neighborhood_id
    INNER JOIN property_types d ON a.property_type_id = d.property_type_id
    INNER JOIN 
        property_goals e ON a.property_goal_id = e.property_goal_id
        AND a.real_estate_id = e.real_estate_id
    WHERE a.real_estate_id = ' . $_REQUEST["real_estate_id"] . '
    AND a.property_fixed = 1
    AND a.property_deleted = 0
    AND a.property_public = 1
    ');

    $fixed_properties->execute();

    $fixed_properties = $fixed_properties->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($fixed_properties);
}

/**
 * Properties by goal
 */

 if (isset($_REQUEST["properties_by_goal"])) {

    $fixed_properties = $pdo->prepare('
    SELECT
    a.property_id,

    a.property_area,
    a.property_area_total,
    a.property_measure,
    a.property_bedrooms,
    a.property_bathrooms,
    a.property_parking_spaces,
    a.property_suites,

    a.property_thumb,
    a.property_price,
    b.city_title as property_city,
    c.neighborhood_title as property_neighborhood,
    d.property_type_title,
    d.property_type_title_gender,
    e.property_goal_title
    FROM properties a
    INNER JOIN cities b ON a.city_id = b.city_id
    INNER JOIN neighborhoods c ON a.neighborhood_id = c.neighborhood_id
    INNER JOIN property_types d ON a.property_type_id = d.property_type_id
    INNER JOIN property_goals e ON a.property_goal_id = e.property_goal_id
        AND a.real_estate_id = e.real_estate_id
    WHERE a.real_estate_id = ' . $_REQUEST["real_estate_id"] . '
    AND a.property_goal_id = ' . $_REQUEST["property_goal_id"] . '
    AND a.property_deleted = 0
    AND a.property_public = 1
    ');

    $properties->execute();

    $properties = $properties->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($properties);
}

/**
 * Fixed properties by goal
 */

 if (isset($_REQUEST["fixed_properties_by_goal"])) {

    $fixed_properties = $pdo->prepare('
    SELECT
    a.property_id,

    a.property_area,
    a.property_area_total,
    a.property_measure,
    a.property_bedrooms,
    a.property_bathrooms,
    a.property_parking_spaces,
    a.property_suites,

    a.property_thumb,
    a.property_price,
    b.city_title as property_city,
    c.neighborhood_title as property_neighborhood,
    d.property_type_title,
    d.property_type_title_gender,
    e.property_goal_title

    FROM properties a
    INNER JOIN cities b ON a.city_id = b.city_id
    INNER JOIN neighborhoods c ON a.neighborhood_id = c.neighborhood_id
    INNER JOIN property_types d ON a.property_type_id = d.property_type_id
    INNER JOIN property_goals e ON a.property_goal_id = e.property_goal_id
    WHERE a.real_estate_id = ' . $_REQUEST["real_estate_id"] . '
    AND e.real_estate_id = ' . $_REQUEST["real_estate_id"] . '
    AND a.property_goal_id = ' . $_REQUEST["property_goal_id"] . '
    AND a.property_fixed = 1
    AND a.property_deleted = 0
    AND a.property_public = 1
    ');

    $fixed_properties->execute();

    $fixed_properties = $fixed_properties->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($fixed_properties);
}

/**
 * All properties (specific too)
 */


if (isset($_REQUEST["all_properties"])) {

    $search_mysql_friendly = "";

    if (isset($_REQUEST["only_count"])) {

        $fields = '
        
        count(*) as number_of_results

        ';

        $pagination = '';
    } else {

        $fields = '
        
        a.property_id,
        a.property_thumb,
        a.property_price,

        a.property_bedrooms,
        a.property_bathrooms,
        a.property_parking_spaces,
        a.property_area,
        a.property_description,

        a.property_suites,
        a.property_area_total,
        a.property_measure,
        a.property_nearby,

        a.neighborhood_id as property_neighborhood_id,
        a.city_id as property_city_id,
        a.property_goal_id,
        a.property_type_id,

        b.neighborhood_title as property_neighborhood,
        c.city_title as property_city,
        d.property_type_title,
        d.property_type_title_gender,
        e.property_goal_title

        ';

        $pagination = 'LIMIT 12 OFFSET ' . $_REQUEST["offset"] . '';
    }

    if (isset($_REQUEST["search"])) {

        $search = array();

        $params = str_replace('/imobdev/api/?', '', $_SERVER['REQUEST_URI']);

        $params = explode("search", $params)[1];

        parse_str($params, $search);

        foreach ($search as $key => &$row) {

            if ($row == null) {
                continue;
            }

            $sign = "=";
            $t = "";

            if ($key == "property_minimum_price") {
                $sign = ">=";
                $key = "CAST(REPLACE(property_price, '.', '') AS DECIMAL(10,2))";
                $row = str_replace(".", "", $row);
                $row = str_replace(",", ".", $row);
            }

            if ($key == "property_maximum_price") {
                $sign = "<=";
                $key = "CAST(REPLACE(property_price, '.', '') AS DECIMAL(10,2))";
                $row = str_replace(".", "", $row);
                $row = str_replace(",", ".", $row);
            }

            if ($key == "property_type_id") {
                $t = "d.";
            }
            if ($key == "property_goal_id") {
                $t = "e.";
            }
            if ($key == "property_city_id") {
                $t = "b.";
                $key = "city_id";
            }
            if ($key == "property_neighborhood_id") {
                $t = "c.";
                $key = "neighborhood_id";
            }

            $search_mysql_friendly .= " AND $t$key $sign $row";
        }
    }

    

    $query = '

    SELECT

    ' . $fields . '

    FROM properties a
    INNER JOIN neighborhoods b ON a.neighborhood_id = b.neighborhood_id
    INNER JOIN cities c ON a.city_id = c.city_id
    INNER JOIN property_types d ON a.property_type_id = d.property_type_id
    INNER JOIN property_goals e ON a.property_goal_id = e.property_goal_id
    WHERE a.real_estate_id = ' . $_REQUEST["real_estate_id"] . '
    AND a.property_deleted = 0
    AND a.property_public = 1

    ' . $search_mysql_friendly . '
    
    ORDER BY a.property_id DESC

    ' . $pagination . '

    ';


    $all_properties = $pdo->prepare($query);

    $all_properties->execute();

    $all_properties = $all_properties->fetchAll(PDO::FETCH_ASSOC);

    /* 
    $dir = '../upload/real_estate_' . $_REQUEST["real_estate_id"] . '/property_' . $_REQUEST["property_id"] . "/";
    $files = scandir($dir);

    unset($files[0]);
    unset($files[1]);

    $images = "";

    foreach($files as $key=>&$file){
        if($key > 2){ $images .= ","; }
        $images .= $file;
    }

    $all_properties[0]['property_images'] = $images;*/

    echo json_encode($all_properties);
}

/** 
 * Get images of a specific property 
 */


if (isset($_REQUEST["get_images"])) {

    $dir = '../upload/real_estate_' . $_REQUEST["real_estate_id"] . '/property_' . $_REQUEST["property_id"] . "/";

    if (is_dir($dir)) :
        $files = scandir($dir);
        unset($files[0]);
        unset($files[1]);
        if(count($files) == 0) : 
            $files[] = "123.jpg";
            $files[] = "456.jpg";
            $files[] = "789.jpg";
        endif; 
    else: 
        $files[] = "123.jpg";
        $files[] = "456.jpg";
        $files[] = "789.jpg";
    endif; 

    echo json_encode($files);
}
