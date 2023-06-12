<?php

use Entity\Collection\Movie_collection;
use Entity\Movie;
use Html\WebPage;

$tab= Movie_collection::findAllMovie();
$webPage= new WebPage();
$webPage->setTitle('Films');
$webPage->appendCssurl('css/style.css');
$webPage->appendContent(<<<HTML
    <header>Films</header>
    <div class="content">
HTML);

foreach ($tab as $elt) {
    $cover="image.php?imageId={$elt->getPosterId()}";
    if($elt->getPosterId()==null) {
        $cover="img/defaultcover.png";
    }
    $webPage->appendContent(<<<HTML
        <div class="film">
            <a href="movies.php?moviesId={$elt->getId()}">
                <div class="poster"><img src="$cover"></div>
                <div class="titre">{$elt->getTitle()}</div>
            </a>
        </div>
        HTML);
}
$webPage->appendContent(<<<HTML
        <footer class='footer'>Derniere modification : {$webPage->getLastModification()}</footer>
    HTML);
echo $webPage->toHtml();
