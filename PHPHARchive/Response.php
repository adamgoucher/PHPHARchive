<?php

require_once 'Exceptions.php';
require_once 'Cookie.php';
require_once 'Header.php';
require_once 'Content.php';

class PHPHARchive_Response {
  private $raw;

  function __construct($response, $version) {
    $this->raw = $response;
    
    // status; mandatory
    if (array_key_exists("status", $response)) {
      if (strlen($response["status"]) == 0) {
        throw new PHPHARchive_InvalidSchemaException("'status' must contain 'Response status'");
      }
      $this->status = $response["status"];            
    } else {
      throw new PHPHARchive_InvalidSchemaException("'status' is mandatory in a 'response' object");
    }

    // statusText; mandatory
    if (array_key_exists("statusText", $response)) {
      if (strlen($response["statusText"]) == 0) {
        throw new PHPHARchive_InvalidSchemaException("'statusText' must contain 'Response status description'");
      }
      $this->status_text = $response["statusText"];            
    } else {
      throw new PHPHARchive_InvalidSchemaException("'statusText' is mandatory in a 'response' object");
    }

    // httpVersion; mandatory
    if (array_key_exists("httpVersion", $response)) {
      if (strlen($response["httpVersion"]) == 0) {
        throw new PHPHARchive_InvalidSchemaException("'httpVersion' must contain 'Response HTTP Version'");
      }
      $this->http_version = $response["httpVersion"];            
    } else {
      throw new PHPHARchive_InvalidSchemaException("'httpVersion' is mandatory in a 'response' object");
    }

    // cookies; mandatory
    if (array_key_exists("cookies", $response)) {
      foreach($response["cookies"] as $cookie) {
        array_push($this->cookies, new PHPHARchive_Cookie($cookie, $version));
      }
    } else {
      throw new PHPHARchive_InvalidSchemaException("'cookies' is mandatory in a 'response' object");
    }

    // headers; mandatory
    if (array_key_exists("headers", $response)) {
      foreach($response["headers"] as $header) {
        array_push($this->headers, new PHPHARchive_Cookie($header, $version));
      }
    } else {
      throw new PHPHARchive_InvalidSchemaException("'headers' is mandatory in a 'response' object");
    }
    
    // content; mandatory
    if (array_key_exists("content", $response)) {
      $this->content = new PHPHARchive_Content($response["content"], $version);
    } else {
      throw new PHPHARchive_InvalidSchemaException("'content' is mandatory in a 'response' object");
    }
    
    // redirectURL; mandatory
    if (array_key_exists("redirectURL", $response)) {
      $this->redirect_url = $response["redirectURL"];
    } else {
      throw new PHPHARchive_InvalidSchemaException("'redirectURL' is mandatory in a 'response' object");
    }
    
    // headersSize; mandatory
    if (array_key_exists("headersSize", $response)) {
      $this->headers_size = $response["headersSize"];
    } else {
      throw new PHPHARchive_InvalidSchemaException("'headersSize' is mandatory in a 'response' object");
    }

    // bodySize; mandatory
    if (array_key_exists("bodySize", $response)) {
      $this->body_size = $response["bodySize"];
    } else {
      throw new PHPHARchive_InvalidSchemaException("'bodySize' is mandatory in a 'response' object");
    }
    
    // comment; optional
    if (array_key_exists("comment", $response)) {
      if ($version == "1.1") {
        throw new PHPHARchive_InvalidSchemaException("'comment' is not valid in a 1.1 schema");
      }
      $this->comment = $response["comment"];
    } else {
      $this->comment = Null;
    }
  }
  
}

?>