<?php

require_once 'Exceptions.php';

class PHPHARchive_HAR {
  private $raw;

  function __construct($h) {
    if (is_file($h)) {
      $raw = json_decode(file_get_contents($h), True);
    } else {
      throw new PHPHARchive_MissingHARException($h . " does not exist");
    }
    
    // version; mandatory, but can be empty
    if (array_key_exists("version", $raw["log"])) {
      if (strlen($raw["log"]["version"]) != 0) {
        $this->version = $raw["log"]["version"];
      } else {
        $this->version = "1.1";
      }
    } else {
      throw new PHPHARchive_InvalidSchemaException("version is mandatory");
    }
    
    // only two versions of the HAR schema available now and can't guess the future
    if (! in_array($this->version, array("1.1", "1.2"))) {
      throw new PHPHARchive_UnsupportedVersionException($raw["log"]["version"] . " is not a supported version");
    }

  }
}
?>