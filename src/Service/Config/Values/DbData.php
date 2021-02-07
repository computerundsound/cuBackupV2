<?php
declare(strict_types=1);

namespace App\Service\Config\Values;

/**
 * Class DbData
 *
 * @package           App\Service\Configuration\Values
 *
 * @psalm-import-type ConfigType from \App\Service\Config\ConfigCreator
 */
class DbData
{

    protected $server;
    protected $userName;
    protected $password;
    protected $dbName;
    protected $port;

    public function __construct(string $server,
                                string $userName,
                                string $password,
                                string $dbName,
                                string $port = '3306')
    {

        $this->server   = $server;
        $this->userName = $userName;
        $this->password = $password;
        $this->dbName   = $dbName;
        $this->port     = $port;
    }

    /**
     *
     * @psalm-param ConfigType $config
     *
     * @return DbData
     */
    public static function create(array $config): DbData
    {

        $server   = $config['local_db_data']['server'];
        $userName = $config['local_db_data']['username'];
        $password = $config['local_db_data']['password'];
        $dbName   = $config['local_db_data']['db_name'];

        return new DbData($server, $userName, $password, $dbName);

    }

    /**
     * @return string
     */
    public function getServer(): string
    {

        return $this->server;
    }

    /**
     * @return string
     */
    public function getUserName(): string
    {

        return $this->userName;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {

        return $this->password;
    }

    /**
     * @return string
     */
    public function getDbName(): string
    {

        return $this->dbName;
    }

    /**
     * @return string
     */
    public function getPort(): string
    {

        return $this->port;
    }


}