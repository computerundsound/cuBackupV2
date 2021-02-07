<?php
declare(strict_types=1);


namespace App\Service\Config;


class Replacements
{

    protected $replacementInFile;

    public static function createFromConfigArray(array $config): Replacements
    {

        $replacements = new self();

        $replacementsFiles = $config['replacements'];

        foreach ($replacementsFiles as $file => $replacementsArray) {

            foreach ($replacementsArray as $replacementData) {
                $replacements->addReplacementValues($replacementData['replace'],
                                                    $replacementData['replaceWith'],
                                                    $file);
            }

        }

        return $replacements;

    }

    public function addReplacementValues(string $replace, string $replaceWith, string $file)
    {

        $this->replacementInFile[$file][] = new Replacement($replace, $replaceWith);

    }

    /**
     * @param string $file
     *
     * @return Replacement[]
     */
    public function getReplacements(string $file): array
    {

        return $this->replacementInFile[$file] ?? [];

    }

}