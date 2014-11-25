<?php

namespace Kagu\Cache;

use Kagu\Config\Config;

/**
 * Memcached for touching the cache.
 * @package Kagu Cache
 */
class Memcached {

  private $config;

  private $memcached;

  /**
   * @param Array $config
   * @return void
   */
  public function __construct(array $config) {
    if (isset($config["MEMCACHED_HOST"]) === false) {
      throw new \InvalidArgumentException(
        "To connect to memcached we need a host"
      );
    }
    if (isset($config["MEMCACHED_PORT"]) === false) {
      throw new \InvalidArgumentException(
        "To connect to memcached we need a port"
      );
    }
    $this->config = $config;

    $this->memcached = new \Memcached();

    if ($this->connect() === false) {
      throw new \Exception("Trouble connecting to memcached!");
    }
  }

  /**
   * Connect to memcached
   * @return Memcached object
   */
  public function connect() {
    $memcached = $this->memcached->addServer($this->config["MEMCACHED_HOST"], $this->config["MEMCACHED_PORT"]);

    return $memcached;
  }

  /**
   * Get the given value from the cache
   * @param String $key
   * @return String
   */
  public function get($key) {
    $value = $this->memcached->get($key);

    return $value;
  }

  /**
   * Set the given value at key place
   * @param String $key
   * @param String $value
   * @return void
   */
  public function set($key, $value, $time = 0) {
    $this->memcached->set($key, $value, $time);
  }

  /**
   * Flush (empty the cache)
   */
  public function flush() {
    $this->memcached->flush();
  }

  public function getResultCode() {
    return $this->memcached->getResultCode();
  }
}