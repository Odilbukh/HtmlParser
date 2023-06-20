<?php
require_once __DIR__ . '/../app/Fetchers/ContentFetcherInterface.php';
require_once __DIR__ . '/../app/Fetchers/CurlContentFetcher.php';
require_once __DIR__ . '/../app/Parsers/HtmlParserInterface.php';
require_once __DIR__ . '/../app/Parsers/SimpleHtmlParser.php';
require_once __DIR__ . '/../app/Analyzers/ContentAnalyzer.php';


$url = $_GET['url'] ?? '';

try {
    if (!empty($url)) {
        $fetcher = new CurlContentFetcher();
        $parser = new SimpleHtmlParser();
        $analyzer = new ContentAnalyzer($fetcher, $parser);

        $tagCounts = $analyzer->analyze($url);

        echo json_encode($tagCounts);
    } else {
        echo 'Please provide a valid URL';
    }
} catch (Exception $e) {
    echo 'Error: ' . $e->getMessage();
}

