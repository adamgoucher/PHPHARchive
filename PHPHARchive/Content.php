<?php

require_once 'Exceptions.php';

class PHPHARchive_Content {
  private $raw;

  function __construct($content, $version) {
    $this->raw = $content;
    
    // size; mandatory
    if (array_key_exists("size", $content)) {
      if (strlen($content["size"]) == 0) {
        throw new PHPHARchive_InvalidSchemaException("'size' must contain 'Length of the returned content in bytes'");
      }
      $this->size = $content["size"];            
    } else {
      throw new PHPHARchive_InvalidSchemaException("'size' is mandatory in a 'content' object");
    }

    // compression; optional
    if (array_key_exists("compression", $content)) {
      $this->compression = $content["compression"];
    } else {
      $this->compression = Null;
    }

    // mimeType; mandatory
    if (array_key_exists("mimeType", $content)) {
      if (strlen($content["mimeType"]) == 0) {
        throw new PHPHARchive_InvalidSchemaException("'mimeType' must contain 'MIME type of the response text'");
      }
      $this->mime_type = $content["mimeType"];            
    } else {
      throw new PHPHARchive_InvalidSchemaException("'mimeType' is mandatory in a 'content' object");
    }

    // text; optional
    if (array_key_exists("text", $content)) {
      $this->text = $content["text"];
    } else {
      $this->text = Null;
    }

    // encoding; optional
    if (array_key_exists("encoding", $content)) {
      if ($version == "1.1") {
        throw new PHPHARchive_InvalidSchemaException("'encoding' is not valid in a 1.1 schema");
      }
      $this->encoding = $content["secure"];
    } else {
      $this->encoding = Null;
    }
    
    // comment; optional
    if (array_key_exists("comment", $content)) {
      if ($version == "1.1") {
        throw new PHPHARchive_InvalidSchemaException("'comment' is not valid in a 1.1 schema");
      }
      $this->comment = $content["secure"];
    } else {
      $this->comment = Null;
    }
  }
  
}