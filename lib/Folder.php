<?php

namespace Slimdown;

/**
 * Internal class for retrieving information about a folder.
 */
class Folder {

  /**
   * Holds the absolute folder path.
   * @var string
   */
  private $absolute_path;

  /**
   * Constructor for Folder.
   *
   * @param string $absolute_path The absolute path to the folder.
   */
  public function __construct($absolute_path) {
    $this->absolute_path = $absolute_path;
  }

  /**
   * Returns a list of markdown files in the folder.
   *
   * @return string[] List of paths.
   */
  public function markdown_files() {
    if (!file_exists($this->absolute_path)) {
      return [];
    }

    return glob($this->absolute_path . '/*.md');
  }

  /**
   * Returns a list of page objects in the folder.
   *
   * @return \Slimdown\Page[] List of pages.
   */
  public function pages() {
    $pages = [];

    foreach ($this->markdown_files() as $file) {
      $pages[] = new Page($file);
    }

    return $pages;
  }
}
