<?php

declare(strict_types=1);

use Entity\Cast;
use Entity\Movie;
use Entity\People;
use Html\WebPage;

$movieId=(int)$_GET["moviesId"];
$movie=Movie::findByid($movieId);
$webPage= new WebPage($movie->getTitle());
$webPage->appendContent("<header> Films-{$movie->getTitle()}</header>");
$cover="image.php?ImageId={$movie->getPosterId()}";
$webPage->appendContent(<<<HTML
<div class="content">
    <div class="movie">
        <img src=$cover>
        <div class="infomovie">
            <div class="title&date">
                <p class="title"> {$movie->getTitle()} </p>
                <P class="date">{$movie->getReleaseDate()}</P>
            </div>
            <p class="originaltitle"> {$movie->getOriginalTitle()}</p>
            <p> {$movie->getTagline()}</p>
            <p> {$movie->getOverview()}</p>
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
    <div class="actor">
        <img src="image.php?ImageId=$actorCover&Type=People">
        <div class="actorinfo">
            <p>$actorRole</p>
            <p>$actorName</p>
        </div>
    </div>
HTML);
}
$webPage->appendContent(<<<HTML
        </div>
        <footer class='footer'>Derniere modification : {$webPage->getLastModification()}</footer>
    HTML);
echo $webPage->toHtml();
