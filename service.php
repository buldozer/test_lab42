<?php

require_once 'Service/URLGenerator.php';
require_once 'Service/BasicURLGenerator.php';
require_once 'Service/URLGenerator.php';
require_once 'Service/LinuxDecorator.php';
require_once 'Service/WindowsDecorator.php';
require_once 'Service/URLGeneratorFactory.php';

// Get values from POST request
$url = $_POST['url'] ?? '';
$os = $_POST['os'] ?? '';

// Create URLGenerator instance using the factory
$urlGenerator = URLGeneratorFactory::createURLGenerator($os);

// Generate and return the URL
echo $urlGenerator->generateURL($url);
