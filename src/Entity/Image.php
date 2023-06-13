<?php

declare(strict_types=1);
namespace Entity;

use Database\MyPdo;
use Entity\Exception\EntityNotFoundException;
use PDO;

class Image
{
    private string $id;

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @param string $id
     */
    public function setId(string $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getJpeg(): string
    {
        return $this->jpeg;
    }

    /**
     * @param string $jpeg
     */
    public function setJpeg(string $jpeg): void
    {
        $this->jpeg = $jpeg;
    }
    private string $jpeg;

    public static function findbyId($id): Image
    {
        $stmt2 = MyPDO::getInstance()->prepare(
            <<<'SQL'
        SELECT id, jpeg
        FROM image
        WHERE id= :var
        SQL
        );
        $stmt2->setFetchMode(PDO::FETCH_CLASS, Image::class);
        $stmt2->execute([":var"=> $id]);
        if(!($image = $stmt2->fetch())) {
            throw new EntityNotFoundException("L'id ne correspond a aucune Image");
        }
        return $image;
    }


}
