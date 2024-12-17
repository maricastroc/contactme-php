<?php

namespace App\Controllers\Contacts;

use Core\Validation;

use function Core\flash;
use function Core\redirect;
use function Core\request;
use function Core\session;

class ShowController
{
    public function show()
    {
        $validations = [];

        $rules = [
            'password' => ['required'],
        ];

        $validation = Validation::validate($rules, request()->all());

        $validations = $validation->validations;

        if (! empty($validations)) {
            flash()->push('errors', 'Incorrect password.');

            return redirect('/contacts');
        }

        session()->set('show', true);

        return redirect('/contacts');
    }

    public function hide()
    {
        session()->forget('show');

        return redirect('/contacts');
    }

    public function confirm()
    {
        return redirect('/contacts');
    }
}
