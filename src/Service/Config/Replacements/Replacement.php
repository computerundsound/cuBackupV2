<?php
declare(strict_types=1);


namespace App\Service\Config;


class Replacement
{

    protected $replacePattern;
    protected $replaceWith;

    /**
     * Replacement constructor.
     *
     * @param $replacePattern
     * @param $replaceWith
     */
    public function __construct(string $replacePattern, string $replaceWith)
    {

        $this->replacePattern = $replacePattern;
        $this->replaceWith    = $replaceWith;
    }

    public function getReplacePattern(): string
    {

        return $this->replacePattern;
    }

    public function getReplaceWith(): string
    {

        return $this->replaceWith;
    }


}