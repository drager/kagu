<?php

require __DIR__.'/../../vendor/autoload.php';

use Kagu\Config\Config;

class ConfigTest extends PHPUnit_Framework_TestCase {

  public function testCanLoadFile() {
    $config = new Config("../kagu/tests/Config/TestConfigFile.php");
  }

  public function testCanGetSpecificIndexFromFile() {
    $config = new Config("../kagu/tests/Config/TestConfigFile.php");

    $debug = $config->get("DEBUG");

    $this->assertEquals($debug, true);
  }

  /**
  * @expectedException        InvalidArgumentException
  * @expectedExceptionMessage The index: SOMETHING_THAT_DOES_NOT_EXIST does not exist
  */
  public function testWillThrowExceptionOnInvalidIndex() {
    $config = new Config("../kagu/tests/Config/TestConfigFile.php");

    $config->get("SOMETHING_THAT_DOES_NOT_EXIST");

    throw new InvalidArgumentException("The index: SOMETHING_THAT_DOES_NOT_EXIST does not exist", 10);
  }

  /**
  * @expectedException        InvalidArgumentException
  * @expectedExceptionMessage The file name: SomeFile.php does not exist
  */
  public function testWillThrowExceptionOnFileNotFound() {
    $config = new Config("SomeFile.php");

    throw new InvalidArgumentException("The file name: SomeFile.php does not exist", 10);
  }

  /**
  * @expectedException        InvalidArgumentException
  * @expectedExceptionMessage The file does not return an array
  */
  public function testWillThrowExceptionWhenFileDoesNotReturnArray() {
    $config = new Config("../kagu/tests/Config/ConfigFileNoArray.php");

    throw new InvalidArgumentException("The file does not return an array");
  }
}