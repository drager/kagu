<?php

namespace Kagu\Http;

/**
 * ResponseAdapter for adapting Response to get http responses.
 * @package Kagu Http
 */
class ResponseAdapter implements ResponseAdapterInterface {

  private $response;

  /**
   * @param Response $response
   * @return void
   */
  public function __construct(Response $response) {
    $this->response = $response;
  }
  /**
   * @return String body
   */
  public function getBody() {
    return $this->response->getBody();
  }

  /**
   * Get the given header specified by a key.
   * @param String $key
   * @return String
   */
  public function getHeader($key) {
    return $this->response->getHeader($key);
  }

  /**
   * @param String $body
   */
  private function setBody($body) {
    $this->response->setBody($body);
  }

  /**
   * @param Array $headers
   */
  private function setHeaders(array $headers) {
    $this->response->setHeaders($headers);
  }

  /**
   * @return Array
   */
  public function getHeaders() {
    return $this->response->getHeaders();
  }

  /**
   * Takes the response headers and parses them so we later on
   * can get them specified by String key name rather than by
   * numeric index. Instead ["SERVER"] rather than [1].
   * @param Array $headers
   * @return Array
   */
  private function parseHeaders(array $headers) {
    return $this->response->parseHeaders($headers);
  }


}