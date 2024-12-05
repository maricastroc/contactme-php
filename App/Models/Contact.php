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
    public $first_name;
    public $last_name;
    public $description;
    public $phone_01;
    public $phone_02;
    public $created_at;
    public $updated_at;

    public static function create($data)
    {
      $database = new Database(config('database'));

      $database->query(
        query: "insert into contacts (user_id, first_name, last_name, description, phone_01, phone_02, created_at, updated_at) values (:user_id, :first_name, :last_name, :description, :phone_01, :phone_02, :created_at, :updated_at)",
        params: [
          'user_id' => auth()->id,
          'first_name' => $data['first_name'],
          'last_name' => $data['last_name'],
          'description' => $data['description'] ?? null,
          'phone_01' => secured_encrypt($data['phone_01']),
          'phone_02' => secured_encrypt($data['phone_02']),
          'created_at' => date('Y-m-d H:i:s'),
          'updated_at' => date('Y-m-d H:i:s'),
        ],
      );
    }

    public static function update($data)
    {
      $database = new Database(config('database'));
  
      $set = "first_name = :first_name, last_name = :last_name, description = :description";
  
      if($data['phone_01']) {
        $set .= ", phone_01 = :phone_01";
      }

      if($data['phone_02']) {
        $set .= ", phone_02 = :phone_02";
      }
  
      $database->query(
        query: "UPDATE contacts SET $set, updated_at = :updated_at WHERE id = :id",
        params: array_merge([
          'id' => $data['id'],
          'first_name' => $data['first_name'],
          'last_name' => $data['last_name'],
          'description' => $data['description'],
          'updated_at' => date('Y-m-d H:i:s'),
        ], $data['phone_01'] ? ['phone_01' => secured_encrypt($data['phone_01']),] : [],
        $data['phone_02'] ? ['phone_02' => secured_encrypt($data['phone_02']),] : [],
      ),
      );
    }

    public static function all($search = null)
    {
      $database = new Database(config('database'));
  
      $query = "SELECT * FROM contacts WHERE user_id = :user_id";
  
      if ($search) {
        $query .= " AND (first_name LIKE :search OR last_name LIKE :search)";
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

    public function contact($phone)
    {
      if(session()->get('show')) {
        return secured_decrypt($this->$phone);
      }
  
      return str_repeat('*', 12);
    }
  }