<?php

use function Core\base_path;

require "../Core/functions.php";

spl_autoload_register(function($class) {
  $class = str_replace('\\', DIRECTORY_SEPARATOR, $class);
  
  require base_path($class . '.php');
});

session_start();

$config = require base_path("config/config.php");

require base_path("config/routes.php");

