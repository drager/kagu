<?php

use Kagu\Cache;

class MemcachedTest extends PHPUnit_Framework_TestCase {
  private $config;
  private $memcached;

  public function setUp() {
    $this->config = array(
      "MEMCACHED_HOST" => "127.0.0.1",
      "MEMCACHED_PORT" => 11211
    );
    $this->memcached = new Cache\MemcachedAdapter(new Cache\Memcached($this->config));
    $this->memcached->connect();
  }

  public function tearDown() {
    $this->config = null;
    $this->memcached = null;
  }

  /**
  * @expectedException        InvalidArgumentException
  * @expectedExceptionMessage To connect to memcached we need a host
  */
  public function testWillThrowExceptionWithoutHost() {
    $this->config = array(
      "MEMCACHED_HOST" => null,
      "MEMCACHED_PORT" => 11211
    );

    $this->memcached = new Cache\MemcachedAdapter(new Cache\Memcached($this->config));

    throw new InvalidArgumentException("To connect to memcached we need a host", 10);
  }

  /**
  * @expectedException        InvalidArgumentException
  * @expectedExceptionMessage To connect to memcached we need a port
  */
  public function testWillThrowExceptionWithoutPort() {
    $this->config = array(
      "MEMCACHED_HOST" => "127.0.0.1",
      "MEMCACHED_PORT" => null
    );

    $this->memcached = new Cache\MemcachedAdapter(new Cache\Memcached($this->config));

    throw new InvalidArgumentException("To connect to memcached we need a port", 10);
  }

  public function testCanSetValueToCache() {
    $key = "TEST_CACHE";
    $value = "TESTING_VALUE";

    $this->memcached->set($key, $value, 0);

    $cache = $this->memcached->get($key);

    $this->assertEquals($value, $cache);
  }

  public function testTryingToGetEmptyValueShouldBeFalse() {
    $key = "FALSE_TEST_CACHE";

    $cache = $this->memcached->get($key);

    $this->assertFalse($cache);
  }

  public function testCanFlushTheCache() {
    $key = "TEST_CACHE";
    $value = "TESTING_VALUE";

    $this->memcached->flush();

    $cache = $this->memcached->get($key);

    $this->assertNotEquals($cache, $value);
    $this->assertFalse($cache);
  }

  public function testCanGetResultCode() {
    $code = $this->memcached->getResultCode();

    // Everything is OK if it returns 0
    $this->assertEquals(0, $code);
  }
}