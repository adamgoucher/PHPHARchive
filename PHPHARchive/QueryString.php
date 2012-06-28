<?php

require_once 'Exceptions.php';

class PHPHARchive_QueryString {
  private $raw;

  function __construct($query_string, $version) {
    $this->raw = $query_string;
    
    // name; mandatory
    if (array_key_exists("name", $query_string)) {
      if (strlen($query_string["name"]) == 0) {
        throw new PHPHARchive_InvalidSchemaException("'name' must contain 'The name of the query string'");
      }
      $this->method = $query_string["name"];            
    } else {
      throw new PHPHARchive_InvalidSchemaException("'name' is mandatory in a 'queryString' object");
    }

    // value; mandatory
    if (array_key_exists("value", $query_string)) {
      $this->method = $query_string["value"];            
    } else {
      throw new PHPHARchive_InvalidSchemaException("'value' is mandatory in a 'queryString' object");
    }
    
    // comment; optional
    if (array_key_exists("comment", $query_string)) {
      if ($version == "1.1") {
        throw new PHPHARchive_InvalidSchemaException("'comment' is not valid in a 1.1 schema");
      }
      $this->comment = $query_string["comment"];
    } else {
      $this->comment = Null;
    }
  }
  
}

?>