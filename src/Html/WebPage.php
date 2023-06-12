<?php

declare(strict_types=1);

namespace Html;

use Html\StringEscaper;

class WebPage
{
    use StringEscaper;
    protected string $head = "";
    protected string $title = "";
    protected string $body = "";

    public function __construct(string $title = "")
    {
        $this->title = $title;
    }

    /**
     * @return string
     */
    public function getBody(): string
    {
        return $this->body;
    }

    /**
     * @return string
     */
    public function getHead(): string
    {
        return $this->head;
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

    public function appendToHead(string $content): void
    {
        $this->head .= $content;
    }

    public function appendCss(string $css): void
    {
        $this->head .= "<style>";
        $this->head .= $css;
        $this->head .= "</style>";
    }

    public function appendCssurl(string $url): void
    {
        $this->head .= "<link rel='stylesheet' href=$url>";
    }

    public function appendJs(string $js): void
    {
        $this->head .= "<script>";
        $this->head .= $js;
        $this->head .= "</script>";
    }

    public function appendJsurl(string $url): void
    {
        $this->head .= "<script src=$url></script>";
    }

    public function appendContent(string $content): void
    {
        $this->body .= $content;
    }

    /**
     * @return string
     */
    public function toHtml(): string
    {
        $res = "<!doctype html>\n";
        $res .= "<html lang='fr'>\n";
        $res .= "<head> <meta charset='UTF-8'> <meta name='viewport' content='width=device-width, initial-scale=1.0'>";
        $res .= "<title>";
        $res .= $this->getTitle();
        $res .= "</title>";
        $res .= $this->getHead();
        $res .= "</head>";
        $res .= "<body>" . $this->getbody() . "</body>";
        $res .= "</html>";
        return $res;
    }



    public function getLastModification(): string
    {
        return date("F j, Y, g:i a", getlastmod());
    }
}
