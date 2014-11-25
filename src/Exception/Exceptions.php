<?php

namespace Kagu\Exception;

/**
 * All the Exceptions for the Kagu package
 * @package Kagu Exception
 */

/**
 * Exception when a response returns http status 404
 */
class HttpStatus404Exception extends \Exception {
  public function __construct($message, $code = 0, \Exception $previous = null) {
    parent::__construct($message, $code, $previous);
  }
}

/**
 * Exception just for helping when something is'nt implemented yet
 */
class NotImplementedException extends \BadMethodCallException {
  public function __construct($message, $code = 0, \Exception $previous = null) {
    parent::__construct($message, $code, $previous);
  }
}
