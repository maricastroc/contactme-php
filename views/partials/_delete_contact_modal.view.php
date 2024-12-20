<?php

use function Core\flash;

$validations = flash()->get('validations') ?? [];
$message = flash()->get('successfully_registered');
?>

<style>
  input:focus,
  a:focus {
    border-radius: 8px;
    outline: 1px solid #94a3b8;
    outline-offset: 0;
  }

  button:focus {
    outline: 1px solid #f5f5f5;
    outline-offset: 0;
  }

  .bg-secondary {
    background-color: #1B1B1B;
  }

  .bg-brand {
    background-color: #C4F120;
  }

  .content-inverse {
    color: #111111;
  }

  input::placeholder {
    color: #777777;
  }
</style>

<dialog id="delete_contact" class="modal">
  <div class="modal-box bg-secondary shadow-xl">
    <form method="dialog">
      <button class="btn btn-sm btn-ghost absolute right-2 top-2">✕</button>
    </form>
    <form action="/contacts" method="post" class="w-full">
      <input type="hidden" name="__method" value="DELETE">
      <input type="hidden" name="id" value="">
      <div class="bg-secondary rounded-box w-full pt-10 pb-5 flex flex-col items-center">
        <div class="max-w-md">
          <h2 class="text-xl font-bold text-center">
            Are you sure you want to delete this contact? This action is irreversible!
          </h2>
          <div class="flex flex-col items-center gap-5 mt-10 justify-between mt-8">
            <form action="/contact" method="post" class="w-full">
              <input type="hidden" name="__method" value="DELETE">
              <input type="hidden" name="id" id="delete_contact_id" value="">
              <button class="w-full btn btn-error rounded-xl" type="submit">Yes, delete</button>
            </form>
            <a href="/contacts" type="button" class="w-full btn bg-brand hover:bg-gray-300 rounded-xl content-inverse">No, take me back!</a>
          </div>
        </div>
      </div>
    </form>
  </div>
</dialog>
