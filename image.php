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

// Define a largura desejada da marca d'água
$desired_width = 300;

// Calcula a proporção da largura da marca d'água em relação à largura original
$scale = $desired_width / imagesx($watermark);

// Calcula a nova altura da marca d'água mantendo a proporção
$desired_height = imagesy($watermark) * $scale;

// Redimensiona a marca d'água para a largura desejada e altura proporcional
$watermark_resized = imagescale($watermark, $desired_width, $desired_height);

// Obtém as dimensões da imagem original
$original_width = imagesx($original);
$original_height = imagesy($original);

// Calcula a posição da marca d'água no centro da imagem original
$pos_x = ($original_width - $desired_width) / 2;
$pos_y = ($original_height - $desired_height) / 2;

// Adiciona a marca d'água à imagem original
imagecopy($original, $watermark_resized, $pos_x, $pos_y, 0, 0, $desired_width, $desired_height);

// Exibe a imagem com marca d'água
imagejpeg($original);
imagedestroy($original);
imagedestroy($watermark_resized);

?>
