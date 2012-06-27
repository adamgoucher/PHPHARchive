<?php

require_once 'Exceptions.php';
require_once 'Page.php';
require_once 'Entry.php';

class PHPHARchive_HAR {
  private $raw;
  private $_creator;
  private $_browser;
  public $pages = array();
  public $entries = array();

  function __construct($h) {
    if (is_file($h)) {
      $this->raw = json_decode(file_get_contents($h), True);
    } else {
      throw new PHPHARchive_MissingHARException($h . " does not exist");
    }
    
    // version; mandatory, but can be empty
    if (array_key_exists("version", $this->raw["log"])) {
      if (strlen($this->raw["log"]["version"]) != 0) {
        $this->version = $this->raw["log"]["version"];
      } else {
        $this->version = "1.1";
      }
    } else {
      throw new PHPHARchive_InvalidSchemaException("version is mandatory");
    }
    
    // only two versions of the HAR schema available now and can't guess the future
    if (! in_array($this->version, array("1.1", "1.2"))) {
      throw new PHPHARchive_UnsupportedVersionException($this->raw["log"]["version"] . " is not a supported version");
    }

    // creator; mandatory
    if (array_key_exists("creator", $this->raw["log"])) {
        $this->_creator = $this->raw["log"]["creator"];
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
    if (array_key_exists("browser", $this->raw["log"])) {
        $this->_browser = $this->raw["log"]["browser"];
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

    // pages; optional
    if (array_key_exists("pages", $this->raw["log"])) {
      foreach($this->raw["log"]["pages"] as $page) {
        array_push($this->pages, new PHPHARchive_Page($page, $this->version));
      }
    }

    // creator; mandatory
    if (array_key_exists("entries", $this->raw["log"])) {
      foreach($this->raw["log"]["entries"] as $entry) {
        array_push($this->entries, new PHPHARchive_Entry($entry, $this->version));
      }
    } else {
      throw new PHPHARchive_InvalidSchemaException("'creator' is mandatory in the 'log' object");
    }
      
    // comment; optional, introduced in 1.2
    if (array_key_exists("comment", $this->raw["log"]) && $this->version == '1.1') {
        throw new PHPHARchive_InvalidSchemaException("'comment' was introduced in version 1.2");
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
      case "comment":
        if (array_key_exists("comment", $this->raw["log"])) {
          return $this->raw["log"]["comment"];
        }
        return Null;
      default:
        return $this->$property;
    }
  }
}
?>