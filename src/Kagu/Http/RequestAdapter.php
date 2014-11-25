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
  public function getUrl() {
    return $this->request->getUrl();
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