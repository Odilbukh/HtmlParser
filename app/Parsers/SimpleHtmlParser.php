<?php

class SimpleHtmlParser implements HtmlParserInterface
{
    private $tagCounts = [];
    public function parse(string $html): array
    {

        $this->tagCounts = [];

        $pattern = '/<([a-zA-Z0-9]+)(?:\s|>)/';

        preg_match_all($pattern, $html, $matches);

        $tags = $matches[1];

        foreach ($tags as $tag) {
            $tag = strtolower($tag);
            if (isset($this->tagCounts[$tag])) {
                $this->tagCounts[$tag]++;
            } else {
                $this->tagCounts[$tag] = 1;
            }
        }

        return $this->tagCounts;
    }
}
