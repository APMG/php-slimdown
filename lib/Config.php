<?php

namespace Slimdown;

/**
 * Internal class for managing global configuration.
 *
 * Only used by singleton Slimdown module.
 */
class Config {

  /**
   * Get the path to the markdown pages.
   * @var string
   */
  private $location;

  /**
   * Constructor for Config.
   *
   * Sets the default location.
   */
  function __construct() {
    # Set defaults.
    $this->location = 'pages/';
  }

  /**
   * Getter for location.
   *
   * @return string Location of markdown files.
   */
  public function get_location() {
    return $this->location;
  }

  /**
   * Setter for location.
   *
   * @param string $location Location of markdown files.
   */
  public function set_location($location) {
    $this->location = $location;
  }
}
