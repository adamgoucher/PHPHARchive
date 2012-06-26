<?php

require_once 'Exceptions.php';

class PHPHARchive_HAR {
  private $raw;
  private $_creator;
  private $_browser;

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

    // creator; mandatory
    if (array_key_exists("creator", $raw["log"])) {
        $this->_creator = $raw["log"]["creator"];
        // name; mandatory
        if (! array_key_exists("name", $this->_creator)) {
            throw new PHPHARchive_InvalidSchemaException("'name' is mandatory in the 'creator' object");
          } else {
            if (strlen($this->_creator["name"]) == 0) {
              throw new PHPHARchive_InvalidSchemaException("'version' must contain 'Name of the application/browser used to export the log'");
            }
          }

        // version; mandatory
        if (! array_key_exists("version", $this->_creator)) {
            throw new PHPHARchive_InvalidSchemaException("'version' is mandatory in the 'creator' object'");
        } else {
          if (strlen($this->_creator["version"]) == 0) {
            throw new PHPHARchive_InvalidSchemaException("'version' must contain 'Version of the application/browser used to export the log.'");
          }
        }

        // comment; optional, introduced in 1.2
        if (array_key_exists("comment", $this->_creator) && $this->version == '1.1') {
            throw new PHPHARchive_InvalidSchemaException("'version' is mandatory in the 'creator' object'");
        }
    } else {
      throw new PHPHARchive_InvalidSchemaException("'creator' is mandatory in the 'log' object");
    }

    // browser; optional
    if (array_key_exists("browser", $raw["log"])) {
        $this->_browser = $raw["log"]["browser"];
        // name; mandatory
        if (! array_key_exists("name", $this->_browser)) {
            throw new PHPHARchive_InvalidSchemaException("'name' is mandatory in the 'browser' object");
          } else {
            if (strlen($this->_browser["name"]) == 0) {
              throw new PHPHARchive_InvalidSchemaException("'name' must contain 'Name of the application/browser used to export the log'");
            }
          }

        // version; mandatory
        if (! array_key_exists("version", $this->_browser)) {
            throw new PHPHARchive_InvalidSchemaException("'version' is mandatory in the 'browser' object'");
        } else {
          if (strlen($this->_browser["version"]) == 0) {
            throw new PHPHARchive_InvalidSchemaException("'version' must contain 'Version of the application/browser used to export the log.'");
          }
        }

        // comment; optional, introduced in 1.2
        if (array_key_exists("comment", $this->_browser) && $this->version == '1.1') {
            throw new PHPHARchive_InvalidSchemaException("'version' is mandatory in the 'browser' object'");
        }
    }

  }
  
  function __get($property) {
    switch($property) {
      case "creator":
        $c = array("name" => $this->_creator["name"],
                   "version" => $this->_creator["version"]);
        if (array_key_exists("comment", $this->_creator)) {
          $c["comment"] = $this->_creator["comment"];
        }
        return $c;        
      case "browser":
        if ($this->_browser) {
          $b = array("name" => $this->_browser["name"],
                     "version" => $this->_browser["version"]);
          if (array_key_exists("comment", $this->_browser)) {
            $b["comment"] = $this->_browser["comment"];
          }
          return $b;
        }
        return Null;
      default:
        return $this->$property;
    }
  }
}
?>