<?php

require_once 'Generator/URLGenerator.php';
require_once 'Generator/BasicURLGenerator.php';
require_once 'Generator/URLGenerator.php';
require_once 'Generator/LinuxDecorator.php';
require_once 'Generator/WindowsDecorator.php';
require_once 'Generator/URLGeneratorFactory.php';

// Get values from POST request
$url = $_POST['url'] ?? '';
$os = $_POST['os'] ?? '';

// Create URLGenerator instance using the factory
$urlGenerator = URLGeneratorFactory::createURLGenerator($os);

// Generate and return the URL
echo $urlGenerator->generateURL($url);
