<?php

namespace Kagu\Database;

use Kagu\Config\Config;

/**
 * MysqlAdapter for adapting Mysql to do database queries.
 * @package Kagu Database
 */
class MysqlAdapter implements DatabaseAdapterInterface {

  private $mysql;

  /**
   * @param Mysql $mysql
   * @return void
   */
  public function __construct(Mysql $mysql) {
    $this->mysql = $mysql;
  }

  /**
   * Creates a database conneciton.
   * @return PDO object
   */
  public function connect() {
    return $this->mysql->connect();
  }

  /**
   * Select data from a given table with some parameters
   * @param String $table
   * @param String $fields
   * @param String $where
   * @param Array $params
   * @param String $order
   * @param String $limit
   * @return Array
   */
  public function select($table, $fields = "*", $where = null, array $params = null, $order = null, $limit = null) {
    return $this->mysql->select($table, $fields, $where, $params, $order, $limit);
  }

  /**
   * Insert data into a given table with some data
   * @param String $table
   * @param Array $data
   */
  public function insert($table, array $data) {
    return $this->mysql->insert($table, $data);
  }

  public function delete($table, array $where = null, array $params) {
    return return $this->mysql->delete($table, $where, $params);
  }

  /**
   * Creates the given table, with the given fields
   * @param String $table
   * @param Array $fields
   */
  public function create($table, array $fields) {
    return $this->mysql->create($table, $fields);
  }
}