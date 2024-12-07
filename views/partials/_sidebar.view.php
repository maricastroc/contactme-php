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

.bg-tertiary {
  background-color: #303030;
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

.content-muted {
  color: #5E5E5E;
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
</style>

<div class="flex flex-col items-center justify-between max-h-screen py-8 pl-10">
  <img src="/data/images/project/small_logo.svg" alt="Logo" class="z-10 w-8 h-8" />
  <ul class="menu rounded-box overflow-auto gap-3">
    <li>
      <a href="/contacts"  class="accent-brand bg-tertiary w-10 h-10 flex items-center justify-center rounded-xl">
        <i class="ph ph-user font-bold text-xl"></i>
      </a>
    </li>
    <li>
      <a  class="bg-tertiary w-10 h-10 flex items-center justify-center rounded-xl">
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
      <p class="text-sm content-body">Francis88@hotmail.com</p>
  </div>