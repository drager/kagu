<?php

namespace Kagu\Database;

/**
 * MysqlAdapter for adapting Mysql to do database queries.
 * @package Kagu Database
 */
class Mysql {

  protected $config;

  protected $dbConnection;

  /**
   * @param Array $config
   * @return void
   */
  public function __construct(array $config) {
    if (isset($config["DB_CONNECTION"]) === false) {
      throw new \InvalidArgumentException(
        "To connect to the database we need a connectionstring"
      );
    }
    if (isset($config["DB_USER"]) === false) {
      throw new \InvalidArgumentException(
        "To connect to the database we need a username"
      );
    }
    if (isset($config["DB_PASSWORD"]) === false) {
      throw new \InvalidArgumentException(
        "To connect to the database we need a password"
      );
    }
    $this->config = $config;
  }

  /**
   * Creates a database conneciton.
   * @return PDO object
   */
  public function connect() {

    if ($this->dbConnection === null) {
      $this->dbConnection = new \PDO($this->config["DB_CONNECTION"], $this->config["DB_USER"],
        $this->config["DB_PASSWORD"]);
    }

    $this->dbConnection->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

    return $this->dbConnection;
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
    $db = $this->dbConnection;

    $sql = "SELECT " . $fields . " FROM " . $table . ($where ? " WHERE " . $where . " = ?" : "") .
      ($order ? " ORDER BY " . $order . " DESC" : "");

    $query = $db->prepare($sql);
    $params ? $query->execute($params) : $query->execute();

    $result = $query->fetchAll(\PDO::FETCH_ASSOC);

    if ($result) {
      return $result;
    }

    return null;
  }

  /**
   * Insert data into a given table with some data
   * @param String $table
   * @param Array $data
   */
  public function insert($table, array $data) {
    $db = $this->dbConnection;

    $fields = join(", ", array_keys($data));
    $values = join(", ", array_values($data));
    $params = explode(", ", $values);

    $count = count($data);

    $sql = "INSERT INTO " . $table . " (" . $fields . ") VALUES (";
    for ($i = 0; $i < $count; $i++) {
      $i === $count-1 ? $sql .= "?" : $sql .= "?, ";
    }
    $sql .= ")";

    $query = $db->prepare($sql);

    return $query->execute($params) ? true : false;
  }

  public function delete($table, array $where = null, array $params = null) {
    $db = $this->dbConnection;

    if ($where > 1) {
      $where = join(" = ? AND ", array_values($where));
    }

    $sql = "DELETE FROM " . $table . ($where ? " WHERE " . $where . " = ?" : "");

    $query = $db->prepare($sql);

    $params ? $query->execute($params) : $query->execute();

    return $query->rowCount() ? true : false;
  }

  /**
   * Creates the given table, with the given fields
   * @param String $table
   * @param Array $fields
   */
  public function create($table, array $fields) {
    $db = $this->dbConnection;

    $data = join(", ", array_keys($fields));
    $values = join(", ", array_values($fields));
    $params = explode(", ", $values);

    $fieldsCount = count($fields);
    $count = 0;

    $new = "";

    foreach ($fields as $key => $value) {
      $count++;
      $count === $fieldsCount ? $new .= $key . " " . $value : $new .= $key . " " . $value . ", ";
    }

    $sql = "CREATE TABLE " . $table . " (" . $new . ")";

    return true;
  }
}