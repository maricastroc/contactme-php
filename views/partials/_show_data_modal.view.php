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

  .bg-primary {
    background-color: #111111;
  }

  .border-white {
    border-color: #FFFFFF;
  }

  .bg-secondary {
    background-color: #1B1B1B;
  }

  .bg-tertiary {
    background-color: #303030;
  }

  .bg-brand {
    background-color: #C4F120;
  }

  .border-tertiary {
    border-color: #303030;
  }

  .content-primary {
    color: #FFFFFF;
  }

  .content-body {
    color: #E2E2E2;
  }

  .content-heading {
    color: #C6C6C6;
  }

  .content-placeholder {
    color: #777777;
  }

  .border-placeholder {
    border-color: #262626;
  }

  .content-muted {
    color: #5E5E5E;
  }

  .border-muted {
    border-color: #5E5E5E;
  }

  .content-inverse {
    color: #111111;
  }

  .accent-brand {
    color: #C4F120;
  }

  .accent-red {
    color: #E61E32;
  }

  .hero {
    min-height: 100vh;
  }

  .hero-content {
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
  }

  input::placeholder {
    color: #777777;
  }
</style>

<dialog id="show_data" class="modal">
  <div class="modal-box bg-secondary shadow-xl">
    <form method="dialog">
      <button class="btn btn-sm btn-ghost absolute right-2 top-2">✕</button>
    </form>
    <form action="/show" method="post" class="w-full">
      <div class="bg-secondary rounded-box w-full pt-10 pb-5 flex flex-col items-center">
        <div class="max-w-md">
          <h2 class="text-xl font-bold text-center">
            Please, re-enter your password to see all your decrypted contacts
          </h2>
          <div class="flex flex-col items-center gap-5 mt-10 justify-between mt-8">
            <label class="form-control w-full">
              <div class="label">
                <span class="label-text text-gray-100 text-md">Password</span>
              </div>
              <input type="password" name="password" placeholder="password" class="bg-[#1B1B1B] rounded-xl text-gray-100 input input-bordered w-full" spellcheck="false" />
            </label>
          </div>
          <div class="flex flex-col gap-1">
            <?php
            $fields = ['password'];
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
          <button
            class="mt-8 w-full btn bg-brand hover:bg-gray-300 rounded-xl content-inverse">
            Show Contacts
          </button>
        </div>
      </div>
    </form>
  </div>
</dialog>


