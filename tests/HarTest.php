<?php
require_once(dirname(__FILE__) . '/../PHPHarchive/HAR.php');

class HarTest extends PHPUnit_Framework_TestCase {
  /**
  * @group har
  * @expectedException PHPHARchive_MissingHARException
  * @expectedExceptionMessage foo.har does not exist
  */  
  public function test_no_such_file() {
    $h = new PHPHARchive_HAR("foo.har");
  }

  /**
  * @group interesting
  */  
  public function test_find_entries_page_by_ref() {
    $h = new PHPHARchive_HAR(dirname(__FILE__) . '/../files/groups.google.com.120615_6_68C1.har');
    $entries = $h->get_entries_by_page_ref("page_1_0");
    $this->assertEquals(count($entries), 21);
  }
}
?>