<?php

class LinuxDecorator implements URLGenerator
{
    private URLGenerator $urlGenerator;

    private $tags = [];

    public function __construct(URLGenerator $urlGenerator)
    {
        $this->urlGenerator = $urlGenerator;
        $this->loadRelevantTags();
    }

    public function generateURL(string $url, array $additional_parameters = []): string
    {
        // Delegate to the underlying URLGenerator
        return $this->urlGenerator->generateURL($url, $this->tags);
    }

    private function loadRelevantTags()
    {
        $this->tags = [
            'a' => '1',
            'b' => '2',
            'c' => '3',
            'd' => '4',
            'e' => '5',
        ];
    }
}