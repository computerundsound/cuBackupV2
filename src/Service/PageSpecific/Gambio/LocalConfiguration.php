<?php
declare(strict_types=1);

namespace App\Service\PageSpecific\Gambio;

class LocalConfiguration
{
    public const LOCAL_PATH_FRONT_END    = '/includes/local/configure.php';
    public const STANDARD_PATH_FRONT_END = '/includes/configure.php';
    public const LOCAL_PATH_ADMIN        = '/admin/includes/local/configure.php';
    public const STANDARD_PATH_ADMIN     = '/admin/includes/configure.php';

    public function createLocalConfiguration(LocalConfigurationParameter $localConfigurationParameter,
                                             string $pageRootDir)
    {

        $localPathFrontEnd    = self::LOCAL_PATH_FRONT_END;
        $standardPathFrontEnd = self::STANDARD_PATH_FRONT_END;
        $localPathAdmin       = self::LOCAL_PATH_ADMIN;
        $standardPathAdmin    = self::STANDARD_PATH_ADMIN;

        $this->createNewConfigurationFile($standardPathFrontEnd,
                                          $localPathFrontEnd,
                                          $localConfigurationParameter,
                                          $pageRootDir);

        $this->createNewConfigurationFile($standardPathAdmin,
                                          $localPathAdmin,
                                          $localConfigurationParameter,
                                          $pageRootDir);

    }

    public function reset(LocalConfigurationParameter $localConfigurationParameter, string $shopRoot)
    {

        $paths = [];

        $paths[] = $shopRoot . '/' . self::LOCAL_PATH_FRONT_END;
        $paths[] = $shopRoot . '/' . self::LOCAL_PATH_ADMIN;

        foreach ($paths as $path) {
            $this->removeFile($path);
        }
    }

    protected function createNewConfigurationFile(string $originPath,
                                                  string $destinationPath,
                                                  LocalConfigurationParameter $localConfigurationParameter,
                                                  string $pageRoot)
    {

        $originContent = file_get_contents($pageRoot . $originPath);

        $newContent = $this->replaceValues($originContent, $localConfigurationParameter, $originPath);

        file_put_contents($pageRoot . $destinationPath, $newContent);

    }

    protected function replaceValues(string $originContent,
                                     LocalConfigurationParameter $localConfigurationParameter,
                                     string $originPath): string
    {

        $newContent = $originContent;

        $httpServer = $localConfigurationParameter->getHttpServer();
        $docRoot    = $localConfigurationParameter->getApplicationRoot();


        $replacements = $localConfigurationParameter->getReplacements()->getReplacements($originPath);

        foreach ($replacements as $replacement) {

            $newContent = preg_replace($replacement->getReplacePattern(), $replacement->getReplaceWith(), $newContent);

            $newContent = str_replace('%docRoot%', $docRoot, $newContent);

        }

        return $newContent;

    }

    protected function replaceValue(string $needle, string $replace, string $content): string
    {

        return preg_replace($needle, $replace, $content);

    }

    protected function escapeReplacer(string $stringToEscape): string
    {

        return addcslashes($stringToEscape, '$');

    }

    protected function removeFile(string $pathFromShopRoot)
    {

        $realPath = realpath($pathFromShopRoot);

        if ($realPath) {
            unlink($realPath);
        }

    }

}