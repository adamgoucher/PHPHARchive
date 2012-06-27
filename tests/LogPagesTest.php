<?php
require_once(dirname(__FILE__) . '/../PHPHarchive/HAR.php');

class LogPagesTest extends PHPUnit_Framework_TestCase {
  /**
  * @group pages
  */
  public function test_pages_missing() {
    $h = new PHPHARchive_HAR(dirname(__FILE__) . '/../files/pages/missing.har');
    $p = $h->pages;
    $this->assertEquals(count($p), 0);
  }

  /**
  * @group pages
  * @expectedException PHPHARchive_InvalidSchemaException
  */
  public function test_start_date_time_missing() {
    $h = new PHPHARchive_HAR(dirname(__FILE__) . '/../files/pages/started_date_time_missing.har');
  }

  /**
  * @group pages
  * @expectedException PHPHARchive_InvalidSchemaException
  */
  public function test_start_date_time_missing_content() {
    $h = new PHPHARchive_HAR(dirname(__FILE__) . '/../files/pages/started_date_time_missing_content.har');
  }

  /**
  * @group pages
  * @expectedException PHPHARchive_InvalidSchemaException
  */
  public function test_id_missing() {
    $h = new PHPHARchive_HAR(dirname(__FILE__) . '/../files/pages/id_missing.har');
  }

  /**
  * @group pages
  * @expectedException PHPHARchive_InvalidSchemaException
  */
  public function test_id_missing_content() {
    $h = new PHPHARchive_HAR(dirname(__FILE__) . '/../files/pages/id_missing_content.har');
  }
  
  /**
  * @group pages
  * @expectedException PHPHARchive_InvalidSchemaException
  */
  public function test_title_missing() {
    $h = new PHPHARchive_HAR(dirname(__FILE__) . '/../files/pages/title_missing.har');
  }

  /**
  * @group pages
  * @expectedException PHPHARchive_InvalidSchemaException
  */
  public function test_title_missing_content() {
    $h = new PHPHARchive_HAR(dirname(__FILE__) . '/../files/pages/title_missing_content.har');
  }

  /**
  * @group pages
  * @expectedException PHPHARchive_InvalidSchemaException
  */
  public function test_page_timings_missing() {
    $h = new PHPHARchive_HAR(dirname(__FILE__) . '/../files/pages/page_timings_missing.har');
  }

  /**
  * @group pages
  */
  public function test_page_on_content_load_missing() {
    $h = new PHPHARchive_HAR(dirname(__FILE__) . '/../files/pages/page_timings_on_content_load_missing.har');
    $pages = $h->pages;
    $p = $pages[0];
    $this->assertFalse(array_key_exists("on_content_load", $p->page_timings));
  }

  /**
  * @group pages
  */
  public function test_page_on_content_load() {
    $h = new PHPHARchive_HAR(dirname(__FILE__) . '/../files/pages/page_timings_on_load_missing.har');
    $pages = $h->pages;
    $p = $pages[0];
    $this->assertEquals($p->page_timings["on_content_load"], -1);
  }

  /**
  * @group pages
  */
  public function test_page_on_load_missing() {
    $h = new PHPHARchive_HAR(dirname(__FILE__) . '/../files/pages/page_timings_on_load_missing.har');
    $pages = $h->pages;
    $p = $pages[0];
    $this->assertFalse(array_key_exists("on_load", $p->page_timings));
  }

  /**
  * @group pages
  */
  public function test_page_on_load() {
    $h = new PHPHARchive_HAR(dirname(__FILE__) . '/../files/pages/page_timings_on_content_load_missing.har');
    $pages = $h->pages;
    $p = $pages[0];
    $this->assertEquals($p->page_timings["on_load"], 935);
  }

  /**
  * @group pages
  * @expectedException PHPHARchive_InvalidSchemaException
  */
  public function test_page_comment_one_point_one() {
    $h = new PHPHARchive_HAR(dirname(__FILE__) . '/../files/pages/page_timings_comment_one_point_one.har');
  }

  /**
  * @group pages
  */
  public function test_page_comment_one_point_twoa() {
    $h = new PHPHARchive_HAR(dirname(__FILE__) . '/../files/pages/page_timings_comment_one_point_two.har');
    $pages = $h->pages;
    $p = $pages[0];
    $this->assertEquals($p->page_timings["comment"], "goo");
  }
}
?>