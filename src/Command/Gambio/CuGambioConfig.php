<?php
declare(strict_types=1);

namespace App\Command\Gambio;

use App\Service\Config\ConfigCreator;
use App\Service\File\FileCreator;
use App\Service\PageSpecific\Gambio\LocalConfiguration;
use App\Service\PageSpecific\Gambio\LocalConfigurationParameter;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

/**
 * Class CuGambioAddFilesCommand
 *
 * @package           App\Command\Gambio
 *
 * @psalm-import-type ConfigType from \App\Service\Config\ConfigCreator
 */
class CuGambioConfig extends Command
{
    protected static $defaultName = 'cu:gambio:config';

    /**
     * @var FileCreator
     */
    protected $fileCreator;
    /**
     * @var LocalConfiguration
     */
    protected $localConfiguration;

    /**
     * CuGambioAddFilesCommand constructor.
     */
    public function __construct(FileCreator $fileCreator, LocalConfiguration $localConfiguration)
    {

        parent::__construct();

        $this->fileCreator        = $fileCreator;
        $this->localConfiguration = $localConfiguration;
    }


    protected function configure(): void
    {

        parent::configure();

        $this->setDescription('Creates config-files for an extracted Shop');
    }

    /** @noinspection PhpMissingParentCallCommonInspection */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {

        /**
         * @var array  $config
         * @var string $shopRoot
         */
        [$config, $shopRoot] = ConfigCreator::createConfig();

        $localConfigurationParameter = LocalConfigurationParameter::create($config);

        $this->localConfiguration->reset($localConfigurationParameter, $shopRoot);

//        $this->fileCreator->createFiles($config['files_to_add'], $shopRoot);

        $this->localConfiguration->createLocalConfiguration($localConfigurationParameter, $shopRoot);


        $io = new SymfonyStyle($input, $output);


        return Command::SUCCESS;
    }

}
