<?php

declare(strict_types=1);

use Entity\Cast;
use Entity\Movie;
use Entity\People;
use Html\WebPage;

$movieId=(int)$_GET["moviesId"];
$movie=Movie::findByid($movieId);
$webPage= new WebPage($movie->getTitle());
$webPage->appendCssurl("css/style2.css");
$webPage->appendContent("<header> Films-{$movie->getTitle()}</header>");
$cover="image.php?ImageId={$movie->getPosterId()}&Type=Movie";
$webPage->appendContent(<<<HTML
<div class="menu">
<form action="index.php" method="post">
    <input type="submit" name="returnIndex" value="Retour page d'acceuil">
    </form>
<form action="admin/movie-form.php?moviesId=$movieId" method="post">
    <input type="submit" value="Modifier">
    </form>
<form action="admin/movie-delete.php?moviesId=$movieId" method="post">
    <input type="submit" value="Supprimer">
    </form>
</div>
<div class="content">
    <div class="movie">
        <img alt="imagemovie" class="imgmovie" src=$cover>
        <div class="infomovie">
            <div class="titledate">
                <p class="title"> {$movie->getTitle()} </p>
                <P class="date">{$movie->getReleaseDate()}</P>
            </div>
            <p class="originaltitle"> {$movie->getOriginalTitle()}</p>
            <p> {$movie->getTagline()}</p>
            <p class="overview"> {$movie->getOverview()}</p>
        </div>
    </div>

HTML);

$CastList=Cast::findAllByMovieId($movieId);
foreach ($CastList as $cast) {
    //getNom,role, image
    $actor=People::findById($cast->getpeopleId());
    $actorName=$actor->getName();
    $actorCover=$actor->getAvatarId();
    $actorRole=$cast->getRole();
    $webPage->appendContent(<<<HTML
    <a href="actor.php?ActorId={$actor->getId()}">
    <div class="actor">
        <img alt="imageactor" src="image.php?ImageId=$actorCover&Type=People">
        <div class="actorinfo">
            <p>$actorRole</p>
            <p>$actorName</p>
        </div>
    </div>
    </a>
HTML);
}
$webPage->appendContent(<<<HTML
        </div>
        <footer class='footer'>Derniere modification : {$webPage->getLastModification()}</footer>
    HTML);
echo $webPage->toHtml();
