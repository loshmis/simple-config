<?php

namespace Loshmis\SimpleConfig;

use Symfony\Component\Finder\Finder;
use Symfony\Component\Finder\SplFileInfo;

class Loader
{
    /**
     * @var
     */
    private $configPath;

    /**
     * @var Finder
     */
    private $finder;

    public function __construct($configPath, Finder $finder)
    {
        $this->configPath = $configPath;
        $this->finder = $finder;
    }

    public function getFiles()
    {
        $files = [];

        foreach ($this->finder->files()->name('*.php')->in($this->configPath) as $file) {
            $nesting = $this->getConfigurationNesting($file);
            $files[$nesting.basename($file->getRealPath(), '.php')] = $file->getRealPath();
        }

        return $files;
    }

    /**
     * Get the configuration file nesting path.
     *
     * @param  \Symfony\Component\Finder\SplFileInfo  $file
     * @return string
     */
    private function getConfigurationNesting(SplFileInfo $file)
    {
        $directory = dirname($file->getRealPath());

        if ($tree = trim(str_replace($this->configPath, '', $directory), DIRECTORY_SEPARATOR)) {
            $tree = str_replace(DIRECTORY_SEPARATOR, '.', $tree).'.';
        }

        return $tree;
    }

}