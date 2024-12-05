<?php

namespace App\Controllers;

use function Core\redirect;

  class LogoutController {

    public function __invoke() {
      session_destroy();

      return redirect('/login');
    }
  }