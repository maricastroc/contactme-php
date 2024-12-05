<?php

use function Core\auth;
use function Core\session;

?>
<div class="navbar bg-base-100">
  <div class="flex-1">
    <a href="/contacts" class="btn btn-ghost text-xl">ContactMe.</a>
  </div>

  <div class="flex-none">
    <ul class="menu menu-horizontal px-1 flex">
      <li>
        <?php if (session()->get('show')): ?>
          <a href="hide" >
          <i class="ph ph-eye text-lg -mt-1"></i>
          </a>
          <?php else: ?>
            <a href="confirm">
            <i class="ph ph-eye-slash text-lg -mt-1"></i>
            </a>
            <?php endif; ?>
      </li>
      <li>
        <details>
          <summary><?= auth()->name ?></summary>
          <ul class="bg-base-100 rounded-t-none p-2">
            <li><a href="/logout">Logout</a></li>
          </ul>
        </details>
      </li>
    </ul>

  </div>
</div>
