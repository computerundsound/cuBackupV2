<?php
declare(strict_types=1);

namespace App\Service\File;

class FileCreator
{
    /**
     * @var PathCreator
     */
    protected $pathCreator;


    /**
     * FileCreator constructor.
     */
    public function __construct(PathCreator $pathCreator)
    {

        $this->pathCreator = $pathCreator;
    }

    public function createFiles(array $files, string $shopRoot)
    {

        foreach ($files as $file) {

            $path    = $file['path'];
            $content = $file['content'];

            $this->createFile($path, $content, $shopRoot);

        }

    }

    protected function createFile(string $path, string $content, string $startDir = '')
    {

        $pathInfo = pathinfo($path);

        $this->pathCreator->create($pathInfo['dirname'], $startDir);

        file_put_contents($startDir . '/' . $path, $content);

    }

}