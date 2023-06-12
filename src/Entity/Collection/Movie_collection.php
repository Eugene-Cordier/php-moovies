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
        $stmt2 = MyPDO::getInstance()->prepare(
            <<<'SQL'
        SELECT *
        FROM movie
        ORDER BY title
        SQL
        );
        $stmt2->setFetchMode(PDO::FETCH_CLASS, Movie::class);
        $stmt2->execute();
        return $stmt2->fetchAll();
    }
}