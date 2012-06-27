<?php

require_once 'Exceptions.php';

class PHPHARchive_Cache {
  private $raw;

  function __construct($cache, $version) {
    $this->raw = $cache;
    
    // beforeRequest; optional
    if (array_key_exists("beforeRequest", $cache)) {
      $this->before_request = $cache["beforeRequest"];
    } else {
      $this->before_request = Null;
    }

    // afterRequest; optional
    if (array_key_exists("afterRequest", $cache)) {
      $this->after_request = $cache["afterRequest"];
    } else {
      $this->after_request = Null;
    }

    // comment; optional
    if (array_key_exists("comment", $cache)) {
      if ($version == "1.1") {
        throw new PHPHARchive_InvalidSchemaException("'comment' is not valid in a 1.1 schema");
      }
      $this->comment = $cache["comment"];
    } else {
      $this->comment = Null;
    }
  }
  
}

?>