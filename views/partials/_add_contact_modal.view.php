<?php

use function Core\flash;
use function Core\old;

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

<dialog id="add_contact" class="modal">
  <div class="modal-box bg-secondary shadow-xl">
    <form method="dialog">
      <button class="btn btn-sm btn-ghost absolute right-2 top-2">✕</button>
    </form>
    <h3 class="text-lg font-bold">Add Contact</h3>

    <form action="/contacts" method="post" class="mt-10 flex flex-col space-y-6" enctype="multipart/form-data">

      <div class="flex flex-col w-full items-center justify-center">
        <div class="flex items-center justify-center bg-secondary border-2 border-gray-500 mt-4 w-[6rem] rounded-xl">
          <div id="image_preview_container" class="w-24 h-24 flex justify-center items-center">
            <i id="user_icon" class="ph ph-user text-[4rem] text-gray-500"></i>
            <img id="image_preview" src="" alt="Image Preview" class="w-[6rem] h-[6rem] rounded-xl object-cover hidden" />
          </div>
        </div>

        <label class="form-control mt-5">
          <button type="button" class="btn btn-outline min-h-[2.5rem] h-[2.5rem] border-placeholder rounded-xl" onclick="document.getElementById('avatar_input').click()">
            + Add Photo
          </button>
          <input type="file" id="avatar_input" name="avatar_url" accept="image/*" class="hidden" onchange="previewImage(event)" />
        </label>
      </div>

      <label class="form-control w-full">
        <div class="label">
          <span class="label-text">Name</span>
        </div>
        <input required name="name" type="text" placeholder="e.g. Jon Doe" class="input bg-secondary rounded-xl input-bordered w-full" value="<?= old('first_name') ?>" />
      </label>

      <label class="form-control w-full">
        <div class="label">
          <span class="label-text">E-mail</span>
        </div>
        <input required value="<?= old('email') ?>" name="email" type="email" placeholder="user@email.com" class="input bg-secondary rounded-xl input-bordered w-full" />
      </label>

      <label class="form-control w-full">
        <div class="label">
          <span class="label-text">Phone Number</span>
        </div>
        <input required value="<?= old('phone') ?>" name="phone" type="tel" pattern="\(\d{2}\) \d{4,5}-\d{4}" placeholder="(XX) XXXXX-XXXX" class="input bg-secondary rounded-xl input-bordered w-full" />
      </label>

      <label class="form-control">
        <div class="label">
          <span class="label-text">Description</span>
        </div>
        <input required value="<?= old('description') ?>" name="description" class="input bg-secondary rounded-xl input-bordered w-full" placeholder="e.g. work / friend / family" />
      </label>

      <div class="flex flex-col gap-1">
        <?php
        $fields = ['name', 'phone', 'email', 'avatar_url', 'description'];
foreach ($fields as $field) {
    if (! empty($validations[$field])) {
        foreach ($validations[$field] as $error) { ?>
              <div class="flex items-center justify-start text-left">
                <span class="flex items-center justify-center rounded-full w-4 h-4 bg-red-600">
                  <i class="ph ph-x text-[0.75rem] text-gray-900 font-bold"></i>
                </span>
                <div class="text-gray-100 pl-2 text-sm"><?= htmlspecialchars($error) ?></div>
              </div>
            <?php }
        }
}
?>
      </div>

      <div class="flex items-center justify-end">
        <button class="btn hover:bg-gray-300 bg-brand rounded-xl content-inverse">Save</button>
      </div>
    </form>
  </div>
</dialog>

<script>
function previewImage(event) {
  const file = event.target.files[0];
  const reader = new FileReader();

  if (!file) {
    console.log('No file selected');
    return;
  }

  reader.onload = function(e) {
    const imgElement = document.getElementById("image_preview");
    const userIcon = document.getElementById("user_icon");

    imgElement.src = e.target.result;
    imgElement.classList.remove("hidden");
    userIcon.classList.add("hidden");
  };

  reader.onerror = function(error) {
    console.error('Error reading file:', error);
  };

  reader.readAsDataURL(file);
}
</script>

<script>
  document.addEventListener("DOMContentLoaded", function () {
    const modal = document.getElementById("add_contact");
    const hasValidations = <?= json_encode(! empty($validations)); ?>;

    if (hasValidations) {
      modal.showModal();
    }
  });
</script>