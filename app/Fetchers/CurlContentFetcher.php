<?php

class CurlContentFetcher implements ContentFetcherInterface
{
    public function fetch(string $url): string
    {
        $ch = curl_init($url);
        curl_setopt_array($ch, [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_USERAGENT => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.50 Safari/537.36 OPR/65.0.3467.16 (Edition beta)',
        ]);

        $data = curl_exec($ch);

        if ($data === false) {
            $error = curl_error($ch);
            curl_close($ch);
            throw new Exception("cURL Error: $error");
        }

        curl_close($ch);

        return $data;
    }
}
