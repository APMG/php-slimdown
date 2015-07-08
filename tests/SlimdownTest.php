<?php

require 'vendor/autoload.php';

class SlimdownTest extends PHPUnit_Framework_TestCase {
  public function testHasVersionNumber() {
    $this->assertNotNull(\Slimdown\Slimdown::VERSION);
  }

  // .config
  public function testManagesConfiguration() {
    $config = \Slimdown\Slimdown::config(function($c){
      $c->set_location('blahblahblah');
    });

    $this->assertEquals('blahblahblah', $config->get_location());
  }

  public function testReturnsConfigAfterSettingIt() {
    \Slimdown\Slimdown::config(function($c){
      $c->set_location('blahblahblah');
    });

    $config = \Slimdown\Slimdown::config();

    $this->assertEquals('blahblahblah', $config->get_location());
  }
}
