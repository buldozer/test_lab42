<?php

class WindowsDecorator implements URLGenerator
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
            'program' => '1111',
            'app' => '2222',
            'cache' => '3333',
            'dog' => 'Roxy!',
            'cat' => '2'
        ];
    }
}
