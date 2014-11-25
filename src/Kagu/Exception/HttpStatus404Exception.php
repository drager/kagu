<?php

namespace Kagu\Exception;

/**
 * Exception when a response returns http status 404
 * @package Kagu Exception
 */
class HttpStatus404Exception extends \Exception {
  public function __construct($message, $code = 0, \Exception $previous = null) {
    parent::__construct($message, $code, $previous);
  }
}