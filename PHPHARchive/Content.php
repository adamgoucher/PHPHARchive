<?php

require_once 'Exceptions.php';

class PHPHARchive_Content {
  private $raw;

  function __construct($cache, $version) {
    $this->raw = $cache;
  }
  
}