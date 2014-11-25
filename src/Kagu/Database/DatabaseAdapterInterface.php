<?php

namespace Kagu\Database;

/**
 * Database Adapter Interface, our database adapters will
 * need to implement this if they will make database queries.
 * @package Kagu Database
 */
interface DatabaseAdapterInterface {

  function connect();

  function select($table, $fields = "*", $where = null, array $params = null, $order = null, $limit = null);

  function insert($table, array $data);

  function delete($table, array $where = null, array $params);

  function create($table, array $fields);
}