<?php

use Html\WebPage;

$webPage= new WebPage();
$webPage->appendContent('Hello Music');
echo $webPage->toHtml();


