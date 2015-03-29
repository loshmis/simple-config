<?php

class LoaderTest extends TestCase
{
    /** @test */
    public function it_check_if_all_files_are_loaded()
    {
        $files = $this->getLoader()->getFiles();

        $this->assertCount(2, $files);
    }

    /** @test */
    public function it_check_if_array_keys_are_correct()
    {
        $files = $this->getLoader()->getFiles();

        $this->assertArrayHasKey('app', $files);
        $this->assertArrayHasKey('subdir.database', $files);
    }

    /** @test */
    public function it_check_if_array_has_correct_format()
    {
        $files = $this->getLoader()->getFiles();
        $path  = $this->getExampleConfigDirectoryPath();

        $this->assertEquals($path . "/app.php", $files['app']);
        $this->assertEquals($path . "/subdir/database.php", $files['subdir.database']);
    }

}