<?php

use Entity\Collection\Genre_collection;
use Entity\Collection\Movie_collection;
use Entity\Movie;
use Html\WebPage;

$webPage= new WebPage();
$webPage->setTitle('Films');
$webPage->appendCssurl('css/style.css');
$webPage->appendContent(<<<HTML
    <header>Films</header>
    <div class="menu">
    <form action="index.php" method="get">
    <select name="Filtre">
    <option value="">Choisissez un genre</option>
HTML);
$tabgenre=Genre_collection::findAll();
foreach ($tabgenre as $genre) {
    $webPage->appendContent(<<<HTML
    <option value="{$genre->getId()}">{$genre->getName()}</option>
HTML);
}
$webPage->appendContent(<<<HTML
    </select>
    <button type="submit">Filtrer</button>
    </form>
    <form action="admin/movie-form.php" method="post">
    <input type="submit" value="Nouveau Film">
    </form>
    </div>
    <div class="content">  
HTML);
if (isset($_GET['Filtre'])) {
    $filtre=(int)$_GET['Filtre'];
} else {
    $filtre=null;
}
if ($filtre==null) {
    $tab= Movie_collection::findAllMovie();
} else {
    $tab=Movie_collection::findMoviesByGenreid($filtre);
}

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
