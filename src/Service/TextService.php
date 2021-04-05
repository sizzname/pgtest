<?php


namespace App\Service;


class TextService
{
    /**
     * Convert markdown to HTML
     *
     * @param string $text
     * @return string
     */
    public function markdownToHtml(string $text): string
    {
        $text = preg_replace('/(\*\*|__)(?=\S)(.+?[*_]*)(?<=\S)\1/', '<strong>$2</strong>', $text);
        $text = preg_replace('/(\*|_)(?=\S)(.+?)(?<=\S)\1/', '<em>$2</em>', $text);
        return $text;
    }
}
