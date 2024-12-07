<?php

use function Core\base_path;
use function Core\flash;
use function Core\request;
use function Core\session;

$message = flash()->get('errors');

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

  .bg-tertiary {
    background-color: #303030;
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

  .accent-brand {
    color: #C4F120;
  }

  input::placeholder {
    color: #777777;
  }
</style>

<div class="lg:max-h-[85vh] overflow-auto w-full p-6 lg:p-10 rounded-3xl flex bg-secondary flex-col gap-4">

  <?php if (!empty($message)) : ?>
    <p class="text-indigo-400 font-mono mb-2 text-center">
    <div class="toast toast-top toast-end" id="toastMessage">
      <div class="alert alert-error bg-red-500">
        <span><?= htmlspecialchars($message) ?></span>
      </div>
    </div>
    </p>
  <?php endif; ?>

  <?php require base_path("views/partials/_add_contact_modal.view.php"); ?>
  <?php require base_path("views/partials/_edit_contact_modal.view.php"); ?>
  <?php require base_path("views/partials/_delete_contact_modal.view.php"); ?>
  <?php require base_path("views/partials/_show_data_modal.view.php"); ?>

  <div class="flex flex-col lg:flex-row items-center lg:items-start justify-between w-full">
    <h1 class="text-2xl content-primary font-bold">Contacts List</h1>

    <div class="mt-6 lg:mt-0 flex flex-col lg:flex-row gap-3 lg:gap-2">
      <form action="/contacts" class="">
        <label class="content-placeholder input input-bordered h-[2.5rem] rounded-xl flex items-center gap-2 bg-secondary">
          <input value="<?= request()->get('search', '') ?>" type="text" class="grow" name="search" placeholder="Search" />
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="h-4 w-4 opacity-70">
            <path fill-rule="evenodd" d="M9.965 11.026a5 5 0 1 1 1.06-1.06l2.755 2.754a.75.75 0 1 1-1.06 1.06l-2.755-2.754ZM10.5 7a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0Z" clip-rule="evenodd" />
          </svg>
        </label>
      </form>

      <button class="btn bg-tertiary font-normal min-h-[2.5rem] h-[2.5rem] content-primary rounded-xl" onclick="add_contact.showModal()">+ Add Contact</button>

      <?php if (session()->get('show')): ?>
          <a href="hide" class="btn border border-tertiary btn-outline font-normal min-h-[2.5rem] h-[2.5rem] content-heading rounded-xl">
          <i class="ph ph-lock-key-open text-lg font-bold"></i>
          </a>
          <?php else: ?>
            <button onclick="show_data.showModal()" class="btn border border-tertiary btn-outline font-normal min-h-[2.5rem] h-[2.5rem] content-heading rounded-xl">
        <i class="ph ph-lock-key text-lg font-bold"></i>
      </button>
            <?php endif; ?>
    </div>
  </div>

  <div class="flex gap-10 mt-6 flex-col lg:flex-row">
    <?php require base_path("views/partials/_filter-bar.view.php"); ?>

    <div class="overflow-x-auto w-full lg:max-h-[60vh]">
      <table class="table table-auto w-full">
        <thead>
          <tr class="border-b border-placeholder">
            <th class="content-heading">NAME</th>
            <th class="content-heading">PHONE</th>
            <th class="content-heading">EMAIL</th>
            <th class="content-heading"></th>
          </tr>
        </thead>
        <tbody>
          <?php
          foreach ($contacts as $key => $contact) : ?>
            <tr class="border-b border-placeholder">
              <td>
                <div class="flex items-center gap-3">
                  <div class="avatar">
                    <div class="mask mask-squircle h-12 w-12">
                      <img src=<?= $contact->avatar_url ?? 'https://avatars.githubusercontent.com/u/583231?v=4' ?> alt="Avatar Tailwind CSS Component" />
                    </div>
                  </div>
                  <div>
                    <div class="content-body font-normal"><?= $contact->name ?></div>
                    <div class="text-sm content-body font-normal opacity-50"><?= $contact->contact('description') ?></div>
                  </div>
                </div>
              </td>
              <td class="content-body font-normal"><?= $contact->contact('phone') ?></td>
              <td class="content-body font-normal"><?= $contact->contact('email') ?></td>
              <th>
                <div class="flex">
                  <button <?php if (!session()->get('show')): ?> disabled <?php endif; ?> onclick="openEditModal(this)" class="btn border disabled:bg-zinc-900 border-tertiary btn-outline px-3 rounded-lg font-normal min-h-[2rem] h-[2rem] content-primary rounded-xl" data-id="<?= $contact->id ?>" data-name="<?= htmlspecialchars($contact->name) ?>" data-phone="<?= htmlspecialchars($contact->contact('phone')) ?>" data-email="<?= htmlspecialchars($contact->contact('email')) ?>" data-description="<?= htmlspecialchars($contact->contact('description')) ?>" data-avatar="<?= htmlspecialchars($contact->avatar_url ?? '') ?>">
                    <i class="ph ph-pencil-simple text-md font-bold"></i> Edit
                  </button>
                  <button class="ml-2 btn border border-tertiary btn-outline w-[2rem] rounded-lg font-normal min-h-[2rem] h-[2rem] content-primary rounded-xl"><i class="ph ph-lock-key text-md font-bold"></i></button>
                  <button data-id="<?= $contact->id ?>" id="delete_contact" onclick="openDeleteModal(this)" class="ml-2 btn border border-tertiary btn-outline w-[2rem] rounded-lg font-normal min-h-[2rem] h-[2rem] content-primary rounded-xl"><i class="ph ph-trash-simple text-md font-bold"></i></button>
                </div>
              </th>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>


<script>
  function openEditModal(button) {
    const modal = document.getElementById('edit_contact');

    modal.querySelector('input[name="id"]').value = button.dataset.id;
    modal.querySelector('input[name="name"]').value = button.dataset.name;
    modal.querySelector('input[name="phone"]').value = button.dataset.phone;
    modal.querySelector('input[name="email"]').value = button.dataset.email;
    modal.querySelector('input[name="description"]').value = button.dataset.description;

    const avatarUrl = button.dataset.avatar;

    localStorage.setItem('avatar_url', avatarUrl);

    const savedAvatarUrl = localStorage.getItem("avatar_url");
    const imgElement = document.getElementById("update_image_preview");

    if (savedAvatarUrl) {
      imgElement.src = savedAvatarUrl;
      imgElement.classList.remove("hidden");
    }

    modal.showModal();
  }
</script>

<script>
  function openDeleteModal(button) {
    const contactId = button.getAttribute('data-id');
    const idInput = document.getElementById('delete_contact_id');

    idInput.value = contactId;

    const deleteModal = document.getElementById('delete_contact');
    deleteModal.showModal();
  }
</script>