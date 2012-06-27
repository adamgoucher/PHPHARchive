<?php

require_once 'Exceptions.php';
require_once 'Request.php';
require_once 'Response.php';
require_once 'EntryTimings.php';

class PHPHARchive_Entry {
  private $raw;

  function __construct($entry, $version) {
    $this->raw = $entry;

    // pageref; optional
    if (array_key_exists("pageref", $entry)) {
      $this->page_ref = $entry["pageref"];
    } else {
      $this->page_ref = Null;
    }

    // startedDateTime; mandatory
    if (array_key_exists("startedDateTime", $entry)) {
      if (strlen($entry["startedDateTime"]) == 0) {
        throw new PHPHARchive_InvalidSchemaException("'startedDateTime' must contain 'Date and time stamp for the beginning of the page load'");
      }
      $this->started_date_time = $entry["startedDateTime"];            
    } else {
      throw new PHPHARchive_InvalidSchemaException("'startedDateTime' is mandatory in a 'entry' object");
    }
    
    // time; mandatory
    if (array_key_exists("time", $entry)) {
      if (strlen($entry["time"]) == 0) {
        throw new PHPHARchive_InvalidSchemaException("'time' must contain 'Total elapsed time of the request in milliseconds'");
      }
      $this->time = $entry["time"];            
    } else {
      throw new PHPHARchive_InvalidSchemaException("'time' is mandatory in a 'entry' object");
    }

    // request; mandatory
    if (array_key_exists("request", $entry)) {
      if (count($entry["request"]) == 0) {
        throw new PHPHARchive_InvalidSchemaException("'request' must contain 'Detailed info about the request'");
      }
      $this->request = new PHPHARchive_Request($entry["request"], $version);
    } else {
      throw new PHPHARchive_InvalidSchemaException("'request' is mandatory in a 'entry' object");
    }

    // response; mandatory
    if (array_key_exists("response", $entry)) {
      if (count($entry["response"]) == 0) {
        throw new PHPHARchive_InvalidSchemaException("'response' must contain 'Detailed info about the response'");
      }
      $this->response = new PHPHARchive_Response($entry["response"], $version);
    } else {
      throw new PHPHARchive_InvalidSchemaException("'response' is mandatory in a 'entry' object");
    }

    // cache; mandatory
    if (array_key_exists("cache", $entry)) {
      if (count($entry["cache"]) == 0) {
        $this->cache = Null;
      } else {
        $this->cache = new PHPHARchive_Cache($entry["cache"], $version);
      }
    } else {
      throw new PHPHARchive_InvalidSchemaException("'cache' is mandatory in a 'entry' object");
    }

    // timings; mandatory
    if (array_key_exists("timings", $entry)) {
      if (count($entry["timings"]) == 0) {
        throw new PHPHARchive_InvalidSchemaException("'timings' must contain 'Detailed timing info about request/response round trip'");
      }
      $this->timings = new PHPHARchive_EntryTimings($entry["timings"], $version);
    } else {
      throw new PHPHARchive_InvalidSchemaException("'timings' is mandatory in a 'entry' object");
    }
  
    // serverIPAddress; optional
    if (array_key_exists("serverIPAddress", $entry)) {
      if ($version == "1.1") {
        throw new PHPHARchive_InvalidSchemaException("'serverIPAddress' is not valid in a 1.1 schema");
      }
      $this->server_ip_address = $entry["serverIPAddress"];
    } else {
      $this->server_ip_address = Null;
    }

    // connection; optional
    if (array_key_exists("connection", $entry)) {
      if ($version == "1.1") {
        throw new PHPHARchive_InvalidSchemaException("'connection' is not valid in a 1.1 schema");
      }
      $this->connection = $entry["connection"];
    } else {
      $this->connection = Null;
    }

    // comment; optional
    if (array_key_exists("comment", $entry)) {
      if ($version == "1.1") {
        throw new PHPHARchive_InvalidSchemaException("'comment' is not valid in a 1.1 schema");
      }
      $this->comment = $entry["comment"];
    } else {
      $this->comment = Null;
    }
  }
}

?>