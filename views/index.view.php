<?php

use function Core\flash;
use function Core\old;

$validations = flash()->get('validations') ?? [];
$message = flash()->get('successfully_registered');
?>

<div class="flex flex-col md:grid md:grid-cols-2 bg-base-100">
  <div class="hero min-h-screen flex justify-center items-center px-4 md:px-10 lg:px-40 bg-[url('/data/images/project/bg-image.jpg')] bg-cover bg-center relative">

    <img src="/data/images/project/logo.svg" alt="Logo" class="absolute top-8 left-16 z-10 w-32 h-16" />
  </div>

  <div class="bg-[#111111] flex justify-center items-center px-4 lg:px-10">
    <div class="w-full max-w-md">
      <form action="/login" method="post" class="w-full">
        <div class="card w-full">
          <div class="card-body">
            <div class="card-title text-gray-100 mb-4 text-3xl">Sign in here</div>
            <label class="form-control w-full">
              <div class="label">
                <span class="label-text text-gray-100 text-md">Email</span>
              </div>
              <input type="text" name="email" placeholder="user@email.com" class="bg-[#1B1B1B] text-gray-100 input input-bordered w-full" spellcheck="false" value="<?= old('email') ?>" />
            </label>
            <label class="form-control w-full">
              <div class="label">
                <span class="label-text text-gray-100 text-md">Password</span>
              </div>
              <input type="password" name="password" placeholder="password" class="bg-[#1B1B1B] text-gray-100 input input-bordered w-full" spellcheck="false" />
            </label>
            <div>
            <div class="flex flex-col mt-4 gap-2">
        <?php 
        $fields = ['name', 'password'];
        foreach ($fields as $field) : 
          if (!empty($validations[$field])) : 
            foreach ($validations[$field] as $error) : ?>
              <div class="flex items-center justify-start text-left">
                <span class="flex items-center justify-center rounded-full w-4 h-4 bg-red-600">
                  <i class="ph ph-x text-[0.75rem] text-gray-900 font-bold"></i>
                </span>
                <div class="text-gray-100 pl-2 text-sm"><?= htmlspecialchars($error) ?></div>
              </div>
            <?php endforeach; 
          endif; 
        endforeach; 
        ?>
      </div>
            </div>
            <div class="card-actions w-full mt-4 flex items-center justify-center">
              <button class="btn btn-primary hover:bg-lime-600 bg-lime-400 btn-block text-base-100">Login</button>
              <div class="flex items-center gap-2 text-center">
                <span class="text-gray-200">Don't have an account?</span>
                <a href="/register" class="link link-hover text-lime-400">Sign up here</a>
              </div>
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>

<script>
  window.onload = function() {
    const toast = document.getElementById('toastMessage');
    if (toast) {
      setTimeout(function() {
        toast.style.display = 'none';
      }, 3000);
    }
  };
</script>