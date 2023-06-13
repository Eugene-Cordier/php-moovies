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
$cover="image.php?ImageId={$movie->getPosterId()}";
$webPage->appendContent(<<<HTML
<div class="content">
    <div class="form">
    <form action="index.php" method="post">
    <input type="submit" name="returnIndex" value="Retour page d'acceuil">
    </form>
    </div>
    <div class="movie">
        <img class="imgmovie" src=$cover>
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
        <img src="image.php?ImageId=$actorCover&Type=People">
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
