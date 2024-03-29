<?php

declare(strict_types=1);

namespace Entity;

use Database\MyPdo;
use Entity\Exception\EntityNotFoundException;
use PDO;

class People
{
    private int $id;

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
    private ?int $avatarId;

    /**
     * @return int
     */
    public function getAvatarId(): ?int
    {
        return $this->avatarId;
    }

    /**
     * @param int $avatarId
     */
    public function setAvatarId(int $avatarId): void
    {
        $this->avatarId = $avatarId;
    }
    private ?string $birthday;
    /**
     * @return int
     */
    public function getbirthday(): ?string
    {
        return $this->birthday;
    }

    /**
     * @param int $birthday
     */
    public function setbirthday(int $birthday): void
    {
        $this->avatarId = $birthday;
    }
    private ?string $deathday;

    /**
     * @return string
     */
    public function getDeathday(): ?string
    {
        return $this->deathday;
    }

    /**
     * @param string $deathday
     */
    public function setDeathday(string $deathday): void
    {
        $this->deathday = $deathday;
    }
    private string $name;

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
    private string $biography;

    /**
     * @return string
     */
    public function getBiography(): string
    {
        return $this->biography;
    }

    /**
     * @param string $biography
     */
    public function setBiography(string $biography): void
    {
        $this->biography = $biography;
    }
    private string $placeOfBirth;

    /**
     * @return string
     */
    public function getPlaceOfBirth(): string
    {
        return $this->placeOfBirth;
    }

    /**
     * @param string $placeofbirth
     */
    public function setPlaceOfBirth(string $placeOfBirth): void
    {
        $this->placeOfBirth = $placeOfBirth;
    }

    public static function findById($Id): people
    {
        $stmt2 = MyPDO::getInstance()->prepare(
            <<<'SQL'
        SELECT *
        FROM people 
        WHERE  id= :Id
        ORDER BY name
        SQL
        );
        $stmt2->setFetchMode(PDO::FETCH_CLASS, People::class);
        $stmt2->execute([':Id'=>$Id]);
        if(!($people = $stmt2->fetch())) {
            throw new EntityNotFoundException("L'id ne correspond a aucun acteur");
        }
        return $people;
    }
}
