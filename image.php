<?php

header("Content-Type: image/jpeg");

// Tente criar a imagem com marca d'água
$original = imagecreatefromjpeg("upload/real_estate_".$_GET["real_estate"].'/property_'.$_GET["property"].'/'.$_GET["thumb"].'.jpg');
if (!$original) {
    // Se ocorrer um erro, envie cabeçalhos de imagem e exiba a imagem padrão
    header("Content-Type: image/jpeg");
    readfile("https://insider.blue/imobdev/no-picture.jpg");
    exit; // Saia do script após exibir a imagem
}

// Cria uma nova imagem com as dimensões desejadas (900x400)
$new_width = 900;
$new_height = 400;
$new_image = imagecreatetruecolor($new_width, $new_height);

// Preenche a nova imagem com a cor branca
$white = imagecolorallocate($new_image, 255, 255, 255);
imagefill($new_image, 0, 0, $white);

// Calcula as dimensões da imagem original mantendo a proporção
$original_width = imagesx($original);
$original_height = imagesy($original);
$aspect_ratio = $original_width / $original_height;
$new_aspect_ratio = $new_width / $new_height;

if ($aspect_ratio > $new_aspect_ratio) {
    // A imagem original é mais larga, então ajustamos a largura e recalculamos a altura
    $resized_width = $new_width;
    $resized_height = $new_width / $aspect_ratio;
} else {
    // A imagem original é mais alta ou tem proporção igual, então ajustamos a altura e recalculamos a largura
    $resized_height = $new_height;
    $resized_width = $new_height * $aspect_ratio;
}

// Calcula as coordenadas para centralizar a imagem redimensionada
$offset_x = ($new_width - $resized_width) / 2;
$offset_y = ($new_height - $resized_height) / 2;

// Redimensiona a imagem original e a coloca na nova imagem
imagecopyresampled($new_image, $original, $offset_x, $offset_y, 0, 0, $resized_width, $resized_height, $original_width, $original_height);

// Carrega a marca d'água
$watermark = imagecreatefrompng("https://insider.blue/imobdev/watermark/".$_GET["real_estate"].".png");

// Define a largura fixa da marca d'água para 200px
$watermark_width = 200;

// Obtém a altura da marca d'água mantendo a proporção
$watermark_height = imagesy($watermark) * ($watermark_width / imagesx($watermark));

// Calcula as coordenadas para posicionar a marca d'água no centro
$pos_x = ($new_width - $watermark_width) / 2;
$pos_y = ($new_height - $watermark_height) / 2;

// Adiciona a marca d'água à nova imagem
imagecopyresampled($new_image, $watermark, $pos_x, $pos_y, 0, 0, $watermark_width, $watermark_height, imagesx($watermark), imagesy($watermark));

// Exibe a nova imagem com marca d'água
imagejpeg($new_image);
imagedestroy($original);
imagedestroy($watermark);
imagedestroy($new_image);
?>
