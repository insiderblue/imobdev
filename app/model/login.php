<?php

if(@$_REQUEST["user_login"]) {

    include("../../config.php");

    $user_username = strtolower(@$_REQUEST["user_username"]);
    $user_password = strtolower(@$_REQUEST["user_password"]);

    $stmt = $pdo->prepare('
    SELECT
    a.user_id,
    b.real_estate_id,
    b.real_estate_name,
    b.real_estate_maximum_pictures_per_property,
    b.real_estate_maximum_properties,
    b.real_estate_website
    FROM users a
    INNER JOIN real_estates b ON a.real_estate_id = b.real_estate_id
    WHERE 
        a.user_username = :user_username
        AND a.user_password = md5(:user_password)
    ');
    $stmt->execute(
        array(
            'user_username' => $user_username,
            'user_password' => $user_password
        )
    );

    $response = false;
    
    while ($row = $stmt->fetch()) {

        $_SESSION["user_authenticated"] = TRUE;
        $_SESSION["user_id"] = $row['user_id'];
        $_SESSION["real_estate_id"] = $row['real_estate_id'];
        $_SESSION["real_estate_name"] = $row['real_estate_name'];
        $_SESSION["real_estate_maximum_pictures_per_property"] = $row['real_estate_maximum_pictures_per_property'];
        $_SESSION["real_estate_maximum_properties"] = $row['real_estate_maximum_properties'];
        $_SESSION["real_estate_website"] = $row['real_estate_website'];

        $response = true;

    }

    echo $response;

    exit;
    
}
