<?php

namespace Loshmis\SimpleConfig;

use Illuminate\Config\Repository;

class Config extends Repository
{
    /**
     * Initialize the config repository and load files.
     *
     * @param Loader $loader
     */
    public function __construct(Loader $loader)
    {
        parent::__construct();

        $files = $loader->getFiles();

        foreach ( $files as $key => $path ) {
            $this->set($key, require $path);
        }
    }

}