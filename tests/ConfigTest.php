<?php

use Loshmis\SimpleConfig\Config;

class ConfigTest extends TestCase
{
    protected $config;

    public function setUp()
    {
        parent::setUp();

        $this->config = new Config($this->getLoader());
    }

    /** @test */
    public function it_checks_if_config_repository_is_created_correctly()
    {
        $this->assertTrue($this->config->has('app'));
        $this->assertTrue($this->config->has('app.name'));
        $this->assertTrue($this->config->has('app.address'));
        $this->assertTrue($this->config->has('app.address.number'));
        $this->assertTrue($this->config->has('subdir.database'));
        $this->assertTrue($this->config->has('subdir.database.default'));
        $this->assertTrue($this->config->has('subdir.database.fetch'));
        $this->assertTrue($this->config->has('subdir.database.connections.mysql'));
        $this->assertTrue($this->config->has('subdir.database.connections.mysql.host'));
    }

    /** @test */
    public function it_check_that_repository_has_correct_values()
    {
        $this->assertEquals('Simple Config', $this->config->get('app.name'));
        $this->assertEquals(23, $this->config->get('app.address.number'));
        $this->assertEquals('My Street', $this->config->get('app.address.street'));
        $this->assertEquals('mysql', $this->config->get('subdir.database.default'));
        $this->assertEquals(PDO::FETCH_CLASS, $this->config->get('subdir.database.fetch'));
        $this->assertEquals('localhost', $this->config->get('subdir.database.connections.mysql.host'));
    }

}