<?php

use Symfony\Component\Finder\Finder;

class LoaderTest extends PHPUnit_Framework_TestCase {



    private function getStubsPath()
    {
        return __DIR__ . '/stubs';
    }

    private function getLoader()
    {
        return new \Loshmis\SlimConfig\Loader($this->getStubsPath(), new Finder);
    }

}