<?php

namespace Kagu\Exception;

/**
 * Exception when a response returns http status 403 (Forbidden)
 * @package Kagu Exception
 */
class HttpStatus403Exception extends \Exception {
  public function __construct($message, $code = 0, \Exception $previous = null) {
    parent::__construct($message, $code, $previous);
  }
}