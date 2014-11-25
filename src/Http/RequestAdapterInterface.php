<?php

namespace Kagu\Http;

/**
 * Http Request Adapter Interface, our http request adapters will
 * need to implement this if they will make http requests.
 * @package Kagu Http
 */
interface RequestAdapterInterface {

  function setUrl($url);

  function getUrl();

  function get();

  function post(array $data);

  function put(array $data);

  function delete();
}