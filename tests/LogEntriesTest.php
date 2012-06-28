<?php
require_once(dirname(__FILE__) . '/../PHPHarchive/HAR.php');

class LogEntiresTest extends PHPUnit_Framework_TestCase {
  /**
  * @group entries
  * @expectedException PHPHARchive_InvalidSchemaException
  */
  public function test_entries_missing() {
    $h = new PHPHARchive_HAR(dirname(__FILE__) . '/../files/entries/missing.har');
  }

  /**
  * @group entries
  */
  public function test_page_ref_missing() {
    $h = new PHPHARchive_HAR(dirname(__FILE__) . '/../files/entries/page_ref_missing.har');
    $entries = $h->entries;
    $this->assertNull($entries[0]->page_ref);
  }

  /**
  * @group entries
  */
  public function test_page_ref() {
    $h = new PHPHARchive_HAR(dirname(__FILE__) . '/../files/complete.har');
    $entries = $h->entries;
    $this->assertEquals($entries[0]->page_ref, "page_1_0");
  }

  /**
  * @group entries
  * @expectedException PHPHARchive_InvalidSchemaException
  */
  public function test_started_date_time_missing() {
    $h = new PHPHARchive_HAR(dirname(__FILE__) . '/../files/entries/started_date_time_missing.har');
  }

  /**
  * @group entries
  * @expectedException PHPHARchive_InvalidSchemaException
  */
  public function test_started_date_time_missing_content() {
    $h = new PHPHARchive_HAR(dirname(__FILE__) . '/../files/entries/started_date_time_missing_content.har');
  }

  /**
  * @group entries
  */
  public function test_started_date_time() {
    $h = new PHPHARchive_HAR(dirname(__FILE__) . '/../files/complete.har');
    $entries = $h->entries;
    $this->assertEquals($entries[0]->started_date_time, "2012-06-15T12:11:20.180+00:00");
  }

  /**
  * @group entries
  * @expectedException PHPHARchive_InvalidSchemaException
  */
  public function test_time_missing() {
    $h = new PHPHARchive_HAR(dirname(__FILE__) . '/../files/time_missing.har');
  }

  /**
  * @group entries
  */
  public function test_time() {
    $h = new PHPHARchive_HAR(dirname(__FILE__) . '/../files/complete.har');
    $entries = $h->entries;
    $this->assertEquals($entries[0]->time, "386");
  }

  /**
  * @group entries
  * @expectedException PHPHARchive_InvalidSchemaException
  */
  public function test_request_missing() {
    $h = new PHPHARchive_HAR(dirname(__FILE__) . '/../files/entries/request_missing.har');
  }

  /**
  * @group entries
  * @expectedException PHPHARchive_InvalidSchemaException
  */
  public function test_response_missing() {
    $h = new PHPHARchive_HAR(dirname(__FILE__) . '/../files/entries/response_missing.har');
  }

  /**
  * @group entries
  * @expectedException PHPHARchive_InvalidSchemaException
  */
  public function test_cache_missing() {
    $h = new PHPHARchive_HAR(dirname(__FILE__) . '/../files/entries/cache_missing.har');
  }

  /**
  * @group entries
  */
  public function test_no_cache_information() {
    $h = new PHPHARchive_HAR(dirname(__FILE__) . '/../files/entries/complete.har');
    $entries = $h->entries;
    $this->assertNull($entries[0]->cache);
  }

  /**
  * @group entries
  * @expectedException PHPHARchive_InvalidSchemaException
  */
  public function test_timings_missing() {
    $h = new PHPHARchive_HAR(dirname(__FILE__) . '/../files/entries/timings_missing.har');
  }

}

?>