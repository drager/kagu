<?php

namespace Kagu\Exception;

/**
 * Exception just for helping when something is'nt implemented yet
 * @package Kagu Exception
 */
class NotImplementedException extends \BadMethodCallException {
  public function __construct($message, $code = 0, \Exception $previous = null) {
    parent::__construct($message, $code, $previous);
  }
}
