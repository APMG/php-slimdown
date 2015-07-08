<?php

namespace Slimdown;

# Internal class for managing global configuration.
#
# Only used by singleton Slimdown module.
class Config {

  # Get the path to the markdown pages.
  private $location;

  function __construct() {
    # Set defaults.
    $this->location = 'pages/';
  }

  public function get_location() {
    return $this->location;
  }

  public function set_location($location) {
    $this->location = $location;
  }
}
