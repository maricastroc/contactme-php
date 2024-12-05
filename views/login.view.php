<?php

use function Core\flash;
use function Core\getErrors;
use function Core\old;

$validations = flash()->get('validations') ?? [];
$message = flash()->get('successfully_registered');
?>

<div class="flex flex-col md:grid md:grid-cols-2 bg-base-100">
<?php if (!empty($message)) : ?>
    <p class="text-indigo-400 font-mono mb-2 text-center">
        <div class="toast toast-top toast-start" id="toastMessage">
            <div class="alert alert-success">
                <span><?= htmlspecialchars($message) ?></span>
            </div>
        </div>
    </p>
<?php endif; ?>
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
      <form action="/login" method="post" class="w-full">
        <div class="card bg-base-100 md:shadow-xl w-full">
          <div class="card-body">
            <div class="card-title text-gray-100 mb-4">Login here!</div>
            <label class="form-control w-full">
              <div class="label">
                <span class="label-text text-gray-100 text-md">Your email:</span>
              </div>
              <input type="text" name="email" placeholder="user@email.com" class="text-gray-100 input input-bordered w-full" spellcheck="false" value="<?= old('email') ?>" />
              <span class="text-error mt-1 pl-2 text-sm"><?= getErrors($validations, 'email') ?></span>
            </label>
            <label class="form-control w-full">
              <div class="label">
                <span class="label-text text-gray-100 text-md">Your password:</span>
              </div>
              <input type="password" name="password" placeholder="password" class="text-gray-100 input input-bordered w-full" spellcheck="false" />
              <span class="text-error mt-1 pl-2 text-sm"><?= getErrors($validations, 'password') ?></span>
            </label>
            <div class="card-actions w-full mt-4">
              <button class="btn btn-primary btn-block text-base-100">Login</button>
              <a href="/register" class="btn btn-link btn-primary btn-block text-gray-100">or sign up here</a>
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