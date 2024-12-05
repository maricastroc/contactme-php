<?php

namespace App\Controllers\Contacts;

use Core\Validation;

use function Core\auth;
use function Core\flash;
use function Core\redirect;
use function Core\request;
use function Core\session;
use function Core\view;

  class ShowController {
    
    public function show() {
      $validations = [];

      $rules = [
        'password' => ['required'],
      ];
  
      $validation = Validation::validate($rules, request()->all());
  
      $validations = $validation->validations;

      if (!empty($validations)) {
        flash()->push('validations', $validations);
        return view('/contacts/confirm');
      }

      if (!password_verify(request()->post('password'), auth()->password)) {
        flash()->push('validations', ['password' => [
          'Incorrect password!'
        ]]);
  
        return view('/contacts/confirm');
      }

      session()->set('show', true);

      return redirect('/contacts');
    }

    public function hide() {
      session()->forget('show');

      return redirect('/contacts');
    }

    public function confirm() {
      return view('/contacts/confirm');
    }

  }