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

// Define a largura e a altura desejadas para a imagem final
$desired_width = 900;
$desired_height = 400;

// Obtém as dimensões da imagem original
$original_width = imagesx($original);
$original_height = imagesy($original);

// Calcula as proporções da imagem original
$original_aspect_ratio = $original_width / $original_height;
$desired_aspect_ratio = $desired_width / $desired_height;

// Define as coordenadas e as dimensões da parte da imagem a ser copiada
$src_x = 0;
$src_y = 0;
$src_width = $original_width;
$src_height = $original_height;

// Se a imagem original não for proporcional à imagem desejada
if ($original_aspect_ratio != $desired_aspect_ratio) {
    if ($original_aspect_ratio > $desired_aspect_ratio) {
        // A imagem original é mais larga, então ajustamos a largura e recalculamos a altura
        $src_width = $original_height * $desired_aspect_ratio;
        $src_x = ($original_width - $src_width) / 2;
    } else {
        // A imagem original é mais alta, então ajustamos a altura e recalculamos a largura
        $src_height = $original_width / $desired_aspect_ratio;
        $src_y = ($original_height - $src_height) / 2;
    }
}

// Cria uma nova imagem com as dimensões desejadas
$new_image = imagecreatetruecolor($desired_width, $desired_height);

// Copia e redimensiona a parte relevante da imagem original para a nova imagem
imagecopyresampled($new_image, $original, 0, 0, $src_x, $src_y, $desired_width, $desired_height, $src_width, $src_height);

// Define a largura desejada da marca d'água
$watermark_width = 300;

// Calcula a proporção da largura da marca d'água em relação à largura original
$scale = $watermark_width / imagesx($watermark);

// Calcula a nova altura da marca d'água mantendo a proporção
$watermark_height = imagesy($watermark) * $scale;

// Redimensiona a marca d'água para a largura desejada e altura proporcional
$watermark_resized = imagescale($watermark, $watermark_width, $watermark_height);

// Calcula a posição da marca d'água no centro da nova imagem
$pos_x = ($desired_width - $watermark_width) / 2;
$pos_y = ($desired_height - $watermark_height) / 2;

// Adiciona a marca d'água à nova imagem
imagecopy($new_image, $watermark_resized, $pos_x, $pos_y, 0, 0, $watermark_width, $watermark_height);

// Exibe a nova imagem com marca d'água
imagejpeg($new_image);
imagedestroy($original);
imagedestroy($watermark_resized);
imagedestroy($new_image);
?>
