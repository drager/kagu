<?php

use Kagu\Database;

class MysqlTest extends PHPUnit_Framework_TestCase {
  private $config;
  private $dbConnection;

  public function setUp() {
    $this->config = array(
      "DB_CONNECTION" => "mysql:host=127.0.0.1;dbname=kagu",
      "DB_USER" => "root",
      "DB_PASSWORD" => ""
    );
    $this->dbConnection = new Database\MysqlAdapter(new Database\Mysql($this->config));
  }

  public function tearDown() {
    $this->config = null;
    $this->dbConnection = null;
  }

  /**
  * @expectedException        InvalidArgumentException
  * @expectedExceptionMessage To connect to the database we need a connectionstring
  */
  public function testWillThrowExceptionWithoutConnectionString() {
    $this->config = array(
      "DB_CONNECTION" => null,
      "DB_USER" => "root",
      "DB_PASSWORD" => ""
    );

    $this->dbConnection = new Database\MysqlAdapter(new Database\Mysql($this->config));

    throw new InvalidArgumentException("To connect to the database we need a connectionstring", 10);
  }

  /**
  * @expectedException        InvalidArgumentException
  * @expectedExceptionMessage To connect to the database we need a username
  */
  public function testWillThrowExceptionWithoutDbUser() {
    $this->config = array(
      "DB_CONNECTION" => "mysql:host=127.0.0.1;dbname=kagu",
      "DB_USER" => null,
      "DB_PASSWORD" => ""
    );

    $this->dbConnection = new Database\MysqlAdapter(new Database\Mysql($this->config));

    throw new InvalidArgumentException("To connect to the database we need a username", 10);
  }

  /**
  * @expectedException        InvalidArgumentException
  * @expectedExceptionMessage To connect to the database we need a password
  */
  public function testWillThrowExceptionWithoutDbPassword() {
    $this->config = array(
      "DB_CONNECTION" => "mysql:host=127.0.0.1;dbname=kagu",
      "DB_USER" => "root",
      "DB_PASSWORD" => null
    );

    $this->dbConnection = new Database\MysqlAdapter(new Database\Mysql($this->config));

    throw new InvalidArgumentException("To connect to the database we need a password", 10);
  }

  public function testCanConnectToMysqlDatabase() {
    $db = $this->dbConnection->connect();

    $this->assertInstanceOf('PDO', $db);
  }

  public function testCanInsertData() {
    $db = $this->dbConnection->connect();

    $expectedArrayFirst = array(
      "username" => "drager",
      "password" => "password",
      "created_at" => date('Y-m-d H:i:s'),
      "updated_at" => date('Y-m-d H:i:s')
    );

    $expectedArraySecond = array(
      "username" => "asdasd",
      "password" => "password",
      "created_at" => date('Y-m-d H:i:s'),
      "updated_at" => date('Y-m-d H:i:s')
    );

    $table = "users";

    // Get our result from the database
    $resultOne = $this->dbConnection->insert($table, $expectedArrayFirst);
    $resultTwo = $this->dbConnection->insert($table, $expectedArraySecond);

    $this->assertTrue($resultOne);
    $this->assertTrue($resultTwo);
  }

  public function testCanSelectData() {
    $db = $this->dbConnection->connect();

    $expectedArray = array(
      "username" => "drager",
      "password" => "password"
    );

    $table = "users";

    // Get our result from the database
    $result = $this->dbConnection->select($table);

    $this->assertEquals($expectedArray["username"], $result[0]["username"]);
    $this->assertEquals($expectedArray["password"], $result[0]["password"]);
  }

  public function testCanDeleteData() {
    $db = $this->dbConnection->connect();

    $expectedArray = array("asdasd");

    $where = array("username");

    $table = "users";

    // Get our result from the database
    $result = $this->dbConnection->delete($table, $where, $expectedArray);

    $this->assertTrue($result);
  }

  public function testCanSelectDataButIsNulled() {
    $db = $this->dbConnection->connect();

    $table = "users";

    // Remove the old data...
    $this->dbConnection->delete($table);

    // Get our result from the database
    $result = $this->dbConnection->select($table);

    $this->assertNull($result);
  }

  public function testCanCreateDatabase() {
    $db = $this->dbConnection->connect();

    // Create a test database
    $testDB = $this->dbConnection->create(
      "test",
      array(
        "id" => "INT NOT NULL AUTO_INCREMENT PRIMARY KEY, username VARCHAR(255) NOT NULL",
        "password" => "VARCHAR(255) NOT NULL",
        "created_at" => "DATETIME NOT NULL",
        "updated_at" => "DATETIME NOT NULL"
      )
    );

    $this->assertTrue($testDB);
  }
}


