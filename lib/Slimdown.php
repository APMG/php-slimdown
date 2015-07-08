<?php

/**
 * The main Slimdown namespace.
 */
namespace Slimdown;

class Slimdown {

  /**
   * The config object.
   * @var \Slimdown\Config
   */
  protected static $config;

  /**
   * Application version.
   */
  const VERSION = '0.1.0';

  /**
   * Sets and retrieves global configuration.
   *
   * If called with a block, the config object will be passed to the block and
   * allow settings to be modified.
   *
   *     \Slimdown\Slimdown::config(function($config) {
   *       $config->set_location('pages');
   *     }
   *
   * The settings object is always returned.
   *
   * @param callable $block Anonymous function to call with config object.
   * @return \Slimdown\Config Object with configuration params.
  */
  public static function config(\Closure $block = null) {
    if (!self::$config) {
      self::$config = new \Slimdown\Config();
    }

    // Allow configuration via a block.
    if ($block) {
      $block(self::$config);
    }

    return self::$config;
  }
}
