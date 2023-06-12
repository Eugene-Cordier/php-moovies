<?php
declare(strict_types=1);

use Entity\Movie;
use Html\WebPage;

$movieId=(int)$_GET["moviesId"];
$movie=Movie::findByid($movieId);
$webPage= new WebPage($movie->getTitle());
$webPage->appendContent("<header> Films-{$movie->getTitle()}</header>");
$cover="image.php?imageId={$movie->getPosterId()}";
if($movie->getPosterId()==null) {
    $cover="img/defaultcover.png";
}
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
</div>
HTML);

echo $webPage->toHtml();

