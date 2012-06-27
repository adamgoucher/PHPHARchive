<?php

require_once 'Exceptions.php';

class PHPHARchive_Page {
  private $raw;
  public $page_timings = array();

  function __construct($page, $version) {
    $this->raw = $page;
    
    // startedDateTime; mandatory
    if (array_key_exists("startedDateTime", $page)) {
      if (strlen($page["startedDateTime"]) == 0) {
        throw new PHPHARchive_InvalidSchemaException("'startedDateTime' must contain 'Date and time stamp for the beginning of the page load'");
      }
      $this->started_date_time = $page["startedDateTime"];            
    } else {
      throw new PHPHARchive_InvalidSchemaException("'startedDateTime' is mandatory in a 'page' object");
    }

    // id; mandatory
    if (array_key_exists("id", $page)) {
      if (strlen($page["id"]) == 0) {
        throw new PHPHARchive_InvalidSchemaException("'id' must contain 'Unique identifier of a page within the file'");
      }
      $this->started_date_time = $page["id"];            
    } else {
      throw new PHPHARchive_InvalidSchemaException("'id' is mandatory in a 'page' object");
    }

    // title; mandatory
    if (array_key_exists("title", $page)) {
      if (strlen($page["title"]) == 0) {
        throw new PHPHARchive_InvalidSchemaException("'title' must contain 'Page title'");
      }
      $this->started_date_time = $page["title"];            
    } else {
      throw new PHPHARchive_InvalidSchemaException("'title' is mandatory in a 'page' object");
    }

    // pageTimings; mandatory
    if (array_key_exists("pageTimings", $page)) {
      // onContentLoad; optional
      if (array_key_exists("onContentLoad", $page["pageTimings"])) {
        $this->page_timings["on_content_load"] = $page["pageTimings"]["onContentLoad"];
      }

      // onLoad; optional
      if (array_key_exists("onLoad", $page["pageTimings"])) {
        $this->page_timings["on_load"] = $page["pageTimings"]["onLoad"];
      }

      // content; optional, introduced in 1.2
      if (array_key_exists("comment", $page["pageTimings"])) {
        if ($version == "1.1") {
          throw new PHPHARchive_InvalidSchemaException("'comment' is not available in version 1.1 of the har schema for a page's pageTimings information");          
        }
        $this->page_timings["comment"] = $page["pageTimings"]["comment"];
      }
    } else {
      throw new PHPHARchive_InvalidSchemaException("'title' is mandatory in a 'page' object");
    }

  }

}