<?php

namespace App\Controllers;

use function Core\view;

  class IndexController {
    
    public function __invoke() {
      return view('/index', template: 'guest');
    }
  }