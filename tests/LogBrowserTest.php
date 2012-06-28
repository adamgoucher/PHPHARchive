<?php
require_once(dirname(__FILE__) . '/../PHPHarchive/HAR.php');

class LogBrowserTest extends PHPUnit_Framework_TestCase {
  /**
  * @group browser
  */
  public function test_browser_missing() {
    $h = new PHPHARchive_HAR(dirname(__FILE__) . '/../files/browser/missing.har');
    $b = $h->browser;
    $this->assertNUll($b);
  }

  /**
  * @group browser
  * @expectedException PHPHARchive_InvalidSchemaException
  */
  public function test_browser_name_missing() {
    $h = new PHPHARchive_HAR(dirname(__FILE__) . '/../files/browser/name_missing.har');
  }

  /**
  * @group browser
  * @expectedException PHPHARchive_InvalidSchemaException
  */
  public function test_browser_name_missing_content() {
    $h = new PHPHARchive_HAR(dirname(__FILE__) . '/../files/browser/name_missing_content.har');
  }

  /**
  * @group browser
  * @expectedException PHPHARchive_InvalidSchemaException
  */
  public function test_browser_version_missing() {
    $h = new PHPHARchive_HAR(dirname(__FILE__) . '/../files/browser/version_missing.har');
  }

  /**
  * @group browser
  * @expectedException PHPHARchive_InvalidSchemaException
  */
  public function test_browser_version_missing_content() {
    $h = new PHPHARchive_HAR(dirname(__FILE__) . '/../files/browser/version_missing_content.har');
  }

  /**
  * @group browser
  * @expectedException PHPHARchive_InvalidSchemaException
  */
  public function test_browser_comment_in_one_point_one() {
    $h = new PHPHARchive_HAR(dirname(__FILE__) . '/../files/browser/comment_one_point_one.har');
  }

  /**
  * @group browser
  */
  public function test_browser_comment_in_one_point_two() {
    $h = new PHPHARchive_HAR(dirname(__FILE__) . '/../files/complete-1.2.har');
    $browser = $h->browser;
    $this->assertEquals($browser["comment"], "browser comment");
  }

  /**
  * @group browser
  */
  public function test_browser_name() {
    $h = new PHPHARchive_HAR(dirname(__FILE__) . '/../files/complete-1.2.har');
    $browser = $h->browser;
    $this->assertEquals($browser["name"], "Firefox");
  }

  /**
  * @group browser
  */
  public function test_browser_version() {
    $h = new PHPHARchive_HAR(dirname(__FILE__) . '/../files/complete-1.2.har');
    $browser = $h->browser;
    $this->assertEquals($browser["version"], "13");
  }



}
?>