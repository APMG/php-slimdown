<?php

namespace Slimdown;

# Internal class for managing global configuration.
#
# Only used by singleton Slimdown module.
class Config {

  # Get the path to the markdown pages.
  public $location;

  function __construct() {
    # Set defaults.
    $this->location = 'pages/';
  }
}
