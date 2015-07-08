<?php

namespace Slimdown;

/**
 * The model representing a page.
 */
class Page {

  private $absolute_path;
  private $parsed_page;
  private $title;
  private $template;

  /**
   * Get new page object
   *
   * @param string $absolute_path The absolute path to this document,
   *   including extension.
   */
  function __construct($absolute_path) {
    # Open the markdown file.
    $this->absolute_path = $absolute_path;

    $this->parsed_page = new PageParser($absolute_path);

    $this->load_headers();
  }

  /**
   * The title from the document headers.
   */
  public function get_title() {
    return $this->title;
  }

  /**
   * The template from the document headers
   */
  public function get_template() {
    return $this->template;
  }

  /**
   * Get page object by relative path.
   *
   * Example:
   *
   *     Slimdown::Page.find('about/contact')
   *
   * @param string $path Relative path to page. Doesn't include extension.
   * @return \Slimdown\Page The page corresponding to this path.
   */
  public static function find($path) {
    # Finds the relative page.
    $config = Slimdown::config();
    $loc = $config->get_location();

    return new self("{$loc}/{$path}.md");
  }

  /**
   * Get the parsed body
   *
   * @return string The parsed Markdown body as html.
   */
  public function body() {
    $this->parsed_page->body();
  }

  /**
   * The sibling pages to this document.
   *
   * @return \Slimdown\Page[] A list of sibling pages.
   */
  public function siblings() {
    # List other markdown files in the same folder.

    # Sibling folder.
    $folder_str = dirname($this->absolute_path);

    $folder = new Folder($folder_str);

    return $folder->pages();
  }

  /**
   * The children of this document.
   *
   * @return \Slimdown\Page[] A list of child pages.
   */
  public function children() {
    # Check to see whether dir exists.
    $folder_str = $this->absolute_path;
    $folder_str = preg_replace('/\.md$/', '', $folder_str);

    $folder = new Folder($folder_str);

    return $folder->pages();
  }

  /**
   * The relative path for this document.
   *
   * @return string The relative path, e.g. 'about/contact'
   */
  public function path() {
    $loc = preg_quote(Slimdown::config()->get_location(), '/');
    $relative = $this->absolute_path;
    $relative = preg_replace("/^{$loc}\//", '', $relative);
    $relative = preg_replace('/\.md$/', '', $relative);

    return $relative;
  }

  /**
   * Parse approved headers into properties.
   */
  private function load_headers() {
    $headers = $this->parsed_page->headers();
    if (isset($headers['title'])) {
      $this->title = $headers['title'];
    }
    if (isset($headers['template'])) {
      $this->template = $headers['template'];
    }
  }
}
