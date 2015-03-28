<?php

namespace Loshmis\SlimConfig;

use Illuminate\Config\Repository;
use Symfony\Component\Finder\Finder;

class Config {

    /**
     * Load the configuration.
     *
     * @param $configPath
     * @return Repository
     */
    public function load($configPath)
    {
        $loader = new Loader($configPath, new Finder);

        $files = $loader->getFiles();

        return $this->buildRepository($files);
    }

    /**
     * Build configuration repository.
     *
     * @param $files
     * @return Repository
     */
    private function buildRepository($files)
    {
        $config = new Repository;

        foreach ( $files as $key => $path ) {
            $config->set($key, require $path);
        }

        return $config;
    }


}