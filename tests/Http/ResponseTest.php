<?php

use Kagu\Http;
use Kagu\Exception;

class ResponseTest extends PHPUnit_Framework_TestCase {
  private $request;
  private $response;
  private $url;

  public function setUp() {
    $this->url = "https://github.com";
    $this->request = new \Kagu\Http\RequestAdapter(new Http\Request($this->url));
    // $this->response = $this->request->get();
  }

  public function tearDown() {
    $this->request = null;
    $this->response = null;
  }

  /**
  * @expectedException        Kagu\Exception\HttpStatus401Exception
  * @expectedExceptionMessage Unauthorized.
  */
  public function testWillThrowExceptionOnStatus401() {
    $url = "https://api.github.com/user";

    $this->request->setUrl($url);

    $this->request->get();

    throw new Exception\HttpStatus401Exception("Unauthorized.");
  }

  /**
  * @expectedException        Kagu\Exception\HttpStatus403Exception
  * @expectedExceptionMessage Forbidden.
  */
  public function testWillThrowExceptionOnStatus403() {
    $url = "https://github.com/drager/kagu.git/info/refs";

    $this->request->setUrl($url);

    $this->request->get();

    throw new Exception\HttpStatus403Exception("Forbidden.");
  }

  /**
  * @expectedException        Kagu\Exception\HttpStatus404Exception
  * @expectedExceptionMessage Page not found.
  */
  public function testWillThrowExceptionOnStatus404() {
    $url = "https://github.com/not_a_valid_url";

    $this->request->setUrl($url);

    $this->request->get();

    throw new Exception\HttpStatus404Exception("Page not found.");
  }

  /**
  * @expectedException        Kagu\Exception\HttpStatus422Exception
  * @expectedExceptionMessage Unprocessable Entity.
  */
  public function testWillThrowExceptionOnStatus422() {
    $url = "https://api.github.com/search/users";

    $this->request->setUrl($url);

    $response = $this->request->post(array("ASD" => "ASD"));

    throw new Exception\HttpStatus422Exception("Unprocessable Entity.");
  }

  /**
  * @expectedException        Kagu\Exception\HttpStatus500Exception
  * @expectedExceptionMessage Something unexpected happend.
  */
  public function testWillThrowExceptionOnStatus500() {
    $url = "http://jesperh.se/500/";

    $this->request->setUrl($url);

    $response = $this->request->post(array("ASD" => "ASD"));

    throw new Exception\HttpStatus500Exception("Something unexpected happend.");
  }

  public function testCanGetBody() {
    $expectedArray = array("title" => "GitHub · Build software better, together.");

    $response = $this->request->get();

    $bodyData = $response->getBody();

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

    $response = $this->request->get();

    $server = $response->getHeader($key);

    $this->assertEquals($expectedArray[$key], $server);
  }

  public function testCanGetHeaders() {
    $key = "Server";

    $expectedArray = array("Server" => "GitHub.com");

    $response = $this->request->get();

    $headers = $response->getHeaders();

    $hasFound = false;
    foreach($headers as $header) {
      if ($expectedArray[$key] == $header) {
        $hasFound = true;
      }
    }

    $this->assertTrue($hasFound);
  }
}