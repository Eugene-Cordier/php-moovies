<?php

declare(strict_types=1);

use Exception\ParameterException;
use Html\Form\MovieForm;

try {
    $movie= new MovieForm();
    $movie->setEntityFromQueryString();
    $movie->getMovie()->save();
    header("location:../index.php", true, 302);
} catch (ParameterException) {
    http_response_code(400);
} catch (Exception) {
    http_response_code(500);
}
