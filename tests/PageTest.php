<?php

require 'vendor/autoload.php';

class PageTest extends PHPUnit_Framework_TestCase {

  const FIXTURES_DIR = 'tests/fixtures';

  function setUp() {
    \Slimdown\Slimdown::config(function($c) {
      $c->set_location(self::FIXTURES_DIR . '/test_pages');
    });
  }

  public function testIsSane() {
    $page = new \Slimdown\Page(self::FIXTURES_DIR . '/test_pages/test.md');

    $this->assertEquals('', $page->body());
    $this->assertEquals('test', $page->get_template());
  }

  public function testHandlesNonExistantPage() {
    $this->setExpectedException('\Slimdown\Exception', 'Page not found');

    $page = new \Slimdown\Page(self::FIXTURES_DIR . '/test_pages/bwahahaha.md');
  }

  // .find
  public function testHandlesRootPage() {
    $page = \Slimdown\Page::find('test');

    $this->assertEquals('A test slimdown title', $page->get_title());
  }

  // #siblings
  public function testWorks() {
    $page = \Slimdown\Page::find('test');

    $siblings = $page->siblings();
    $this->assertEquals(3, count($siblings));
    $this->assertNull($siblings[0]->get_title());
    $this->assertEquals('A test sibling title', $siblings[1]->get_title());
    $this->assertEquals('A test slimdown title', $siblings[2]->get_title());
  }

  // #children
  public function testReturnsChildren() {
    $page = \Slimdown\Page::find('test');
    $children = $page->children();
    $this->assertEquals(1, count($children));
    $child = $children[0];
    $this->assertEquals('test/child', $child->path());
    $this->assertEquals('A test child title', $child->get_title());
  }

  public function testReturnsEmptyArrayWhenNoChildren() {
    $page = \Slimdown\Page::find('test/child');
    $children = $page->children();
    $this->assertEquals(0, count($children));
  }

  // #path
  public function testWorksAtRootLevel() {
    $page = \Slimdown\Page::find('test');
    $this->assertEquals('test', $page->path());
  }

  public function testWorksAtChildLevel() {
    $page = \Slimdown\Page::find('test/child');
    $this->assertEquals('test/child', $page->path());
  }
}
