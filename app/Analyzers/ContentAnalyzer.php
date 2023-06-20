<?php

class ContentAnalyzer
{
    private $fetcher;
    private $parser;

    public function __construct(ContentFetcherInterface $fetcher, HtmlParserInterface $parser)
    {
        $this->fetcher = $fetcher;
        $this->parser = $parser;
    }

    public function analyze(string $url): array
    {
        $html = $this->fetcher->fetch($url);
        $tagCounts = $this->parser->parse($html);
        return $tagCounts;
    }
}
