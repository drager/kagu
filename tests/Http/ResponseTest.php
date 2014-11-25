<?php

use Kagu\Http;

class ResponseTest extends PHPUnit_Framework_TestCase {
  private $request;
  private $response;
  private $url;

  public function setUp() {
    $this->url = "https://github.com";
    $this->request = new \Kagu\Http\RequestAdapter(new Http\Request($this->url));
    $this->response = $this->request->get();
  }

  public function tearDown() {
    $this->request = null;
    $this->response = null;
  }

  public function testCanGetBody() {
    $expectedArray = array("title" => "GitHub · Build software better, together.");

    $bodyData = $this->response->getBody();

    $hasFound = false;

    // Check if we have a string with GitHub's title.
    if (strpos($bodyData, $expectedArray["title"]) !== false) {
      $hasFound = true;
    }

    $this->assertTrue($hasFound);
  }

  public function testCanGetHeaderByKey() {
    $key = "Server";

    $expectedArray = array("Server" => "GitHub.com");

    $server = $this->response->getHeader($key);

    $this->assertEquals($expectedArray[$key], $server);
  }

  public function testCanGetHeaders() {
    $key = "Server";

    $expectedArray = array("Server" => "GitHub.com");

    $headers = $this->response->getHeaders();

    $hasFound = false;
    foreach($headers as $header) {
      if ($expectedArray[$key] == $header) {
        $hasFound = true;
      }
    }

    $this->assertTrue($hasFound);
  }
}