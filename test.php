<?php   
$source_image = imagecreatefromjpeg("https://lorempixel.com/800/600");
$source_imagex = imagesx($source_image);
$source_imagey = imagesy($source_image);
$dest_imagex = 400;
$dest_imagey = 400;
$dest_image = imagecreatetruecolor($dest_imagex, $dest_imagey);
imagecopyresampled($dest_image, $source_image, 0, 0, 0, 0, $dest_imagex, 
$dest_imagey, 400, 400);
header("Content-Type: image/jpeg");
imagejpeg($dest_image,NULL,80);
?>