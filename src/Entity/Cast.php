<?php

declare(strict_types=1);

namespace Entity;

use Database\MyPdo;
use Entity\Exception\EntityNotFoundException;
use PDO;

class Cast
{
    private int $id;
    private int $peopleId;
    private int $movieId;
    private string $role;
    private int $orderIndex;

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
     * @return int
     */
    public function getPeopleId(): int
    {
        return $this->peopleId;
    }

    /**
     * @param int $peopleId
     */
    public function setPeopleId(int $peopleId): void
    {
        $this->peopleId = $peopleId;
    }

    /**
     * @return int
     */
    public function getMovieId(): int
    {
        return $this->movieId;
    }

    /**
     * @param int $movieId
     */
    public function setMovieId(int $movieId): void
    {
        $this->movieId = $movieId;
    }

    /**
     * @return string
     */
    public function getRole(): string
    {
        return $this->role;
    }

    /**
     * @param string $role
     */
    public function setRole(string $role): void
    {
        $this->role = $role;
    }

    /**
     * @return int
     */
    public function getOrderIndex(): int
    {
        return $this->orderIndex;
    }

    /**
     * @param int $orderIndex
     */
    public function setOrderIndex(int $orderIndex): void
    {
        $this->orderIndex = $orderIndex;
    }
    public static function findAllByMovieId($movieId): array
    {
        $stmt2 = MyPDO::getInstance()->prepare(
            <<<'SQL'
        SELECT *
        FROM cast
        WHERE  movieId= :movieId
        SQL
        );
        $stmt2->setFetchMode(PDO::FETCH_CLASS, Cast::class);
        $stmt2->execute([':movieId'=>$movieId]);
        return $stmt2->fetchAll();
    }
    public static function getCast($movieId, $peopleId): Cast
    {
        $stmt2 = MyPDO::getInstance()->prepare(
            <<<'SQL'
        SELECT *
        FROM cast
        WHERE  movieId= :movieId AND peopleId= :peopleId
        SQL
        );
        $stmt2->setFetchMode(PDO::FETCH_CLASS, Cast::class);
        $stmt2->execute([':movieId'=>$movieId,':peopleId'=>$peopleId]);
        if(!($cast = $stmt2->fetch())) {
            throw new EntityNotFoundException("Les deux ids ne correspondent a aucun cast ");
        }
        return $cast;
    }
}
