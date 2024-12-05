<?php

use function Core\dd;
use function Core\flash;
use function Core\getErrors;

$validations = flash()->get('validations') ?? [];
?>

<div class="bg-base-300 rounded-box w-full pt-20 flex flex-col items-center">
  <div class="max-w-md">
    <h2 class="text-2xl font-bold text-center">
      Are you sure you want to delete
      <span class="text-primary"><?= $selectedContact->first_name . ' ' . $selectedContact->last_name ?></span>
      contact? This action is irreversible!
    </h2>
    <div class="flex flex-col items-center gap-5 mt-10 justify-between mt-4">
      <form action="/contact" method="post" class="w-full">
        <input type="hidden" name="__method" value="DELETE">
        <input type="hidden" name="id" value="<?= isset($selectedContact) ? $selectedContact->id : '' ?>">
        <button class="w-full btn btn-error" type="submit">Yes, delete</button>
      </form>
      <a href="/contacts" type="button" class="w-full btn btn-primary">No, take me back!</a>
    </div>
  </div>
</div>