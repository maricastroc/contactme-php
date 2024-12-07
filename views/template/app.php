<?php

use function Core\auth;
use function Core\base_path;
use function Core\flash;

$user = $_SESSION['auth'] ?? null;
$message = flash()->get('successfully_updated') ?: flash()->get('successfully_created') ?: flash()->get('successfully_deleted');
?>

<!DOCTYPE html>
<html lang="en" data-theme="forest">

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

  .bg-tertiary {
    background-color: #303030;
  }

  .bg-brand {
    background-color: #C4F120;
  }

  .content-body {
    color: #E2E2E2;
  }

  .content-muted {
    color: #5E5E5E;
  }

  .content-inverse {
    color: #111111;
  }

  .accent-brand {
    color: #C4F120;
  }

</style>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://unpkg.com/@phosphor-icons/web"></script>
  <link href="https://cdn.jsdelivr.net/npm/daisyui@4.12.14/dist/full.min.css" rel="stylesheet" type="text/css" />
  <script src="https://cdn.tailwindcss.com"></script>
  <title>Guard</title>
</head>

<body class="bg-[#111111] overflow-auto lg:overflow-hidden text-neutral-100 flex flex-col lg:flex-row justify-center h-full lg:max-h-[100vh]">
<?php if (!empty($message)) : ?>
    <p class="text-indigo-400 font-mono mb-2 text-center">
    <div class="toast toast-top toast-end" id="toastMessage">
      <div class="alert alert-success bg-brand">
        <span><?= htmlspecialchars($message) ?></span>
      </div>
    </div>
    </p>
  <?php endif; ?>
  <div class="flex flex-col md:flex-row md:gap-10 items-center justify-center gap-3 lg:flex-col lg:gap-0 lg:justify-between max-h-screen py-10 pl-10">
    <img src="/data/images/project/small_logo.svg" alt="Logo" class="z-10 w-8 h-8" />
    <ul class="menu flex flex-row lg:flex-col rounded-box overflow-auto gap-3">
      <li>
        <a href="/contacts" class="bg-tertiary w-10 h-10 flex items-center justify-center rounded-xl">
          <i class="ph ph-user accent-brand font-bold text-xl"></i>
        </a>
      </li>
      <li>
        <a class="bg-tertiary w-10 h-10 flex items-center justify-center rounded-xl">
          <i class="ph ph-gear font-bold text-xl"></i>
        </a>
      </li>
      <li>
        <a href="/logout" class="bg-tertiary w-10 h-10 flex items-center justify-center rounded-xl">
          <i class="ph ph-sign-out font-bold text-xl"></i>
        </a>
      </li>
    </ul>
    <div class="flex flex-col items-start gap-1">
      <span class="text-sm content-muted">Logged with:</span>
      <p class="text-sm content-body"><?= auth()->email ?></p>
    </div>
  </div>

  <div class="overflow-auto mx-auto w-full justify-center px-4 lg:px-16 h-screen flex flex-col lg:max-h-screen lg:overflow-hidden">

    <?php require base_path("views/{$view}.view.php"); ?>
  </div>
</body>

</html>

<script>
  window.onload = function() {
    const toastMessage = document.getElementById("toastMessage");

    if (toastMessage) {
      setTimeout(function() {
        toastMessage.style.transition = "opacity 0.5s ease-out";
        toastMessage.style.opacity = "0";

        setTimeout(function() {
          toastMessage.remove();
        }, 500);
      }, 3000);
    }
  }
</script>
