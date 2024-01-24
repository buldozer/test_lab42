<?php

class URLGeneratorFactory
{
    public static function createURLGenerator(string $os): URLGenerator
    {
        // Create a basic URLGenerator instance
        $urlGenerator = new BasicURLGenerator();

        // Decorate with OS-specific parameters based on the provided OS
        switch ($os) {
            case 'linux':
                return new LinuxDecorator($urlGenerator);
            case 'windows':
                return new WindowsDecorator($urlGenerator);
            default:
                return $urlGenerator;
        }
    }
}