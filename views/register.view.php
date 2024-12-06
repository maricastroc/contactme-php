<?php

use function Core\flash;
use function Core\getErrors;
use function Core\old;

$validations = flash()->get('validations') ?? [];
;?>

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
  <div class="hero min-h-screen flex justify-center items-center px-4 md:px-10 lg:px-40 bg-[url('/data/images/project/bg-image.jpg')] bg-cover bg-center relative">
    <img src="/data/images/project/logo.svg" alt="Logo" class="absolute top-8 left-16 z-10 w-32 h-16" />
  </div>

  <div class="flex justify-center items-center px-4 lg:px-10 max-h-[100vh] overflow-hidden">
    <div class="w-full max-w-md mt-6 max-h-[92vh] overflow-auto">
      <form action="/register" method="post" class="w-full">
        <div class="bg-base-100 w-full ">
          <div class="card-body flex flex-col gap-2">
          <div class="card-title text-gray-100 mb-4 text-3xl">Register here</div>
            <label class="form-control w-full">
              <div class="label">
                <span class="label-text text-gray-100 text-md">Name</span>
              </div>
              <input name="name" type="text" placeholder="Jon Doe" class="input input-bordered w-full text-gray-100" spellcheck="false" value="<?= old('name') ?>" />
            </label>
            <label class="form-control w-full">
              <div class="label">
              <span class="label-text text-gray-100 text-md">Email</span>
              </div>
              <input name="email" type="text" placeholder="user@email.com" class="input input-bordered w-full text-gray-100" spellcheck="false" value="<?= old('email') ?>" />
            </label>
            <label class="form-control w-full">
              <div class="label">
                <span class="label-text text-gray-100 text-md">Password</span>
              </div>
              <input name="password" type="password" placeholder="password" class="input input-bordered w-full text-gray-100" spellcheck="false" />
            </label>
            <label class="form-control w-full">
              <div class="label">
                <span class="label-text text-gray-100 text-md">Confirm password</span>
              </div>
              <input name="confirm_password" type="password" placeholder="confirm password" class="input input-bordered w-full text-gray-100" spellcheck="false" />
            </label>

            <div class="flex flex-col gap-2 mt-4">
                <?php if (!empty($validations['email'])) : ?>
                  <?php foreach ($validations['email'] as $error) : ?>
                    <div class="flex items-center justify-start text-left">
                      <span class="flex items-center justify-center rounded-full w-4 h-4 bg-red-600">
                        <i class="ph ph-x text-[0.75rem] text-gray-900 font-bold"></i>
                      </span>
                      <div class="text-gray-100 pl-2 text-sm"><?= htmlspecialchars($error) ?></div>
                    </div>
                  <?php endforeach; ?>
                <?php endif; ?>

                <?php if (!empty($validations['password'])) : ?>
                  <?php foreach ($validations['password'] as $passwordError) : ?>
                    <div class="flex items-center justify-start text-left">
                      <span class="flex items-center justify-center rounded-full w-4 h-4 bg-red-600">
                        <i class="ph ph-x text-[0.75rem] text-gray-900 font-bold"></i>
                      </span>
                      <div class="text-gray-100 pl-2 text-sm"><?= htmlspecialchars($passwordError) ?></div>
                    </div>
                  <?php endforeach; ?>
                <?php endif; ?>

                <?php if (!empty($validations['name'])) : ?>
                  <?php foreach ($validations['name'] as $nameError) : ?>
                    <div class="flex items-center justify-start text-left">
                      <span class="flex items-center justify-center rounded-full w-4 h-4 bg-red-600">
                        <i class="ph ph-x text-[0.75rem] text-gray-900 font-bold"></i>
                      </span>
                      <div class="text-gray-100 pl-2 text-sm"><?= htmlspecialchars($nameError) ?></div>
                    </div>
                  <?php endforeach; ?>
                <?php endif; ?>

                <?php if (!empty($validations['confirm_password'])) : ?>
                  <?php foreach ($validations['confirm_password'] as $confirmPasswordError) : ?>
                    <div class="flex items-center justify-start text-left">
                      <span class="flex items-center justify-center rounded-full w-4 h-4 bg-red-600">
                        <i class="ph ph-x text-[0.75rem] text-gray-900 font-bold"></i>
                      </span>
                      <div class="text-gray-100 pl-2 text-sm"><?= htmlspecialchars($confirmPasswordError)?></div>
                    </div>
                  <?php endforeach; ?>
                <?php endif; ?>
              </div>

            <div class="card-actions w-full mt-4 flex items-center justify-center">
              <button class="btn btn-primary hover:bg-lime-600 bg-lime-400 btn-block text-base-100">Sign up</button>
              <div class="flex items-center gap-2 text-center">
                <span class="text-gray-200">Already have an account?</span>
                <a href="/login" class="link link-hover text-lime-400">Sign in here</a>
              </div>
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
