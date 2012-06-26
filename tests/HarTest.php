<?php
require_once(dirname(__FILE__) . '/../PHPHarchive/HAR.php');

class LogVersionTest extends PHPUnit_Framework_TestCase {
  /**
  * @group har
  * @expectedException PHPHARchive_MissingHARException
  * @expectedExceptionMessage foo.har does not exist
  */  
  public function test_no_such_file() {
    $h = new PHPHARchive_HAR("foo.har");
  }
}
?>