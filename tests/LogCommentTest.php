<?php
require_once(dirname(__FILE__) . '/../PHPHarchive/HAR.php');

class LogCommentTest extends PHPUnit_Framework_TestCase {
  /**
  * @group comment
  */
  public function test_comment_missing() {
    $h = new PHPHARchive_HAR(dirname(__FILE__) . '/../files/comment/missing.har');
    $c = $h->comment;
    $this->assertNull($c);
  }

  /**
  * @group comment
  * @expectedException PHPHARchive_InvalidSchemaException
  */
  public function test_comment_one_point_one() {
    $h = new PHPHARchive_HAR(dirname(__FILE__) . '/../files/comment/one_point_one.har');
  }

  /**
  * @group comment
  */
  public function test_comment_one_point_two() {
    $h = new PHPHARchive_HAR(dirname(__FILE__) . '/../files/comment/one_point_two.har');
    $this->assertEquals($h->comment, "fooboo");
  }

}
?>