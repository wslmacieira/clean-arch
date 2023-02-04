<?php

declare(strict_types=1); 

namespace App\Application\Interfaces;

interface Storage
{
    public function store(string $filename, string $path, string $content);
}
