<?php

require 'vendor/autoload.php';

class PageParserTest extends PHPUnit_Framework_TestCase {

  const FIXTURES_DIR = 'tests/fixtures';

  public function testParsesAPage() {
    $markdown_html = "<p>This is a test markdown page.</p>\n<h1>Header!!!</h1>\n<p>This is a<br />\nhard line break.</p>";

    $page = new \Slimdown\PageParser(self::FIXTURES_DIR . '/test_pages/test.md');

    $headers = $page->headers();
    $this->assertEquals('A test slimdown title', $headers['title']);

    $body = $page->body();
    $this->assertEquals($markdown_html, $body);
  }

  public function testHandlesNonExistantPage() {
    $this->setExpectedException('\Slimdown\Exception', 'Page not found');
    $page = new \Slimdown\PageParser(self::FIXTURES_DIR . '/test_pages/bwahahaha.md');
  }

  public function testHandlesPageWithMissingFrontmatter() {
    $page = new \Slimdown\PageParser(self::FIXTURES_DIR . '/test_pages/missing_frontmatter.md');
    $this->assertEquals([], $page->headers());
    $this->assertEquals("<h1>First header</h1>\n<p>Body text.</p>", $page->body());
  }
}
