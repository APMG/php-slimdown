<?php

require 'vendor/autoload.php';

class SlimdownTest extends PHPUnit_Framework_TestCase {
  public function testHasVersionNumber() {
    $this->assertNotNull(\Slimdown\Slimdown::VERSION);
  }

  // .config
  public function testManagesConfiguration() {
    $config = \Slimdown\Slimdown::config(function($c){
      $c->location = 'blahblahblah';
    });

    $this->assertEquals('blahblahblah', $config->location);
  }

  public function testReturnsConfigAfterSettingIt() {
    \Slimdown\Slimdown::config(function($c){
      $c->location = 'blahblahblah';
    });

    $config = \Slimdown\Slimdown::config();

    $this->assertEquals('blahblahblah', $config->location);
  }
}
