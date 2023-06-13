<?php


declare(strict_types=1);

namespace Entity;

use Database\MyPdo;
use Entity\Exception\EntityNotFoundException;
use PDO;

class Movie
{
    private ?int $id;
    private string $title;
    private ?int $posterId;
    private string $originalLanguage;
    private string $originalTitle;
    private string $overview;
    private string $releaseDate;
    private int $runtime;
    private string $tagline;
    /**
 * @return ?int
 */
    public function getId(): ?int
    {
        return $this->id;
    }
    /**
 * @param ?int $id
 */
    public function setId(?int $id): void
    {
        $this->id = $id;
    }
    /**
 * @return string
 */
    public function getTitle(): string
    {
        return $this->title;
    }
    /**
 * @param string $title
 */
    public function setTitle(string $title): void
    {
        $this->title = $title;
    }
    /**
 * @return int
 */
    public function getPosterId(): int
    {
        return $this->posterId;
    }
    /**
 * @param int $posterId
 */
    public function setPosterId(int $posterId): void
    {
        $this->posterId = $posterId;
    }
    /**
 * @return string
 */
    public function getOriginalLanguage(): string
    {
        return $this->originalLanguage;
    }
    /**
 * @param string $originalLanguage
 */
    public function setOriginalLanguage(string $originalLanguage): void
    {
        $this->originalLanguage = $originalLanguage;
    }
    /**
 * @return string
 */
    public function getOriginalTitle(): string
    {
        return $this->originalTitle;
    }
    /**
 * @param string $originalTitle
 */
    public function setOriginalTitle(string $originalTitle): void
    {
        $this->originalTitle = $originalTitle;
    }
    /**
 * @return string
 */
    public function getOverview(): string
    {
        return $this->overview;
    }
    /**
 * @param string $overview
 */
    public function setOverview(string $overview): void
    {
        $this->overview = $overview;
    }
    /**
 * @return string
 */
    public function getReleaseDate(): string
    {
        return $this->releaseDate;
    }
    /**
 * @param string $releaseDate
 */
    public function setReleaseDate(string $releaseDate): void
    {
        $this->releaseDate = $releaseDate;
    }
    /**
 * @return int
 */
    public function getRuntime(): int
    {
        return $this->runtime;
    }
    /**
 * @param int $runtime
 */
    public function setRuntime(int $runtime): void
    {
        $this->runtime = $runtime;
    }
    /**
 * @return string
 */
    public function getTagline(): string
    {
        return $this->tagline;
    }
    /**
 * @param string $tagline
 */
    public function setTagline(string $tagline): void
    {
        $this->tagline = $tagline;
    }
    public static function findById(int $id): Movie
    {
        $stmt = MyPDO::getInstance()->prepare(
            <<<SQL
        SELECT *
        FROM movie
        where id=:id
        SQL
        );
        $stmt->setFetchMode(PDO::FETCH_CLASS, Movie::class);
        $stmt->execute([':id'=>$id]);
        if(!($movie = $stmt->fetch())) {
            throw new EntityNotFoundException("L'id ne correspond a aucun film");
        }
        return $movie;
    }
    public function delete(): Movie
    {
        $stmt = MyPDO::getInstance()->prepare(
            <<<SQL
        DELETE FROM movie
        WHERE id=:id
        SQL
        );
        $stmt->execute([':id'=>$this->id]);
        $this->id=null;
        return $this;
    }
    protected function update(): Movie
    {
        $stmt = MyPDO::getInstance()->prepare(
            <<<SQL
        UPDATE movie
        SET originalLanguage=:originalLanguage,
            originalTitle=:originalTitle,
            overview=:overview,
            releaseDate=:releaseDate,
            runtime=:runtime,
            tagline=:tagline,
            title=:title
        WHERE id=:id
        SQL
        );
        $stmt->execute([':originalLanguage'=>$this->getOriginalLanguage(),':originalTitle'=>$this->getOriginalTitle(),':overview'=>$this->getOverview(),':releaseDate'=>$this->getReleaseDate(),
        ':runtime'=>$this->getRuntime(),':tagline'=>$this->getTagline(),':title'=>$this->getTitle(),':id'=>$this->getId()]);
        return $this;
    }
    private function __construct()
    {
    }
    public static function create(string $originalLanguage, string $originalTitle, string $overview, string $releaseDate, int $runtime, string $tagline, string $title, ?int $id=null, ?int $posterId=null): Movie
    {
        $movie= new Movie();
        $movie->setOriginalLanguage($originalLanguage);
        $movie->setOriginalTitle($originalTitle);
        $movie->setOverview($overview);
        $movie->setReleaseDate($releaseDate);
        $movie->setRuntime($runtime);
        $movie->setTagline($tagline);
        $movie->setTitle($title);
        $movie->setId($id);
        $movie->setPosterId($posterId);
        return $movie;
    }


}
