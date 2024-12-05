<?php

namespace Core;

class Validation {
  public $validations = [];

  public static function validate($rules, $data) {
      $instance = new self();

      foreach ($rules as $field => $fieldRules) {
          foreach ($fieldRules as $rule) {
              if (method_exists($instance, $rule)) {
                  $instance->$rule($field, $data[$field] ?? null, $data);
              }

              else if (str_contains($rule, ":")) {
                $temp = explode(":", $rule);

                $rule = $temp[0];
                $minMax = $temp[1];

                $instance->$rule($minMax, $field, $data[$field] ?? null);
            }
          }
      }

      return $instance;
  }

  private function required($field, $fieldValue) {
    if (empty($fieldValue) || strlen($fieldValue) < 1) {
        $fieldName = ucfirst($field);

        $this->addError($field, "$fieldName is required.");
    }
}

  private function email($field, $fieldValue) {
      if (!filter_var($fieldValue, FILTER_VALIDATE_EMAIL)) {
          $this->addError($field, "$field is not valid.");
      }
  }

  private function confirmed($field, $fieldValue, $data) {
      $confirmField = "confirm_$field";
      $confirmFieldValue = $data[$confirmField] ?? null;

      if ($fieldValue !== $confirmFieldValue) {
          $this->addError($field, "$field and $confirmField don't match!");
      }
  }

  private function incorrect($field, $fieldValue, $data) {
    $confirmField = "confirm_$field";
    $confirmFieldValue = $data[$confirmField] ?? null;

    if ($fieldValue !== $confirmFieldValue) {
        $this->addError($field, "$field and $confirmField don't match!");
    }
}

  private function min($min, $field, $fieldValue) {
    if (strlen($fieldValue) < $min) {
      $fieldName = ucfirst($field);
        $this->addError($field, "$fieldName must have at least $min characters.");
    }
  }

  private function max($max, $field, $fieldValue) {
    if (strlen($fieldValue) > $max) {
        $this->addError($field, "$field must have a max of $max characters.");
    }
  }

  private function strong($field, $fieldValue) {
    if (!preg_match('/[!$&()*+,\-\.\/:;<=>\?%#@{}\[\]~^|_`]/', $fieldValue)) {
        $this->addError($field, "$field must have a special character.");
    }
  }

  private function unique($table, $field, $fieldValue) {
    $database = new Database(config('database'));

    $result = $database->query(
      query: "SELECT * from $table WHERE $field = :fieldValue",
      params: [
        'fieldValue' => $fieldValue,
      ],
    )->fetch();

    if ($result) {
      $this->addError($field, "E-mail already taken.");
    }
  }

  private function addError($field, $error) {
    $this->validations[$field][] = $error;
  }
}