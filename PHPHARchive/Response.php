<?php

require_once 'Exceptions.php';

class PHPHARchive_Response {
  private $raw;

  function __construct($entry, $version) {
    $this->raw = $entry;
    
  }
  
}

?>