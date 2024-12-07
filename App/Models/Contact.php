<?php

namespace App\Models;

use Core\Database;

use function Core\auth;
use function Core\config;
use function Core\secured_decrypt;
use function Core\secured_encrypt;
use function Core\session;

  class Contact {
    public $id;
    public $user_id;
    public $name;
    public $description;
    public $phone;
    public $email;
    public $avatar_url;
    public $created_at;
    public $updated_at;

    public static function create($data)
    {
      $database = new Database(config('database'));

      $database->query(
        query: "insert into contacts (user_id, name, email, phone, avatar_url, description, created_at, updated_at) values (:user_id, :name, :email, :phone, :avatar_url, :description, :created_at, :updated_at)",
        params: [
          'user_id' => auth()->id,
          'name' => $data['name'],
          'email' => secured_encrypt($data['email']),
          'description' => secured_encrypt($data['description']),
          'phone' => secured_encrypt($data['phone']),
          'avatar_url' => $data['avatar_url'],
          'created_at' => date('Y-m-d H:i:s'),
          'updated_at' => date('Y-m-d H:i:s'),
        ],
      );
    }

    public static function update($data)
    {
      $database = new Database(config('database'));
  
      $set = "name = :name, email = :email, description = :description, avatar_url = :avatar_url, phone = :phone";

  
      $database->query(
        query: "UPDATE contacts SET $set, updated_at = :updated_at WHERE id = :id",
        params: [
          'id' => $data['id'],
          'name' => $data['name'],
          'email' => secured_encrypt($data['email']),
          'description' => secured_encrypt($data['description']),
          'phone' => secured_encrypt($data['phone']),
          'avatar_url' => $data['avatar_url'],
          'updated_at' => date('Y-m-d H:i:s'),
        ],
      );
    }

    public static function find($id)
    {
      $database = new Database(config('database'));

      $query = $database->query("SELECT * FROM contacts WHERE id = :id", Contact::class, ['id' => $id]);
  
      return $query->fetch();
    }

    public static function all($search = null)
    {
      $database = new Database(config('database'));
  
      $query = "SELECT * FROM contacts WHERE user_id = :user_id";
  
      if ($search) {
        $query .= " AND name LIKE :search OR email LIKE :search OR phone LIKE :search";
    }
  
      $params = ['user_id' => auth()->id];
  
      if ($search) {
        $params['search'] = "%$search%";
      }
  
      return $database->query(
        query: $query,
        class: self::class,
        params: $params
      )->fetchAll();
    }

    public static function delete($id)
    {
      $database = new Database(config('database'));
  
      $database->query(
        query: "DELETE from contacts WHERE id = :id",
        params: [
          'id' => $id,
        ],
      );
    }

    public function contact($attribute)
    {
      if(session()->get('show')) {
        return secured_decrypt($this->$attribute);
      }
  
      return str_repeat('*', 12);
    }

    public static function findByLetter($letter)
{
    $database = new Database(config('database'));

    $query = "SELECT * FROM contacts WHERE user_id = :user_id AND name LIKE :letter";

    $params = [
        'user_id' => auth()->id,
        'letter' => $letter . '%',
    ];

    return $database->query(
        query: $query,
        class: self::class,
        params: $params
    )->fetchAll();
}
  }