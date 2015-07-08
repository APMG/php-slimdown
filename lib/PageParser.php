<?php

namespace Slimdown;

/**
 * Internal class to manage parsing the markdown document.
 */
class PageParser {

  /**
   * The absolute path to the markdown document.
   * @var string
   */
  private $path;

  /**
   * The document object.
   * @var \Mni\FrontYAML\Document;
   */
  private $document;

  /**
   * The parser.
   * @var \Mni\FrontYAML\Parser;
   */
  private $parser;

  /**
   * Constructor for PageParser
   * @param string $path The absolute path to the markdown document.
   */
  function __construct($path) {
    $this->path = $path;

    $this->parser = new \Mni\FrontYAML\Parser();

    $this->parse_file();
  }

  /**
   * A hash of the headers in the document
   *
   * Example:
   *
   *     {
   *       "title" => "Test title",
   *       "template" => "test_template",
   *     }
   *
   * @return string[] Document headers
   */
  function headers() {
    $head = $this->document->getYAML();
    if ($head) {
      return $head;
    } else {
      return [];
    }
  }

  /**
   * The parsed markdown document body.
   *
   * @return string A markdown html body.
   */
  function body() {
    return $this->document->getContent();
  }

  /**
   * Parse the file.
   */
  private function parse_file() {
    if (!file_exists($this->path)) {
      throw new Exception('Page not found');
    }

    $str = file_get_contents($this->path);
    $this->document = $this->parser->parse($str);
  }

}
