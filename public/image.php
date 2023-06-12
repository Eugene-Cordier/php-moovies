<?php


declare(strict_types=1);

use Entity\Image;

$imageId=$_GET['imageId'];
$image=Image::findbyId((int)$imageId);
echo $image->getJpeg();



