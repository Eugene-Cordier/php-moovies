<?php


declare(strict_types=1);

namespace Entity\Collection;

use Database\MyPdo;
use Entity\Genre;
use PDO;

class Genre_collection
{
    public static function findAll(): array
    {
        $stmt2 = MyPDO::getInstance()->prepare(
            <<<'SQL'
        SELECT *
        FROM genre
        SQL
        );
        $stmt2->setFetchMode(PDO::FETCH_CLASS, Genre::class);
        $stmt2->execute();
        return $stmt2->fetchAll();
    }

}
