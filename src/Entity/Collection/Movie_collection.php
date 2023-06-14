<?php

declare(strict_types=1);

namespace Entity\Collection;

use Database\MyPdo;
use Entity\Genre;
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
    public static function findMoviesByPeopleId(int $id): array
    {
        $stmt2 = MyPDO::getInstance()->prepare(
            <<<'SQL'
        SELECT m.id,posterId,originalLanguage,originalTitle,overview,releaseDate,runtime,tagline,title 
        FROM movie m,cast c
        WHERE m.id=c.movieId
        AND c.peopleId=:id
        ORDER BY title
        SQL
        );
        $stmt2->setFetchMode(PDO::FETCH_CLASS, Movie::class);
        $stmt2->execute([':id'=>$id]);
        return $stmt2->fetchAll();
    }
    public static function findMoviesByGenreid(int $id): array
    {
        $stmt2 = MyPDO::getInstance()->prepare(
            <<<'SQL'
        SELECT *
        FROM movie 
        WHERE id IN (SELECT movieId
                     FROM movie_genre
                     WHERE genreId=(SELECT id
                                    from genre
                                    where id=:id))
        SQL
        );
        $stmt2->setFetchMode(PDO::FETCH_CLASS, Movie::class);
        $stmt2->execute([':id'=>$id]);
        return $stmt2->fetchAll();
    }
}
