<?php


declare(strict_types=1);

use Entity\Movie;
use Entity\Exception\EntityNotFoundException;
use Exception\ParameterException;
use Html\Form\MovieForm;
use Html\WebPage;

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
    $webPage=new WebPage();
    $webPage->appendCssurl("../css/style4.css");
    $webPage->appendContent(<<<HTML
    <header>Modification & Création de Films</header>
     <div class="content">
    <form action="../index.php" method="post">
    <input class='buttonindex' type="submit" name="returnIndex" value="Retour page d'acceuil">
    </form>
    HTML);
    $webPage->appendContent($form->getHtmlForm('movie-save.php'));
    $webPage->appendContent(<<<HTML
    </div>
    HTML);
    echo $webPage->toHtml();
} catch (ParameterException) {
    http_response_code(400);
} catch (EntityNotFoundException) {
    http_response_code(404);
} catch (Exception) {
    http_response_code(500);
}
