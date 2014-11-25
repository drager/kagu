<?php

namespace Kagu\Http;

/**
 * Http Response Adapter Interface, our http response adapters will
 * need to implement this if they will get http responses.
 * @package Kagu Http
 */
interface ResponseAdapterInterface {

  function getBody();

  function getHeader($key);

  function setBody($body);

  function setHeaders(array $headers);

  function getHeaders();

  function parseHeaders(array $headers);
}