<?php

namespace App\Controllers\Contacts;

use App\Models\Contact;
use Core\Database;
use Core\Validation;

use function Core\config;
use function Core\dd;
use function Core\flash;
use function Core\redirect;
use function Core\request;
use function Core\view;

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
        return redirect('/contacts?id=' . request()->post('id'));
      }
  
      Contact::delete(request()->post('id'));

      flash()->push('successfully_deleted', 'Contact successfully deleted!');

      return redirect('contacts');
  }

  public function index() {
    $id = request()->get('id', '');

    if (!$id) {
      return view('contacts/not-found');
    }

    $database = new Database(config('database'));

    $query = $database->query("SELECT * FROM contacts WHERE id = :id", Contact::class, ['id' => $id])->fetch();

    return view('contacts/delete', [
      'selectedContact' => $query,
    ]); 
}
  }