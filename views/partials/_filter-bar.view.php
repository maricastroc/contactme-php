<div class="p-1 lg:flex-col lg:overflow-x-hidden overflow-y-auto flex items-center rounded-xl text-sm font-bold max-h-[60vh]">
  <?php
  use function Core\request;

  $alphabet = range('A', 'Z');
  $selectedLetter = request()->get('letter', '');

  $allButtonClass = empty($selectedLetter) ? 'text-[#C4F120]' : 'text-gray-400';
  echo "
    <form action='/contacts' class='m-1'>
      <button type='submit' class='p-1 $allButtonClass hover:text-[#C4F120] rounded'>
        ALL
      </button>
    </form>
  ";

  foreach ($alphabet as $letter) {
    $isSelected = $letter === $selectedLetter ? 'text-[#C4F120]' : 'text-gray-400';

    echo "
      <form action='/contacts' class='m-1'>
        <input type='hidden' name='letter' value='$letter'>
        <button type='submit' class='p-1 $isSelected hover:text-[#C4F120] rounded'>
          $letter
        </button>
      </form>
    ";
  }
  ?>
</div>
