<?php

interface URLGenerator
{
    public function generateURL(string $url, array $additional_parameters ): string;
}