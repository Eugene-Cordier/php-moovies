<?php
declare(strict_types=1);

namespace Entity\Collection;

use Database\MyPdo;
use Entity\Movie;
use PDO;

class Movie_collection
{
    public static function findAllMovie(): array
    {
        //    MyPDO::setConfiguration('mysql:host=mysql;dbname=cutron01_music;charset=utf8', 'web', 'web');
        $stmt2 = MyPDO::getInstance()->prepare(
            <<<'SQL'
        SELECT *
        FROM Movie
        ORDER BY title
        SQL
        );
        $stmt2->setFetchMode(PDO::FETCH_CLASS, Movie::class);
        $stmt2->execute();
        return $stmt2->fetchAll();
    }
}