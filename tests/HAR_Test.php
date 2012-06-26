<?php
require_once(dirname(__FILE__) . '/../PHPHarchive/HAR.php');

class HARTest extends PHPUnit_Framework_TestCase {
  /**
  * @group har
  * @expectedException PHPHARchive_MissingHARException
  * @expectedExceptionMessage foo.har does not exist
  */  
  public function test_no_such_file() {
    $h = new PHPHARchive_HAR("foo.har");
  }
  
  /**
  * @group har
  */  
  public function test_har_version_one_point_one() {
    $h = new PHPHARchive_HAR(dirname(__FILE__) . '/../files/versions/one_point_one.har');
    $this->assertEquals("1.1", $h->version);
  }

  /**
  * @group har
  * @group adam
  */  
  public function test_har_version_one_point_two() {
    $h = new PHPHARchive_HAR(dirname(__FILE__) . '/../files/versions/one_point_two.har');
    $this->assertEquals("1.2", $h->version);
  }

  /**
  * @group har
  * @group adam
  */  
  public function test_har_implicit_version() {
    $h = new PHPHARchive_HAR(dirname(__FILE__) . '/../files/versions/implicit.har');
    $this->assertEquals("1.1", $h->version);
  }

  /**
  * @group har
  * @group adam
  * @expectedException PHPHARchive_UnsupportedVersionException
  * @expectedExceptionMessage 1.3 is not a supported version
  */  
  public function test_har_invalid_version() {
    $h = new PHPHARchive_HAR(dirname(__FILE__) . '/../files/versions/one_point_three.har');
  }

  /**
  * @group har
  * @group adam
  * @expectedException PHPHARchive_InvalidSchemaException
  * @expectedExceptionMessage version is mandatory
  */  
  public function test_har_missing_version() {
    $h = new PHPHARchive_HAR(dirname(__FILE__) . '/../files/versions/missing.har');
  }

}
?>