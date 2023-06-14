<?php


declare(strict_types=1);

use Entity\Movie;
use Entity\Exception\EntityNotFoundException;
use Exception\ParameterException;

try {
    if(!(isset($_GET['movieId'])) || !(ctype_digit($_GET['movieId']))) {
        throw new ParameterException("parametre non valide");
    } else {
        $movie= Movie::findById((int)$_GET['movieId']);
        $movie->delete();
        header("location:../index.php", true, 302);
    }
} catch (ParameterException) {
    http_response_code(400);
} catch (EntityNotFoundException) {
    http_response_code(404);
} catch (Exception) {
    http_response_code(500);
}
