<?php
declare(strict_types=1);

namespace App\Service\File;

class PathCreator
{

    public function create(string $path, string $startDir = '')
    {

        $pathElements = explode('/', $path);

        $currentPath = $startDir . '/';

        foreach ($pathElements as $pathElement) {
            $currentPath .= $pathElement;
            $this->createDir($currentPath);
            $currentPath .= '/';
        }

    }

    protected function createDir(string $directory)
    {

        if (is_dir($directory) === false) {
            mkdir($directory);
        }

    }

}