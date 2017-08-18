<?php
#prerequisite: dpkg -l php5-imagick
$image = new Imagick();
$image->readImage($_GET["image"]);
$file=basename($_GET["image"]);
$urlpart=dirname($_GET["image"]);
$dirs=parse_url($urlpart, PHP_URL_PATH);
$image->motionBlurImage(20, 10, 45, 134217727);
$bgImage = $image->getImageBlob();
echo base64_encode($bgImage);
$image->setImageFormat('jpeg');
mkdir("cache/$dirs", 0774, true);
$image->writeImage("cache$dirs/$file");
$image->clear();
?>

