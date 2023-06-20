<?php

class SimpleHtmlParser implements HtmlParserInterface
{
    public function parse(string $html): array
    {
        $tagCounts = [];
        $pos = 0;

        while (($start = strpos($html, '<', $pos)) !== false) {
            $end = strpos($html, '>', $start);
            if ($end === false) {
                break;
            }

            $tag = substr($html, $start + 1, $end - $start - 1);
            $tag = strtolower($tag);

            if (strpos($tag, '/') === 0) {
                // Закрывающий тег, удалить его из подсчета
                $tag = substr($tag, 1);
            } elseif (strpos($tag, ' ') !== false) {
                // Пометить и удалить атрибуты
                $tag = substr($tag, 0, strpos($tag, ' '));
            }

            if (isset($tagCounts[$tag])) {
                $tagCounts[$tag]++;
            } else {
                $tagCounts[$tag] = 1;
            }

            $pos = $end + 1;
        }

        return $tagCounts;
    }
}
