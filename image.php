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

// Carrega a marca d'água
$watermark = imagecreatefrompng("https://insider.blue/imobdev/watermark/".$_GET["real_estate"].".png");

// Obtém as dimensões da imagem original
$original_width = imagesx($original);
$original_height = imagesy($original);

// Obtém as dimensões da marca d'água
$watermark_width = imagesx($watermark);
$watermark_height = imagesy($watermark);

// Calcula a posição da marca d'água no centro da imagem original
$pos_x = ($original_width - $watermark_width) / 2;
$pos_y = ($original_height - $watermark_height) / 2;

// Adiciona a marca d'água à imagem original
imagecopy($original, $watermark, $pos_x, $pos_y, 0, 0, $watermark_width, $watermark_height);

// Exibe a imagem com marca d'água
imagejpeg($original);
imagedestroy($original);
imagedestroy($watermark);

?>
