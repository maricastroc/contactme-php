<?php

namespace App\Models;

use Core\Database;

use function Core\auth;
use function Core\config;
use function Core\session;

class User
{
    public $id;

    public $name;

    public $email;

    public $password;

    public static function make($item)
    {
        $user = new self;

        $user->id = $item['id'];
        $user->name = $item['name'];
        $user->password = $item['password'];
        $user->email = $item['email'];

        return $user;
    }

    public static function create($name, $email, $password)
    {
        $database = new Database(config('database'));

        $database->query(
            query: 'insert into users (email, password, name) values (:email, :password, :name)',
            params: [
                'email' => $email,
                'password' => password_hash($password, PASSWORD_DEFAULT),
                'name' => $name,
            ],
        );
    }

    public static function update($data)
    {
        $database = new Database(config('database'));

        $set = 'name = :name, email = :email';

        if ($data['new_password']) {
            $set .= ', password = :new_password';
        }

        $database->query(
            query: "UPDATE users SET $set WHERE id = :id",
            params: array_merge([
                'id' => auth()->id,
                'name' => $data['name'],
                'email' => $data['email'],
            ], $data['new_password'] ? ['new_password' => password_hash($data['new_password'], PASSWORD_DEFAULT)] : []),
        );

        $query = $database->query('SELECT * FROM users WHERE id = :id', User::class, ['id' => auth()->id]);

        $user = $query->fetch();

        session()->set('auth', $user);
    }
}
