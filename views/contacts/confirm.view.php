<?php

use function Core\flash;
use function Core\getErrors;

$validations = flash()->get('validations') ?? [];
?>

<div class="bg-base-300 rounded-box w-full pt-20 flex flex-col items-center">
  <form action="show" method="post" class="max-w-md">
    <div>
      <h2 class="text-2xl font-bold">Please, re-enter your password to see all your decrypted contacts</h2>
    <label class="form-control w-full mt-5">
              <div class="label">
                <span class="label-text text-gray-100 text-md">Your password:</span>
              </div>
              <input type="password" name="password" placeholder="password" class="text-gray-100 input input-bordered w-full" spellcheck="false" />
              <span class="text-error mt-1 pl-2 text-sm"><?= getErrors($validations, 'password') ?></span>
            </label>
    <button class="btn btn-primary mt-5 w-full">Open my Contacts</button>
    </div>
  </form>
</div>
