<?php

use function Core\base_path;

$user = $_SESSION['auth'] ?? null;
?>

<!DOCTYPE html>
<html lang="en" data-theme="night">

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
</style>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://unpkg.com/@phosphor-icons/web"></script>
  <link href="https://cdn.jsdelivr.net/npm/daisyui@4.12.14/dist/full.min.css" rel="stylesheet" type="text/css" />
  <script src="https://cdn.tailwindcss.com"></script>
  <title>ContactMe</title>
</head>

<body class="bg-base-100 text-neutral-100">
<div class="mx-auto max-w-screen-lg h-screen flex flex-col lg:max-h-screen lg:overflow-hidden">

<?php require base_path('views/partials/_navbar.view.php'); ?>

<?php require base_path('views/partials/_search.view.php'); ?>

<?php require base_path('views/partials/_message.view.php'); ?>

  <div class="flex flex-grow py-6 px-5">
    <?php require base_path("views/{$view}.view.php"); ?>
  </div>
</div>
</body>

</html>
