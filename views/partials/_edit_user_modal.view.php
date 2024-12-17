<?php

use function Core\auth;
use function Core\flash;

$validations = flash()->get('validations') ?? [];
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

  .bg-secondary {
    background-color: #1B1B1B;
  }

  .bg-brand {
    background-color: #C4F120;
  }

  .border-placeholder {
    border-color: #262626;
  }

  .content-inverse {
    color: #111111;
  }

  input::placeholder {
    color: #777777;
  }
</style>

<dialog id="edit_user" class="modal">
  <div class="modal-box bg-secondary shadow-xl">
    <form method="dialog">
      <button class="btn btn-sm btn-ghost absolute right-2 top-2">✕</button>
    </form>
    <h3 class="text-lg font-bold">Edit Profile</h3>

    <form class="mt-10 flex flex-col space-y-4"  method="POST" action="/contacts/user" id="form-update" enctype="multipart/form-data">

      <label class="form-control w-full">
        <div class="label">
          <span class="label-text">Name</span>
        </div>
        <input required name="name" type="text" placeholder="e.g. Jon Doe" class="input bg-secondary rounded-xl input-bordered w-full" value="<?= auth()->name ?>" />
      </label>

      <label class="form-control w-full">
        <div class="label">
          <span class="label-text">E-mail</span>
        </div>
        <input required value="<?= auth()->email ?>" name="email" type="email" placeholder="user@email.com" class="input bg-secondary rounded-xl input-bordered w-full" />
      </label>

      <label class="form-control w-full hidden" id="password_input">
        <div class="label">
          <span class="label-text">Actual Password</span>
        </div>
        <input id="password_field" value="" name="password" type="password" placeholder="password" class="input bg-secondary rounded-xl input-bordered w-full" />
      </label>

      <label class="form-control w-full hidden" id="new_password_input">
        <div class="label">
          <span class="label-text">New Password</span>
        </div>
        <input id="new_password_field" value="" name="new_password" type="password" placeholder="password" class="input bg-secondary rounded-xl input-bordered w-full" />
      </label>

      <div class="form-control">
        <label class="label cursor-pointer">
          <span class="label-text">Change Password?</span>
          <input id="toggle_password" type="checkbox" class="checkbox" />
        </label>
      </div>

      <div class="flex flex-col gap-1">
        <?php 
        $fields = ['name', 'email'];
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

      <div class="flex items-center justify-end">
        <button class="btn bg-brand hover:bg-gray-300 rounded-xl content-inverse">Save</button>
      </div>
    </form>
  </div>
</dialog>


<script>
 function handleChangePassword() {
  const passwordInput = document.getElementById("password_input");
  const newPasswordInput = document.getElementById("new_password_input");
  const passwordField = document.getElementById("password_field");
  const newPasswordField = document.getElementById("new_password_field");

  if (passwordInput.classList.contains("hidden")) {
    passwordInput.classList.remove("hidden");
    newPasswordInput.classList.remove("hidden");
    passwordField.setAttribute("required", "required");
    newPasswordField.setAttribute("required", "required");
  } else {
    passwordInput.classList.add("hidden");
    newPasswordInput.classList.add("hidden");
    passwordField.removeAttribute("required");
    newPasswordField.removeAttribute("required");
  }
}

  document.getElementById("toggle_password").addEventListener("change", handleChangePassword);
</script>