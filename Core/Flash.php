<?php 

namespace Core;

  class Flash {
    public function push($key, $value) {
      $_SESSION["flash_$key"] = $value;
    }

    public function get($key) {
      $value = $_SESSION["flash_$key"] ?? '';

      unset($_SESSION["flash_$key"]);

      return $value;
    }

    public function exit($key) {
      unset($_SESSION["flash_auth"]);
    }
  }
