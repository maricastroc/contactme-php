<?php

namespace App\Controllers;

use App\Models\User;
use Core\Validation;

use function Core\flash;
use function Core\redirect;
use function Core\request;
use function Core\view;

  class RegisterController {
    
    public function register() {
      $validations = [];

      $rules = [
        'name' => ['required'],
        'email' => ['required', 'unique:users'],
        'confirm_password' => ['required'],
        'password' => ['min:8', 'max:30', 'strong', 'confirmed'],
      ];

      $validation = Validation::validate($rules, request()->all());

      $validations = $validation->validations;

      if (!empty($validations)) {
        flash()->push('validations', $validations);
        return view('/register', template: 'guest');
      }

      User::create(request()->post('name'), request()->post('email'), request()->post('password'));
    
      flash()->push('successfully_registered', 'User successfully registered!');
    
      redirect('/login');
    }

    public function index() {
      return view('/register', template: 'guest');
    }
  }