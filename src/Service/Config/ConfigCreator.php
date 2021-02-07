<?php
declare(strict_types=1);

namespace App\Service\Config;

use Symfony\Component\Yaml\Yaml;

/**
 * @psalm-type ConfigType array{
 *  excluded_dirs: string,
 *  htaccessContent:string,
 *  files_to_add: list<array{path: string, content: string}>,
 *  local_db_data: array{ server: string, username: string, password: string, db_name: string}
 * }
 *
 */
class ConfigCreator
{
    /**
     * @psalm-return array {0: ConfigData, 1: string}
     */
    public static function createConfig(): array
    {

        $configFilePath = __DIR__ . '/../../../config.yaml';
        $shopRoot       = realpath(__DIR__ . '/../../../../');

        $configCreator = new ConfigCreator();

        return [$configCreator->getConfig($configFilePath), $shopRoot];

    }

    /**
     * @param string $filePath
     *
     * @psalm-return  ConfigType
     *
     * @return array
     */
    public function getConfig(string $filePath): array
    {

        /** @psalm-var  ConfigType $config */
        $config          = Yaml::parseFile($filePath);
        $htaccessContent = $config['htaccessContent'];

        foreach ($config['files_to_add'] as &$fileToAdd) {

            $newContent = $fileToAdd['content'] === '%htaccessContent%' ? $htaccessContent : $fileToAdd['content'];

            $fileToAdd['content'] = $newContent;

        }

        return $config;

    }

}