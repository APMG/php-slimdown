<?php

// require 'yaml'
// require 'kramdown'

namespace Slimdown;

# Internal class to manage parsing the markdown document.
class PageParser {

  private $path;
  private $document;

  private $parser;

  # @param [String] path The absolute path to the markdown document.
  function __construct($path) {
    $this->path = $path;

    $this->parser = new \Mni\FrontYAML\Parser();

    $this->parse_file();
  }

  # A hash of the headers in the document
  #
  # Example:
  #     {
  #       "title" => "Test title",
  #       "template" => "test_template",
  #     }
  #
  # @return [Hash] document headers
  function headers() {
    $head = $this->document->getYAML();
    if ($head) {
      return $head;
    } else {
      return [];
    }
  }

  # The parsed markdown document body.
  #
  # @return [Kramdown::Document] a markdown document object.
  function body() {
    return $this->document->getContent();
  }

  private function parse_file() {
    if (!file_exists($this->path)) {
      throw new Exception('Page not found');
    }

    $str = file_get_contents($this->path);
    $this->document = $this->parser->parse($str);
  }

}
