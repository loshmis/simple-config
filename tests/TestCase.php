<?php

use Symfony\Component\Finder\Finder;

class TestCase extends PHPUnit_Framework_TestCase
{
    protected function getExampleConfigDirectoryPath()
    {
        return __DIR__ . '/example-config';
    }

    protected function getLoader()
    {
        return new \Loshmis\SimpleConfig\Loader($this->getExampleConfigDirectoryPath(), new Finder);
    }
}