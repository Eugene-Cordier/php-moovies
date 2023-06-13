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
    $cover="image.php?ImageId={$elt->getPosterId()}&Type=Movie";
    $webPage->appendContent(<<<HTML
        <div class="movie">
            <a href="movies.php?moviesId={$elt->getId()}">
                <div class="poster"><img alt="posterfilm" src="$cover"></div>
                <div class="title">{$elt->getTitle()}</div>
            </a>
        </div>
        HTML);
}
$webPage->appendContent(<<<HTML
        </div>
        <footer class='footer'>Derniere modification : {$webPage->getLastModification()}</footer>
    HTML);
echo $webPage->toHtml();
