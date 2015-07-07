<?php

// The main Slimdown namespace.
namespace Slimdown;

class Slimdown {

  protected static $config;

  const VERSION = '1.0.0';

  // Sets and retrieves global configuration.
  //
  // If called with a block, the config object will be passed to the block and
  // allow settings to be modified. This could be done in a Rails initializer:
  //
  //    Slimdown.config do |config|
  //      config.location = Rails.root.join 'pages'
  //    end
  //
  // The settings object is always returned.
  //
  // @param [Proc] block to call with config object.
  // @return [Slimdown::Config] object with configuration params.
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
