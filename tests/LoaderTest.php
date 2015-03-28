<?php

use Symfony\Component\Finder\Finder;

class LoaderTest extends PHPUnit_Framework_TestCase {


    /** @test */
    public function it_check_if_all_files_are_loaded()
    {
        $files = $this->getLoader()->getFiles();

        $this->assertCount(3, $files);
    }

    /** @test */
    public function it_check_if_array_keys_are_correct()
    {
        $files = $this->getLoader()->getFiles();

        $this->assertArrayHasKey('app', $files);
        $this->assertArrayHasKey('database', $files);
        $this->assertArrayHasKey('subdir.test', $files);
    }

    /** @test */
    public function it_check_if_array_has_correct_format()
    {
        $files = $this->getLoader()->getFiles();
        $path  = $this->getStubsPath();

        $this->assertEquals($path . "/app.php", $files['app']);
        $this->assertEquals($path . "/database.php", $files['database']);
        $this->assertEquals($path . "/subdir/test.php", $files['subdir.test']);
    }

    private function getStubsPath()
    {
        return __DIR__ . '/stubs';
    }

    private function getLoader()
    {
        return new \Loshmis\SlimConfig\Loader($this->getStubsPath(), new Finder);
    }

}