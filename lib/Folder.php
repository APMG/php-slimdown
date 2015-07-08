<?php

namespace Slimdown;

# Internal class for retrieving information about a folder.
class Folder {

  private $absolute_path;

  public function __construct($absolute_path) {
    $this->absolute_path = $absolute_path;
  }

  # Returns a list of markdown files in the folder.
  #
  # @return [Array<String>] List of paths.
  public function markdown_files() {
    if (!file_exists($this->absolute_path)) {
      return [];
    }

    return glob($this->absolute_path . '/*.md');
  }

  # Returns a list of page objects in the folder.
  #
  # @return [Array<Slimdown::Page>] List of pages.
  public function pages() {
    $pages = [];

    foreach ($this->markdown_files() as $file) {
      $pages[] = new Page($file);
    }

    return $pages;
  }
}
