<?php

use function Core\flash;
use function Core\getErrors;
use function Core\old;

$validations = flash()->get('validations') ?? [];
;?>

<div class="flex flex-col md:grid md:grid-cols-2 bg-base-100">
  <div class="hero min-h-screen flex justify-center items-center px-4 md:px-10 lg:px-40 bg-base-100">
    <div class="md:-mt-20 hero-content text-center md:text-left">
      <div>
        <p class="py-2 text-lg md:text-xl text-gray-100">
          Welcome to
        </p>
        <h1 class="text-5xl lg:text-6xl font-bold">ContactMe.</h1>
        <p class="pt-6 md:pt-4 pb-4 text-lg md:text-xl text-gray-100">
          where you keep <span class="italic text-accent">your contacts</span> safely.
        </p>
      </div>
    </div>
  </div>

  <div class="bg-base-100 md:bg-white hero flex justify-center items-center px-4 lg:px-10">
    <div class="hero-content w-full max-w-md">
      <form action="/register" method="post" class="w-full">
        <div class="card bg-base-100 md:shadow-xl w-full">
          <div class="card-body">
            <div class="card-title text-gray-100 mb-4">Register here!</div>
            <label class="form-control w-full">
              <div class="label">
                <span class="label-text text-gray-100 text-md">Your name:</span>
              </div>
              <input name="name" type="text" placeholder="Jon Doe" class="input input-bordered w-full text-gray-100" spellcheck="false" value="<?= old('name') ?>" />
              <span class="text-error mt-1 pl-2 text-sm"><?= getErrors($validations, 'name') ?></span>            
            </label>
            <label class="form-control w-full">
              <div class="label">
                <span class="label-text text-gray-100 text-md">Your email:</span>
              </div>
              <input name="email" type="text" placeholder="user@email.com" class="input input-bordered w-full text-gray-100" spellcheck="false" value="<?= old('email') ?>" />
              <span class="text-error mt-1 pl-2 text-sm"><?= getErrors($validations, 'email') ?></span>
            </label>
            <label class="form-control w-full">
              <div class="label">
                <span class="label-text text-gray-100 text-md">Your password:</span>
              </div>
              <input name="password" type="password" placeholder="password" class="input input-bordered w-full text-gray-100" spellcheck="false" />
              <span class="text-error mt-1 pl-2 text-sm"><?= getErrors($validations, 'password') ?></span>
            </label>
            <label class="form-control w-full">
              <div class="label">
                <span class="label-text text-gray-100 text-md">Confirm your password:</span>
              </div>
              <input name="confirm_password" type="password" placeholder="confirm password" class="input input-bordered w-full text-gray-100" spellcheck="false" />
              <span class="text-error mt-1 pl-2 text-sm"><?= getErrors($validations, 'password') ?></span>
            </label>
            <div class="card-actions w-full mt-4">
              <button class="btn btn-primary btn-block text-base-100">Sign Up</button>
              <a href="/login" class="btn btn-link btn-primary btn-block text-gray-100">or login here</a>
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
