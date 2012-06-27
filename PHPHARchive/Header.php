<?php

require_once 'Exceptions.php';

class PHPHARchive_Header {
  private $raw;

  function __construct($header, $version) {
    $this->raw = $header;
    
    // name; mandatory
    if (array_key_exists("name", $header)) {
      if (strlen($header["name"]) == 0) {
        throw new PHPHARchive_InvalidSchemaException("'name' must contain 'The name of the header'");
      }
      $this->method = $header["name"];            
    } else {
      throw new PHPHARchive_InvalidSchemaException("'name' is mandatory in a 'header' object");
    }

    // value; mandatory
    if (array_key_exists("value", $header)) {
      if (strlen($header["value"]) == 0) {
        throw new PHPHARchive_InvalidSchemaException("'value' must contain 'The value of the header'");
      }
      $this->method = $header["value"];            
    } else {
      throw new PHPHARchive_InvalidSchemaException("'value' is mandatory in a 'header' object");
    }
    
    // comment; optional
    if (array_key_exists("comment", $header)) {
      if ($version == "1.1") {
        throw new PHPHARchive_InvalidSchemaException("'comment' is not valid in a 1.1 schema");
      }
      $this->comment = $header["comment"];
    } else {
      $this->comment = Null;
    }
  }
  
}

?>