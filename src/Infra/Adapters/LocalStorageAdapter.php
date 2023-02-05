<?php

declare(strict_types=1);

namespace App\Infra\Adapters;

use App\Application\Interfaces\Storage;

final class LocalstorageAdapter implements Storage
{

    public function store(string $filename, string $path, string $content)
    {
        file_put_contents($path . DIRECTORY_SEPARATOR . $filename, $content);
    }
}
