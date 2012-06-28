<?php

require_once 'Exceptions.php';

class PHPHARchive_Cookie {
  private $raw;

  function __construct($cookie, $version) {
    $this->raw = $cookie;
    
    // name; mandatory
    if (array_key_exists("name", $cookie)) {
      if (strlen($cookie["name"]) == 0) {
        throw new PHPHARchive_InvalidSchemaException("'name' must contain 'The name of the cookie'");
      }
      $this->method = $cookie["name"];            
    } else {
      throw new PHPHARchive_InvalidSchemaException("'name' is mandatory in a 'cookie' object");
    }

    // value; mandatory
    if (array_key_exists("value", $cookie)) {
      if (strlen($cookie["value"]) == 0) {
        throw new PHPHARchive_InvalidSchemaException("'value' must contain 'The value of the cookie'");
      }
      $this->method = $cookie["value"];            
    } else {
      throw new PHPHARchive_InvalidSchemaException("'value' is mandatory in a 'cookie' object");
    }

    // path; optional
    if (array_key_exists("path", $cookie)) {
      $this->path = $cookie["path"];
    } else {
      $this->path = Null;
    }

    // domain; optional
    if (array_key_exists("domain", $cookie)) {
      $this->domain = $cookie["domain"];
    } else {
      $this->domain = Null;
    }

    // expires; optional
    if (array_key_exists("expires", $cookie)) {
      $this->expires = $cookie["expires"];
    } else {
      $this->expires = Null;
    }

    // httpOnly; optional
    if (array_key_exists("httpOnly", $cookie)) {
      $this->http_only = $cookie["httpOnly"];
    } else {
      $this->http_only = Null;
    }

    // secure; optional
    if (array_key_exists("secure", $cookie)) {
      if ($version == "1.1") {
        throw new PHPHARchive_InvalidSchemaException("'secure' is not valid in a 1.1 schema");
      }
      $this->secure = $cookie["secure"];
    } else {
      $this->secure = Null;
    }

    // comment; optional
    if (array_key_exists("comment", $cookie)) {
      if ($version == "1.1") {
        throw new PHPHARchive_InvalidSchemaException("'comment' is not valid in a 1.1 schema");
      }
      $this->comment = $cookie["comment"];
    } else {
      $this->comment = Null;
    }
  }
  
}

?>