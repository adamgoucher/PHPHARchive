<?php
require_once(dirname(__FILE__) . '/../PHPHarchive/HAR.php');

class LogVersionTest extends PHPUnit_Framework_TestCase {
  /**
  * @group version
  */  
  public function test_har_version_one_point_one() {
    $h = new PHPHARchive_HAR(dirname(__FILE__) . '/../files/version/one_point_one.har');
    $this->assertEquals("1.1", $h->version);
  }

  /**
  * @group version
  */  
  public function test_har_version_one_point_two() {
    $h = new PHPHARchive_HAR(dirname(__FILE__) . '/../files/version/one_point_two.har');
    $this->assertEquals("1.2", $h->version);
  }

  /**
  * @group version
  */  
  public function test_har_implicit_version() {
    $h = new PHPHARchive_HAR(dirname(__FILE__) . '/../files/version/implicit.har');
    $this->assertEquals("1.1", $h->version);
  }

  /**
  * @group version
  * @expectedException PHPHARchive_UnsupportedVersionException
  * @expectedExceptionMessage 1.3 is not a supported version
  */  
  public function test_har_invalid_version() {
    $h = new PHPHARchive_HAR(dirname(__FILE__) . '/../files/version/one_point_three.har');
  }

  /**
  * @group version
  * @expectedException PHPHARchive_InvalidSchemaException
  * @expectedExceptionMessage version is mandatory
  */  
  public function test_har_missing_version() {
    $h = new PHPHARchive_HAR(dirname(__FILE__) . '/../files/version/missing.har');
  }

}
?>