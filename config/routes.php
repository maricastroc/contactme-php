<?php

use App\Controllers\IndexController;
use App\Controllers\LoginController;
use App\Controllers\RegisterController;
use App\Controllers\Contacts;
use App\Controllers\LogoutController;
use App\Middlewares\AuthMiddleware;
use App\Middlewares\GuestMiddleware;
use Core\Route;

(new Route())
  ->get('/', IndexController::class, GuestMiddleware::class)

  ->get('/contacts', [Contacts\IndexController::class, 'index'], AuthMiddleware::class)

  ->get('/contacts/create', [Contacts\CreateController::class, 'index'], AuthMiddleware::class)
  ->post('/contacts/create', [Contacts\CreateController::class, 'create'], AuthMiddleware::class)

  ->put('/contact', [Contacts\UpdateController::class, 'update'], AuthMiddleware::class)

  ->delete('/contact', [Contacts\DeleteController::class, 'delete'], AuthMiddleware::class)
  ->get('/contact', [Contacts\DeleteController::class, 'index'], AuthMiddleware::class)

  ->get('/login', [LoginController::class, 'index'], GuestMiddleware::class)
  ->post('/login', [LoginController::class, 'login'], GuestMiddleware::class)

  ->get('/logout', LogoutController::class, AuthMiddleware::class, AuthMiddleware::class)

  ->get('/register', [RegisterController::class, 'index'], GuestMiddleware::class)
  ->post('/register', [RegisterController::class, 'register'], GuestMiddleware::class)

  ->post('/show', [Contacts\ShowController::class, 'show'], AuthMiddleware::class)
  ->get('/hide', [Contacts\ShowController::class, 'hide'], AuthMiddleware::class)
  ->get('/confirm', [Contacts\ShowController::class, 'confirm'], AuthMiddleware::class)

  ->run();
