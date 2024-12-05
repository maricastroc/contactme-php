<?php

namespace App\Controllers\Contacts;

use App\Models\Contact;
use Core\Validation;

use function Core\flash;
use function Core\redirect;
use function Core\request;
use function Core\view;

  class CreateController {
    
    public function create() {
      $validations = [];

      $rules = [
        'first_name' => ['required', 'min:3', 'max:255'],
        'last_name' => ['required', 'min:3', 'max:255'],
        'phone_01' => ['required', 'min:7'],
      ];

      $validation = Validation::validate($rules, request()->all());

      $validations = $validation->validations;

      if (!empty($validations)) {
        flash()->push('validations', $validations);
        return view('contacts/create');
      }

      Contact::create(request()->all());
    
      flash()->push('successfully_registered', 'Contact successfully created!');
    
      redirect('/contacts');
    }

    public function index() {
      return view('/contacts/create');
    }
  }