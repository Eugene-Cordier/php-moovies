<?php


declare(strict_types=1);

use Entity\Cast;
use Entity\Collection\Movie_collection;
use Entity\People;
use Html\WebPage;

$actorId=(int)$_GET["ActorId"];
$actor=People::findById($actorId);
$webPage= new WebPage($actor->getName());
$webPage->appendCssurl("css/style3.css");
$webPage->appendContent("<header> Films-{$actor->getName()}</header>");
$cover="image.php?ImageId={$actor->getAvatarId()}&Type=People";
if(($death=$actor->getDeathday())==null) {
    $death='Alive';
}
$webPage->appendContent(<<<HTML
<div class="content">
    <div class="form">
    <form action="index.php" method="post">
    <input type="submit" name="returnIndex" value="Retour page d'acceuil">
    </form>
    </div>
    <div class="actor">
        <img alt="imgactor" class="imgactor" src=$cover>
        <div class="infoactor">
            <p>{$actor->getName()}</p>
            <p>{$actor->getPlaceOfBirth()}</p>
            <div class="datebirthdead">
                <p class="birthday"> {$actor->getbirthday()}</p>
                <p>&nbsp-&nbsp</p>
                <P class="deathday">$death</P>
            </div>
            <p class="biography">{$actor->getBiography()}</p>
        </div>
    </div>

HTML);

$movieList=Movie_collection::findMoviesByPeopleId($actorId);
foreach($movieList as $movie) {
    $poster="image.php?ImageId={$movie->getPosterId()}";
    $title=$movie->getTitle();
    $date=$movie->getReleaseDate();
    $cast=Cast::getCast($movie->getId(), $actorId);
    $role=$cast->getRole();
    $webPage->appendContent(<<<HTML
    <a href="movies.php?moviesId={$movie->getId()}">
    <div class="movie">
        <img alt="imgmovie" class="imgmovie" src="$poster">
        <div class="infomovie">
            <div class="titledate">
                <p class="title">$title</p>
                <p class="date">$date</p>
            </div>
            <p class="role">$role</p>
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
