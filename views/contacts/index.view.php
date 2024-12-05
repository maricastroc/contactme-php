<?php


use function Core\getErrors;
use function Core\request;
use function Core\flash;

$validations = flash()->get('validations') ?? [];
?>

<div class="flex flex-col lg:flex-row gap-4 lg:gap-0 w-full lg:max-h-[75vh]">
  <ul class="w-full bg-base-300 box rounded-box lg:rounded-r-none flex flex-col divide-y divide-base-100 lg:w-56 w-full">
    <?php if (isset($contacts)) : ?>
      <?php

      foreach ($contacts as $key => $contact) : ?>
        <a href="/contacts?id=<?= $contact->id ?><?= request()->get('search', '', '&search=') ?>" class="focus:outline-none flex flex-col gap-1 w-full text-gray-100 px-4 py-3 cursor-pointer hover:bg-base-200
    <?php if ($key == 0) : ?> rounded-t-box lg:rounded-tr-none <?php endif; ?>
    <?php if ($contact->id == $selectedContact->id) : ?> bg-base-200 <?php endif; ?>">
          <?= $contact->first_name . ' ' . $contact->last_name ?>
          <span class="text-sm"> id: <?= $contact->id ?> </span>
        </a>
      <?php endforeach; ?>
    <?php endif; ?>
  </ul>

  <div class="bg-base-200 w-full rounded-box lg:rounded-l-none p-6 lg:p-10 flex flex-col space-y-6">
    <form class="w-full overflow-auto max-h-full" action="/contact" method="POST" id="form-update">
      <input type="hidden" name="__method" value="PUT">
      <input type="hidden" name="id" value="<?= isset($selectedContact) ? $selectedContact->id : '' ?>">
      <label class="form-control w-full">
        <div class="label">
          <span class="label-text">First Name</span>
        </div>
        <input value="<?= isset($selectedContact) ? $selectedContact->first_name : '' ?>" name="first_name" type="text" placeholder="First name here" class="input input-bordered w-full" />
        <span class="text-error mt-1 text-sm"><?= getErrors($validations, 'first_name') ?></span>
      </label>
      <label class="form-control w-full">
        <div class="label">
          <span class="label-text">Last Name</span>
        </div>
        <input value="<?= isset($selectedContact) ? $selectedContact->last_name : '' ?>" name="last_name" type="text" placeholder="Last name here" class="input input-bordered w-full" />
        <span class="text-error mt-1 text-sm"><?= getErrors($validations, 'last_name') ?></span>
      </label>
      <label class="form-control w-full">
        <div class="label">
          <span class="label-text">Main Phone</span>
        </div>
        <input value="<?= isset($selectedContact) ? $selectedContact->contact('phone_01') : '' ?>" name="phone_01" type="tel" pattern="\(\d{2}\) \d{4,5}-\d{4}" placeholder="(XX) XXXXX-XXXX" class="input input-bordered w-full" />
        <span class="text-error mt-1 text-sm"><?= getErrors($validations, 'phone_01') ?></span>
      </label>
      <label class="form-control w-full">
        <div class="label">
          <span class="label-text">Alternate Phone</span>
        </div>
        <input value="<?= isset($selectedContact) ? $selectedContact->contact('phone_01') : '' ?>" type="tel" pattern="\(\d{2}\) \d{4,5}-\d{4}" placeholder="(XX) XXXXX-XXXX" class="input input-bordered w-full" />
        <span class="text-error mt-1 text-sm"><?= getErrors($validations, 'phone_02') ?></span>
      </label>
      <label class="form-control mt-4">
        <div class="label">
          <span class="label-text">Description</span>
        </div>
        <textarea name="description" class="textarea textarea-bordered h-24 w-full" placeholder="Description here"><?= isset($selectedContact) ? $selectedContact->description : '' ?></textarea>
        <span class="text-error mt-1 text-sm"><?= getErrors($validations, 'description') ?></span>
      </label>
    </form>
    <div class="flex items-center justify-between mt-4">
      <form action="/contact">
        <input type="hidden" name="id" value="<?= isset($selectedContact) ? $selectedContact->id : '' ?>">
        <button class="btn btn-error" type="submit">Delete</button>
      </form>
      <button class="btn btn-primary" type="submit" form="form-update">Update</button>
    </div>
  </div>
</div>