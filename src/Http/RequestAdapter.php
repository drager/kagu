<?php

namespace Kagu\Http;

/**
 * RequestAdapter for adapting Request to do http requests.
 * @package Kagu Http
 */
class RequestAdapter implements RequestAdapterInterface {

  private $request;

  /**
   * @param Request $request
   * @return void
   */
  public function __construct(Request $request) {
    $this->request = $request;
  }

  /**
   * @param String $url
   */
  public function setUrl($url) {
    return $this->request->setUrl($url);
  }

  /**
   * @return String $url
   */
  public function getUrl($key) {
    return $this->request->getHeader($key);
  }

  /**
   * @param String $method, defaults to the GET method.
   * @param Boolean $ignore_errors, defaults to true.
   * @param Integer $follow_location, defaults to 0.
   * @return Array
   */
  private function getContext($method = self::METHOD_GET, $ignore_errors = true, $follow_location = 0, array $data = null) {
    return $this->request->getContext($method, $ignore_errors, $follow_location, $data)
  }

  /**
   * @param Array $options
   * @return Streaming object
   */
  private function createStream($options = array()) {
    return $this->request->createStream($options);
  }

  /**
   * Makes a http get request to then given url
   * @param String $url
   * @param Array $options
   * @return Response object
   */
  public function get() {
    return $this->request->get();
  }

  /**
   * Makes a http post request to then given url
   * @param String $url
   * @return Response object
   */
  public function post(array $data) {
    return $this->request->post($data);
  }

  /**
   * Makes a http put request to then given url
   * @param String $url
   * @return Response object
   */
  public function put(array $data) {
    return $this->request->put($data);
  }

  /**
   * Makes a http delete request to then given url
   * @param String $url
   * @return Response object
   */
  public function delete() {
    return $this->request->delete();
  }

}