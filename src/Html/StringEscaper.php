<?php


declare(strict_types=1);

namespace Html;

trait StringEscaper
{
    public function escapestring(?string $string): ?string
    {
        if ($string==null) {
            return "";
        }
        $string = htmlspecialchars($string, ENT_HTML5 | ENT_QUOTES);
        return $string;
    }
    public function stripTagsAndTrim(?string $text): string
    {
        if ($text==null) {
            return "";
        }
        return strip_tags(trim($text));
    }
}
