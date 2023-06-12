<?php

use Entity\Movie;
use Html\WebPage;

$webPage= new WebPage();
$film = Movie::findById(108);
$webPage->appendContent($film->getTitle());
echo $webPage->toHtml();


