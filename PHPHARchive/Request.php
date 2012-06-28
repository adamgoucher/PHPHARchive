<?php

require_once 'Exceptions.php';
require_once 'Cookie.php';
require_once 'Header.php';
require_once 'QueryString.php';

class PHPHARchive_Request {
  private $raw;
  public $cookies = array();
  public $headers = array();
  public $query_strings = array();

  function __construct($request, $version) {
    $this->raw = $request;

    // method; mandatory
    if (array_key_exists("method", $request)) {
      if (strlen($request["method"]) == 0) {
        throw new PHPHARchive_InvalidSchemaException("'method' must contain 'Request method (GET, POST, ...)'");
      }
      $this->method = $request["method"];            
    } else {
      throw new PHPHARchive_InvalidSchemaException("'method' is mandatory in a 'request' object");
    }

    // url; mandatory
    if (array_key_exists("url", $request)) {
      if (strlen($request["url"]) == 0) {
        throw new PHPHARchive_InvalidSchemaException("'url' must contain 'Absolute URL of the request (fragments are not included)'");
      }
      $this->url = $request["url"];            
    } else {
      throw new PHPHARchive_InvalidSchemaException("'url' is mandatory in a 'request' object");
    }

    // httpVersion; mandatory
    if (array_key_exists("httpVersion", $request)) {
      if (strlen($request["httpVersion"]) == 0) {
        throw new PHPHARchive_InvalidSchemaException("'httpVersion' must contain 'Request HTTP Version'");
      }
      $this->http_version = $request["httpVersion"];            
    } else {
      throw new PHPHARchive_InvalidSchemaException("'httpVersion' is mandatory in a 'request' object");
    }

    // cookies; mandatory
    if (array_key_exists("cookies", $request)) {
      foreach($request["cookies"] as $cookie) {
        array_push($this->cookies, new PHPHARchive_Cookie($cookie, $version));
      }
    } else {
      throw new PHPHARchive_InvalidSchemaException("'cookies' is mandatory in a 'request' object");
    }

    // headers; mandatory
    if (array_key_exists("headers", $request)) {
      foreach($request["headers"] as $header) {
        array_push($this->headers, new PHPHARchive_Cookie($header, $version));
      }
    } else {
      throw new PHPHARchive_InvalidSchemaException("'headers' is mandatory in a 'request' object");
    }

    // queryString; mandatory
    if (array_key_exists("queryString", $request)) {
      foreach($request["queryString"] as $query_string) {
        array_push($this->query_strings, new PHPHARchive_QueryString($query_string, $version));
      }
    } else {
      throw new PHPHARchive_InvalidSchemaException("'queryString' is mandatory in a 'request' object");
    }
    
    // postData; optional
    if (array_key_exists("postData", $entry)) {
      $this->post_data = $entry["postData"];
    } else {
      $this->post_data = Null;
    }
    
    // headersSize; mandatory
    if (array_key_exists("headersSize", $request)) {
      if (strlen($request["headersSize"]) == 0) {
        throw new PHPHARchive_InvalidSchemaException("'headersSize' must contain 'Total number of bytes from the start of the HTTP'");
      }
      $this->headers_size = $request["headersSize"];            
    } else {
      throw new PHPHARchive_InvalidSchemaException("'headersSize' is mandatory in a 'request' object");
    }

    // bodySize; mandatory
    if (array_key_exists("bodySize", $request)) {
      if (strlen($request["bodySize"]) == 0) {
        throw new PHPHARchive_InvalidSchemaException("'bodySize' must contain 'Size of the request body (POST data payload) in bytes'");
      }
      $this->body_size = $request["bodySize"];            
    } else {
      throw new PHPHARchive_InvalidSchemaException("'bodySize' is mandatory in a 'request' object");
    }

    // comment; optional
    if (array_key_exists("comment", $request)) {
      if ($version == "1.1") {
        throw new PHPHARchive_InvalidSchemaException("'comment' is not valid in a 1.1 schema");
      }
      $this->comment = $request["comment"];
    } else {
      $this->comment = Null;
    }

  }
  
}

?>