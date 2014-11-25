<?php

namespace Kagu\Cache;

/**
 * Cache Adapter Interface, our caching adapters will
 * need to implement this if they will touch the cache.
 * @package Kagu Cache
 */
interface CacheAdapterInterface {

  function connect();

  function get($key);

  function set($key, $value);

  function flush();

  function getResultCode();
}