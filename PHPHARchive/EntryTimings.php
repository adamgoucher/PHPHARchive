<?php

require_once 'Exceptions.php';

class PHPHARchive_EntryTimings {
  private $raw;

  function __construct($timings, $version) {
    $this->raw = $timings;
    
    // blocked; optional
    if (array_key_exists("blocked", $timings)) {
      $this->blocked = $timings["blocked"];
    } else {
      $this->blocked = Null;
    }
    
    // dns; optional
    if (array_key_exists("dns", $timings)) {
      $this->dns = $timings["dns"];
    } else {
      $this->dns = Null;
    }

    // connect; optional
    if (array_key_exists("connect", $timings)) {
      $this->connect = $timings["connect"];
    } else {
      $this->connect = Null;
    }
    
    // send; mandatory
    if (array_key_exists("send", $timings)) {
      if (strlen($timings["send"]) == 0) {
        throw new PHPHARchive_InvalidSchemaException("'send' must contain 'Time required to send HTTP request to the server'");
      }
      $this->send = $timings["send"];            
    } else {
      throw new PHPHARchive_InvalidSchemaException("'send' is mandatory in a 'timings' object");
    }

    // wait; mandatory
    if (array_key_exists("wait", $timings)) {
      if (strlen($timings["wait"]) == 0) {
        throw new PHPHARchive_InvalidSchemaException("'wait' must contain 'Waiting for a response from the server'");
      }
      $this->wait = $timings["wait"];            
    } else {
      throw new PHPHARchive_InvalidSchemaException("'wait' is mandatory in a 'timings' object");
    }

    // receive; mandatory
    if (array_key_exists("receive", $timings)) {
      if (strlen($timings["receive"]) == 0) {
        throw new PHPHARchive_InvalidSchemaException("'receive' must contain 'Time required to read entire response from the server (or cache)'");
      }
      $this->receive = $timings["receive"];            
    } else {
      throw new PHPHARchive_InvalidSchemaException("'receive' is mandatory in a 'timings' object");
    }

    // ssl; optional
    if (array_key_exists("ssl", $timings)) {
      if ($version == "1.1") {
        throw new PHPHARchive_InvalidSchemaException("'ssl' is not valid in a 1.1 schema");
      }
      $this->ssl = $timings["ssl"];
    } else {
      $this->ssl = Null;
    }

    // comment; optional
    if (array_key_exists("comment", $timings)) {
      if ($version == "1.1") {
        throw new PHPHARchive_InvalidSchemaException("'timings' is not valid in a 1.1 schema");
      }
      $this->comment = $timings["comment"];
    } else {
      $this->comment = Null;
    }

  }
  
}

?>