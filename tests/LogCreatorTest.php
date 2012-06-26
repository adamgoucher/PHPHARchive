<?php
require_once(dirname(__FILE__) . '/../PHPHarchive/HAR.php');

class LogCreatorTest extends PHPUnit_Framework_TestCase {
  /**
  * @group creator
  * @expectedException PHPHARchive_InvalidSchemaException
  */
  public function test_creator_missing() {
    $h = new PHPHARchive_HAR(dirname(__FILE__) . '/../files/creator/missing.har');
  }

  /**
  * @group creator
  * @expectedException PHPHARchive_InvalidSchemaException
  */
  public function test_creator_name_missing() {
    $h = new PHPHARchive_HAR(dirname(__FILE__) . '/../files/creator/name_missing.har');
  }

  /**
  * @group creator
  * @group adam
  * @expectedException PHPHARchive_InvalidSchemaException
  */
  public function test_creator_name_missing_content() {
    $h = new PHPHARchive_HAR(dirname(__FILE__) . '/../files/creator/name_missing_content.har');
  }

  /**
  * @group creator
  * @expectedException PHPHARchive_InvalidSchemaException
  */
  public function test_creator_version_missing() {
    $h = new PHPHARchive_HAR(dirname(__FILE__) . '/../files/creator/version_missing.har');
  }

  /**
  * @group creator
  * @expectedException PHPHARchive_InvalidSchemaException
  */
  public function test_creator_version_missing_content() {
    $h = new PHPHARchive_HAR(dirname(__FILE__) . '/../files/creator/version_missing_content.har');
  }

  /**
  * @group creator
  * @expectedException PHPHARchive_InvalidSchemaException
  */
  public function test_creator_comment_in_one_point_one() {
    $h = new PHPHARchive_HAR(dirname(__FILE__) . '/../files/creator/comment_one_point_one.har');
  }

  /**
  * @group creator
  */
  public function test_creator_comment_in_one_point_two() {
    $h = new PHPHARchive_HAR(dirname(__FILE__) . '/../files/creator/comment_one_point_two.har');
    $creator = $h->creator;
    $this->assertEquals($creator["comment"], "foo");
  }

  /**
  * @group creator
  */
  public function test_creator_name() {
    $h = new PHPHARchive_HAR(dirname(__FILE__) . '/../files/creator/comment_one_point_two.har');
    $creator = $h->creator;
    $this->assertEquals($creator["name"], "WebPagetest");
  }

  /**
  * @group creator
  */
  public function test_creator_version() {
    $h = new PHPHARchive_HAR(dirname(__FILE__) . '/../files/creator/comment_one_point_two.har');
    $creator = $h->creator;
    $this->assertEquals($creator["version"], "1.8");
  }



}
?>