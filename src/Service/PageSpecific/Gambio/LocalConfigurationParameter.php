<?php
declare(strict_types=1);

namespace App\Service\PageSpecific\Gambio;

use App\Service\Config\Replacements;
use App\Service\Config\Values\DbData;

/**
 * Class LocalConfigurationParameter
 *
 * @package           App\Service\PageSpecific\Gambio
 *
 * @psalm-import-type ConfigType from \App\Service\Config\ConfigCreator
 */
class LocalConfigurationParameter
{

    protected $dbData;
    protected $applicationRoot;
    protected $httpServer;
    /**
     * @var Replacements
     */
    protected $replacements;

    public function __construct(DbData $dbData, string $applicationRoot, string $httpServer, Replacements $replacements)
    {

        $this->dbData          = $dbData;
        $this->applicationRoot = realpath($applicationRoot);
        $this->httpServer      = $httpServer;
        $this->replacements    = $replacements;
    }

    /**
     * @return LocalConfigurationParameter
     */
    public static function create(array $config): LocalConfigurationParameter
    {

        $dbData = DbData::create($config);

        $applicationRoot = __DIR__ . '/../../../../';
        $httpServer      = $config['local_server_name'];

        $replacements = Replacements::createFromConfigArray($config);

        return new LocalConfigurationParameter($dbData, $applicationRoot, $httpServer, $replacements);

    }

    /**
     * @return DbData
     */
    public function getDbData(): DbData
    {

        return $this->dbData;
    }

    /**
     * @return string
     */
    public function getApplicationRoot(): string
    {

        return $this->applicationRoot;
    }

    /**
     * @return string
     */
    public function getHttpServer(): string
    {

        return $this->httpServer;
    }

    public function getReplacements(): Replacements
    {

        return $this->replacements;
    }

}