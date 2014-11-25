<?php

use Kagu\Http;

class RequestTest extends PHPUnit_Framework_TestCase {
  private $request;
  private $url;

  public function setUp() {
    $this->url = "https://github.com";
    $this->request = new \Kagu\Http\RequestAdapter(new Http\Request($this->url));
  }

  public function tearDown() {
    $this->request = null;
    $this->config = null;
  }

  public function testCanSetUrl() {
    $url = "https://www.spotify.com/se/";

    // Set a new url
    $this->request->setUrl($url);

    // Our expected values
    $expectedArray = array("body" => "Testa Premium");

    // Make a request and get our response
    $response = $this->request->get();

    $bodyData = $response->getBody();

    $hasFound = false;

    // Check if we have a string for spotify.
    if (strpos($bodyData, $expectedArray["body"]) !== false) {
      $hasFound = true;
    }

    $this->assertTrue($hasFound);

  }

  public function testCanMakeHttpRequest() {
    // Make a request and get our response
    $response = $this->request->get();

    // Our expected values
    $expectedArray = array("title" => "GitHub · Build software better, together.");

    $bodyData = $response->getBody();

    $hasFound = false;

    // Check if we have a string with GitHub's title.
    if (strpos($bodyData, $expectedArray["title"]) !== false) {
      $hasFound = true;
    }

    $this->assertTrue($hasFound);

  }
}