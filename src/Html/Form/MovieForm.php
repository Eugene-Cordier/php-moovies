<?php


declare(strict_types=1);

namespace Html\Form;

use Entity\Movie;
use Exception\ParameterException;
use Html\StringEscaper;

class MovieForm
{
    use StringEscaper;
    private ?Movie $movie;
    public function __construct(?Movie $movie=null)
    {
        $this->movie = $movie;
    }/**
 * @return Movie|null
 */
    public function getMovie(): ?Movie
    {
        return $this->movie;
    }

    public function getHtmlForm(string $action): string
    {

        $form="<form name='movie' method='post' action=$action>
               <label for='id'>id
                    <input name='id' type='hidden' value='{$this->getMovie()?->getId()}'>
               </label>
               <label for='posterid'>posterId
                    <input  name='posterid' type='hidden' value='{$this->escapestring($this->getMovie()?->getPosterId())}'>
               </label>
               <label for='originalLanguage'>originalLanguage
                    <input  name='originalLanguage' type='text' value='{$this->escapestring($this->getMovie()?->getOriginalLanguage())}' required>
               </label>
               <label for='originalTitle'>originalTitle
                    <input  name='originalTitle' type='text' value='{$this->escapestring($this->getMovie()?->getOriginalTitle())}' required>
               </label>
               <label for='overview'>overview
                    <input  name='overview' type='text' value='{$this->escapestring($this->getMovie()?->getOverview())}' required>
               </label>
               <label for='releaseDate'>releaseDate
                    <input  name='releaseDate' type='date' value='{$this->escapestring($this->getMovie()?->getReleaseDate())}' required>
               </label>
               <label for='runtime'>runtime
                    <input  name='runtime' type='number' value='{$this->escapestring($this->getMovie()?->getRuntime())}' required>
               </label>
               <label for='tagline'>tagline
                    <input  name='tagline' type='text' value='{$this->escapestring($this->getMovie()?->getTagline())}' required>
               </label>
               <label for='title'>title
                    <input  name='title' type='text' value='{$this->escapestring($this->getMovie()?->getTitle())}' required>
               </label>
               <button type='submit'>Enrengistrer</button>
               </form>";
        return $form;
    }
    public function setEntityFromQueryString(): void
    {
        if (isset($_POST['id'])&& ctype_digit($_POST['id'])) {
            $id=(int)$_POST['id'];
        } else {
            $id=null;
        }
        if (isset($_POST['posterid'])&& ctype_digit($_POST['posterid'])) {
            $posterid=(int)($_POST['posterid']);
        } else {
            $posterid=null;
        }
        if (isset($_POST['originalLanguage'])&& !($_POST['originalLanguage']==null)) {
            $originallanguage=$this->stripTagsAndTrim($_POST['originalLanguage']);
        } else {
            throw new ParameterException("pas de originalLanguage trouvé");
        }
        if (isset($_POST['originalTitle'])&& !($_POST['originalTitle']==null)) {
            $originaltitle=$this->stripTagsAndTrim($_POST['originalTitle']);
        } else {
            throw new ParameterException("pas de originalTitle trouvé");
        }
        if (isset($_POST['overview'])&& !($_POST['overview']==null)) {
            $overview=$this->stripTagsAndTrim($_POST['overview']);
        } else {
            throw new ParameterException("pas d'overview trouvé");
        }
        if (isset($_POST['releaseDate'])&& !($_POST['releaseDate']==null)) {
            $releasedate=$this->stripTagsAndTrim($_POST['releaseDate']);
        } else {
            throw new ParameterException("pas de release date trouvé");
        }
        if (isset($_POST['runtime'])&& ctype_digit($_POST['runtime'])) {
            $runtime=(int)($_POST['runtime']);
        }
        if (isset($_POST['tagline'])&& !($_POST['tagline']==null)) {
            $tagline=$this->stripTagsAndTrim($_POST['tagline']);
        } else {
            throw new ParameterException("pas de tagline trouvé");
        }
        if (isset($_POST['title'])&& !($_POST['title']==null)) {
            $title=$this->stripTagsAndTrim($_POST['title']);
        } else {
            throw new ParameterException("pas de title trouvé");
        }
        $movie=Movie::create($originallanguage, $originaltitle, $overview, $releasedate, $runtime, $tagline, $title, $id, $posterid);
        $this->movie=$movie;
    }
}
