<?php

use Kagu\Http;
use Kagu\Exception\NotImplementedException;

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

  /**
  * @expectedException        InvalidArgumentException
  * @expectedExceptionMessage The [NOT_A_URL] is wrong formatted!
  */
  public function testWillThrowExceptionOnInvalidIndex() {
    $url = "NOT_A_URL";

    $this->request->setUrl($url);

    throw new InvalidArgumentException("The [$url] is wrong formatted!", 10);
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

  public function testCanGetUrl() {
    $url = "https://www.spotify.com/se/";

    // Set a new url
    $this->request->setUrl($url);

    $objUrl = $this->request->getUrl();

    $this->assertEquals($url, $objUrl);
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

  /**
  * @expectedException        Kagu\Exception\NotImplementedException
  * @expectedExceptionMessage The PUT METHOD is not implemented just yet!
  */
  public function testWillThrowExceptionOnPutRquest() {
    $data = array("title" => "Kagu", "body" => "Welcome to the Kagu website");

    // Make a put request
    $this->request->put($data);

    throw new Kagu\Exception\NotImplementedException("The PUT METHOD is not implemented just yet!", 10);
  }

  /**
  * @expectedException        Kagu\Exception\NotImplementedException
  * @expectedExceptionMessage The DELETE METHOD is not implemented just yet!
  */
  public function testWillThrowExceptionOnDeleteRquest() {
    // Make a delete request
    $this->request->delete();

    throw new Kagu\Exception\NotImplementedException("The DELETE METHOD is not implemented just yet!", 10);
  }
}