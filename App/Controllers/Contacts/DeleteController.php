<?php

namespace App\Controllers\Contacts;

use App\Models\Contact;
use Core\Validation;

use function Core\flash;
use function Core\redirect;
use function Core\request;

  class DeleteController {   
    public function delete() {
      $validations = [];
  
      $rules = [
        'id' => ['required'],
      ];

      $validation = Validation::validate($rules, request()->all());
  
      $validations = $validation->validations;

      if (!empty($validations)) {
        flash()->push('validations', $validations);
        return redirect('/contacts');
      }
  
      Contact::delete(request()->post('id'));

      flash()->push('successfully_deleted', 'Contact successfully deleted!');

      return redirect('contacts');
  }
  }