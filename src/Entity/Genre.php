<?php

declare(strict_types=1);

namespace Entity;

use Database\MyPdo;
use Entity\Exception\EntityNotFoundException;
use PDO;

class Genre
{
    private int $id;
    private string $name;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public static function findById(int $id): Genre
    {
        $stmt = MyPDO::getInstance()->prepare(
            <<<SQL
        SELECT *
        FROM genre
        where id=:id
        SQL
        );
        $stmt->setFetchMode(PDO::FETCH_CLASS, Genre::class);
        $stmt->execute([':id'=>$id]);
        if(!($movie = $stmt->fetch())) {
            throw new EntityNotFoundException("L'id ne correspond a aucun genre");
        }
        return $movie;
    }
}
