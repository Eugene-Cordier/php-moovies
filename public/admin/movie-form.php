<?php


declare(strict_types=1);

use Entity\Movie;
use Entity\Exception\EntityNotFoundException;
use Exception\ParameterException;
use Html\Form\MovieForm;

try {
    if (!isset($_GET['moviesId'])) {
        $movie=null;
    } else {
        if(!ctype_digit($_GET['moviesId'])) {
            throw new ParameterException("Forme numérique invalide");
        }
        $movie=Movie::findById((int)$_GET['moviesId']);
    }
    $form= new MovieForm($movie);
    echo $form->getHtmlForm('movie-save.php');
} catch (ParameterException) {
    http_response_code(400);
} catch (EntityNotFoundException) {
    http_response_code(404);
} catch (Exception) {
    http_response_code(500);
}
