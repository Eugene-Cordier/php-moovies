<?php

declare(strict_types=1);
use Entity\Image;
use Entity\Exception\EntityNotFoundException;
use Exception\ParameterException;

try {
    if ($_GET["ImageId"]==null) {
        if ($_GET["Type"]=="Movie") {
            header("location:../img/defaultcover.png");
        } else {
            header("location:../img/defaultactor.png");
        }
    } else {
        if ((!ctype_digit($_GET["ImageId"])) || !isset($_GET["ImageId"])) {
            throw new ParameterException("Le paramètre n'est pas valide");
        }

        $cover=Image::findById((int)$_GET["ImageId"]);
        header('Content-Type: image/jpeg');
        echo $cover->getJpeg();
    }
} catch (ParameterException) {
    http_response_code(400);
} catch (EntityNotFoundException) {
    http_response_code(404);
} catch (Exception) {
    http_response_code(500);
}
