<?php

namespace App\Controllers\Contacts;

use App\Models\Contact;
use Core\Validation;

use function Core\flash;
use function Core\redirect;
use function Core\request;
use function Core\session;

  class UpdateController {   
    public function update() {
      $shouldUpdateContact = session()->get('show');

      $validations = [];
  
      $rules = array_merge([
        'first_name' => ['required', 'min:3', 'max:255'],
        'last_name' => ['required', 'min:3', 'max:255'],
        'id' => ['required'],
      ], $shouldUpdateContact ? ['phone_01' => ['required']] : []);
  
      $validation = Validation::validate($rules, request()->all());
  
      $validations = $validation->validations;
  
      if (!empty($validations)) {
        flash()->push('validations', $validations);
        return redirect('/contacts?id=' . request()->post('id'));
      }

      Contact::update(request()->all());

      flash()->push('successfully_updated', 'Contact successfully updated!');

      return redirect('contacts');
  }
  }