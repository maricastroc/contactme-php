<?php

use function Core\flash;

$message = flash()->get('successfully_created') 
          ?: flash()->get('successfully_updated') 
          ?: flash()->get('successfully_deleted');
?>

<?php if (!empty($message)) : ?>
  <div class="flex space-x-4 w-full px-5">
    <div role="alert" class="alert mt-6 w-full" id="createdMessage">
      <svg
        xmlns="http://www.w3.org/2000/svg"
        fill="none"
        viewBox="0 0 24 24"
        class="stroke-info h-6 w-6 shrink-0">
        <path
          stroke-linecap="round"
          stroke-linejoin="round"
          stroke-width="2"
          d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
      </svg>
      <span> <?= htmlspecialchars($message) ?> </span>
    </div>
  </div>
<?php endif; ?>

<script>
    window.onload = function() {
        const message = document.getElementById('createdMessage');
        if (message) {
            setTimeout(function() {
                message.style.display = 'none';
            }, 3000);
        }
    };
</script>