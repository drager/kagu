<?php

namespace Kagu\Exception;

/**
 * Exception when a response returns http status 422 (Unprocessable Entity)
 * @package Kagu Exception
 */
class HttpStatus422Exception extends \Exception {
  public function __construct($message, $code = 0, \Exception $previous = null) {
    parent::__construct($message, $code, $previous);
  }
}