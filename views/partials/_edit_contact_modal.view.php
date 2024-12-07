<?php

use function Core\flash;
use function Core\old;

$selectedContact = flash()->get('selected_contact') ?? [];

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

<dialog id="edit_contact" class="modal">
  <div class="modal-box bg-primary shadow-xl">
    <form method="dialog">
      <button class="btn btn-sm btn-ghost absolute right-2 top-2">✕</button>
    </form>
    <h3 class="text-lg font-bold">Edit Contact</h3>

    <form class="mt-10 flex flex-col space-y-4" action="/contacts" method="POST" id="form-update" enctype="multipart/form-data">
    <input type="hidden" name="__method" value="PUT">  
    <input type="hidden" name="id" value="">

      <div class="flex flex-col w-full items-center justify-center">
        <div class="flex items-center justify-center bg-secondary mt-4 w-[6rem] rounded-xl">
          <div id="image_preview_container" class="w-24 h-24 flex justify-center items-center">
            <img id="update_image_preview" src="" alt="Image Preview" class="w-[6rem] h-[6rem] rounded-xl object-cover" />
          </div>
        </div>

        <label class="form-control mt-5">
          <button type="button" class="btn btn-outline min-h-[2.5rem] h-[2.5rem] border-placeholder rounded-xl" onclick="document.getElementById('edit_avatar_input').click()">
            + Change Photo
          </button>
          <input type="file" id="edit_avatar_input" name="avatar_url" accept="image/*" class="hidden" onchange="editPreviewImage(event); console.log('File input changed');" />
        </label>
      </div>

      <label class="form-control w-full">
        <div class="label">
          <span class="label-text">Name</span>
        </div>
        <input name="name" type="text" placeholder="e.g. Jon Doe" class="input bg-secondary rounded-xl input-bordered w-full" value="<?= old('name') ?>" />
      </label>

      <label class="form-control w-full">
        <div class="label">
          <span class="label-text">E-mail</span>
        </div>
        <input value="<?= old('email') ?>" name="email" type="email" placeholder="user@email.com" class="input bg-secondary rounded-xl input-bordered w-full" />
      </label>

      <label class="form-control w-full">
        <div class="label">
          <span class="label-text">Phone Number</span>
        </div>
        <input value="<?= old('phone') ?>" name="phone" type="tel" pattern="\(\d{2}\) \d{4,5}-\d{4}" placeholder="(XX) XXXXX-XXXX" class="input bg-secondary rounded-xl input-bordered w-full" />
      </label>

      <label class="form-control">
        <div class="label">
          <span class="label-text">Description</span>
        </div>
        <input value="<?= old('description') ?>" name="description" class="input bg-secondary rounded-xl input-bordered w-full" placeholder="e.g. work / friend / family" />
      </label>

      <div class="flex flex-col gap-1">
        <?php 
        $fields = ['name', 'phone', 'email', 'avatar_url', 'description'];
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
function editPreviewImage(event) {
  const file = event.target.files[0];

  const reader = new FileReader();

  if (!file) {
    console.log('No file selected');
    return;
  }

  reader.onload = function(e) {
    const imgElement = document.getElementById("update_image_preview");

    imgElement.src = e.target.result;

    imgElement.classList.remove("hidden");
  };

  reader.onerror = function(error) {
    console.error('Error reading file:', error);
  };

  reader.readAsDataURL(file);
}
</script>
