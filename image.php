<?php 

header("Content-Type: image/jpeg");

// Carrega a imagem original
$original = imagecreatefromjpeg("upload/real_estate_".$_GET["real_estate"].'/property_'.$_GET["property"].'/'.$_GET["thumb"].'.jpg');

// Carrega a marca d'agua
$watermark = imagecreatefrompng("https://insider.blue/imobdev/watermark/".$_GET["real_estate"].".png");

// Obtém as dimensões da imagem original
$original_width = imagesx($original);
$original_height = imagesy($original);

// Obtém as dimensões da marca d'agua
$watermark_width = imagesx($watermark);
$watermark_height = imagesy($watermark);

// Calcula a posição da marca d'agua no centro da imagem original
$pos_x = ($original_width - $watermark_width) / 2;
$pos_y = ($original_height - $watermark_height) / 2;

// Adiciona a marca d'agua à imagem original
imagecopy($original, $watermark, $pos_x, $pos_y, 0, 0, $watermark_width, $watermark_height);

// Salva a imagem com marca d'agua
imagejpeg($original);
imagedestroy($original);
imagedestroy($watermark);

?>