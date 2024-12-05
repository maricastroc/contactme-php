<?php

use function Core\flash;
use function Core\getErrors;
use function Core\old;

$validations = flash()->get('validations') ?? [];
$message = flash()->get('successfully_registered');
?>

<div class="flex flex-col lg:flex-row gap-4 lg:gap-0 w-full h-screen lg:max-h-[75vh]">
  <div class="bg-base-300 box w-full rounded-box lg:w-56 lg:rounded-tr-none lg:rounded-br-none">
    <div class="bg-base-200 p-4 rounded-box lg:rounded-b-none lg:rounded-tr-none">
      + contact
    </div>
  </div>

  <div class="w-full bg-base-200 rounded-box lg:rounded-l-none p-6 lg:p-10 flex flex-col space-y-6 overflow-auto max-h-full">
    <form action="/contacts/create" method="post" class="flex flex-col space-y-6">
      <label class="form-control w-full">
        <div class="label">
          <span class="label-text">First Name</span>
        </div>
        <input name="first_name" type="text" placeholder="First name here" class="input input-bordered w-full" value="<?= old('first_name') ?>" />
        <span class="text-error mt-1 text-sm"><?= getErrors($validations, 'first_name') ?></span>
      </label>
      <label class="form-control w-full">
        <div class="label">
          <span class="label-text">Last Name</span>
        </div>
        <input value="<?= old('last_name') ?>" name="last_name" type="text" placeholder="Last name here" class="input input-bordered w-full" />
        <span class="text-error mt-1 text-sm"><?= getErrors($validations, 'last_name') ?></span>
      </label>
      <label class="form-control w-full">
        <div class="label">
          <span class="label-text">Phone Number</span>
        </div>
        <input value="<?= old('phone_01') ?>" name="phone_01" type="tel" pattern="\(\d{2}\) \d{4,5}-\d{4}" placeholder="(XX) XXXXX-XXXX" class="input input-bordered w-full" />
        <span class="text-error mt-1 text-sm"><?= getErrors($validations, 'phone_01') ?></span>
      </label>
      <label class="form-control w-full">
        <div class="label">
          <span class="label-text">Alternate Number</span>
        </div>
        <input value="<?= old('phone_02') ?>" name="phone_02" type="tel" pattern="\(\d{2}\) \d{4,5}-\d{4}" placeholder="(XX) XXXXX-XXXX" class="input input-bordered w-full" />
        <span class="text-error mt-1 text-sm"><?= getErrors($validations, 'phone_02') ?></span>
      </label>
      <label class="form-control">
        <div class="label">
          <span class="label-text">Description</span>
        </div>
        <textarea value="<?= old('description') ?>" name="description" class="textarea textarea-bordered h-24" placeholder="Here you can write any descriptions"></textarea>
        <span class="text-error mt-1 text-sm"><?= getErrors($validations, 'description') ?></span>
      </label>

      <div class="flex items-center justify-end">
        <button class="btn btn-primary">Save</button>
      </div>
    </form>
  </div>
</div>
