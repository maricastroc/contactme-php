<?php

namespace App\Controllers;

use App\Models\User;
use Core\Validation;

use function Core\auth;
use function Core\dd;
use function Core\flash;
use function Core\redirect;
use function Core\request;
use function Core\view;

class UpdateController {
    public function __invoke() {
        $validations = [];

        $rules = [
            'name' => ['required', 'min:3', 'max:255'],
            'email' => ['required'],
        ];

        if (!empty($data['password']) && !empty($data['new_password'])) {
            $rules['password'] = ['required', 'min:8'];
            $rules['new_password'] = ['required', 'min:8'];
        }

        $validation = Validation::validate($rules, request()->all());

        $validations = $validation->validations;

        $data = request()->all();

        if (!empty($validations)) {
            flash()->push('validations', $validations);
            return redirect('/contacts');
        }

        if (!empty($data['password']) && !password_verify($data['password'], auth()->password)) {
            flash()->push('errors', 'The provided password does not match your current password.');
            return redirect('/contacts');
        }

        User::update($data);

        flash()->push('updated_user', 'User successfully updated!');

        return redirect('/contacts');
    }
}
