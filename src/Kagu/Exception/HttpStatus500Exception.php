<?php

namespace Kagu\Exception;

/**
 * Exception when a response returns http status 500 (Unexpected error)
 * @package Kagu Exception
 */
class HttpStatus500Exception extends \Exception {
  public function __construct($message, $code = 0, \Exception $previous = null) {
    parent::__construct($message, $code, $previous);
  }
}