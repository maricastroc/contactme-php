<?php

namespace Core;

function base_path($path = '')
{
  return realpath(__DIR__ . '/../') . DIRECTORY_SEPARATOR . $path;
}

function view($view, $data = [], $template = 'app')
{
  extract($data);

  require base_path("views/template/{$template}.php");
}

function abort($code)
{
  view($code);

  die();
}

function auth()
{
  if (!isset($_SESSION['auth'])) {
    return null;
  }

  return $_SESSION['auth'];
}

function dd($dump)
{
  echo '<pre>';

  if (is_iterable($dump)) {
    foreach ($dump as $item) {
      var_dump($item);
    }
  } else {
    var_dump($dump);
  }

  echo '</pre>';
  die();
}

function config($key = null)
{
  $config = require base_path('config/config.php');

  if (strlen($key) > 0) {
    $tmp = null;

    foreach(explode('.', $key) as $index => $key) {
      $tmp = $index == 0 ? $config[$key] : $tmp[$key];
    }
    return $tmp;
  }

  return $config;
}

function flash()
{
  return new Flash;
}

function old($field)
{
  $post = $_POST;

  if (isset($post)) {
    return $post[$field] ?? '';
  }

  return '';
}

function getErrors($validations, $field)
{
    $errors = isset($validations[$field]) ? $validations[$field] : [];

    return !empty($errors) ? implode('<br>', $errors) : '';
}

function redirect($uri)
{
  return header('Location:' . $uri);
}

function request()
{
  return new Request();
}

function session()
{
  return new Session();
}

function secured_encrypt($data)
{
  $first_key = base64_decode(config('security.first_key'));
  $second_key = base64_decode(config('security.second_key'));

  $method = "aes-256-cbc";
  $iv_length = openssl_cipher_iv_length($method);
  $iv = openssl_random_pseudo_bytes($iv_length);

  $first_encrypted = openssl_encrypt($data, $method, $first_key, OPENSSL_RAW_DATA, $iv);
  $second_encrypted = hash_hmac('sha3-512', $first_encrypted, $second_key, TRUE);

  $output = base64_encode($iv . $second_encrypted . $first_encrypted);
  return $output;
}

function secured_decrypt($input)
{
  $first_key = base64_decode(config('security.first_key'));
  $second_key = base64_decode(config('security.second_key'));
  $mix = base64_decode($input);

  $method = "aes-256-cbc";
  $iv_length = openssl_cipher_iv_length($method);

  $iv = substr($mix, 0, $iv_length);
  $second_encrypted = substr($mix, $iv_length, 64);
  $first_encrypted = substr($mix, $iv_length + 64);

  $data = openssl_decrypt($first_encrypted, $method, $first_key, OPENSSL_RAW_DATA, $iv);
  $second_encrypted_new = hash_hmac('sha3-512', $first_encrypted, $second_key, TRUE);

  if (hash_equals($second_encrypted, $second_encrypted_new))
    return $data;

  return false;
}

function env($key, $default = null)
{
    $env = parse_ini_file(base_path('.env'));

    if (isset($env[$key])) {
        return $env[$key];
    }

    return $default;
}
