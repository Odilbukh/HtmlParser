<?php

interface ContentFetcherInterface
{
    public function fetch(string $url): string;
}
