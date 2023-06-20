<?php

interface HtmlParserInterface
{
    public function parse(string $html): array;
}
