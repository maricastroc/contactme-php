<?php

namespace App\Controllers;

use App\Models\User;
use Core\Database;
use Core\Validation;

use function Core\config;
use function Core\flash;
use function Core\redirect;
use function Core\request;
use function Core\session;
use function Core\view;

class LoginController
{
    public function index()
    {
        return view('/index', template: 'guest');
    }

    public function login()
    {
        $validations = [];

        $rules = [
            'email' => ['required'],
            'password' => ['required', 'min:8'],
        ];

        $validation = Validation::validate($rules, request()->all());

        $validations = $validation->validations;

        if (! empty($validations)) {
            flash()->push('validations', $validations);

            return view('/index', template: 'guest');
        }

        $database = new Database(config('database'));

        $query = $database->query('SELECT * FROM users WHERE email = :email', User::class, ['email' => request()->post('email')]);

        $user = $query->fetch();

        if (! $user) {
            flash()->push('validations', ['email' => [
                'Incorrect e-mail or password!',
            ]]);

            return view('index', template: 'guest');
        }

        if (! password_verify(request()->post('password'), $user->password)) {
            flash()->push('validations', ['email' => [
                'Incorrect e-mail or password!',
            ]]);

            return view('index', template: 'guest');
        }

        session()->set('auth', $user);

        return redirect('contacts');
    }
}
