<div fixed-plugin>
  <a fixed-plugin-button class="fixed bottom-8 right-8 z-990 px-4 py-2 text-xl bg-white rounded-circle shadow-lg text-slate-700 cursor-pointer">
    <i class="fa fa-cog"></i>
  </a>

  <div fixed-plugin-card class="fixed top-0 right-[-360px] z-50 w-90 h-full px-2.5 bg-white/80 dark:bg-slate-850/80 backdrop-blur-2xl rounded-none transition-all duration-200 shadow-3xl">
    <div class="px-6 pt-4 pb-0 mb-0">
      <div class="flex justify-between items-center">
        <div>
          <h5 class="text-lg font-semibold dark:text-white">Argon Configurator</h5>
          <p class="text-sm dark:text-white dark:opacity-80">See our dashboard options.</p>
        </div>
        <button fixed-plugin-close-button class="text-slate-700 dark:text-white text-sm p-2">
          <i class="fa fa-close"></i>
        </button>
      </div>
    </div>

    <hr class="my-1 border-t border-slate-300 dark:border-white/20" />

    <div class="p-6 pt-0 overflow-auto">
      <!-- Sidebar Colors -->
      <div class="mb-4">
        <h6 class="text-sm font-semibold dark:text-white mb-2">Sidebar Colors</h6>
        <div class="flex space-x-2">
          @foreach(['blue', 'gray', 'cyan', 'emerald', 'orange', 'red'] as $color)
            <span data-color="{{ $color }}"
              onclick="sidebarColor(this)"
              class="h-6 w-6 rounded-full cursor-pointer border border-white transition hover:border-slate-700"
              ></span>
          @endforeach
        </div>
      </div>

      <!-- Sidenav Type -->
      <div class="mb-4">
        <h6 class="text-sm font-semibold dark:text-white mb-1">Sidenav Type</h6>
        <p class="text-xs text-slate-500 dark:text-white/80">Choose between 2 sidenav types.</p>
        <div class="flex space-x-2 mt-2">
          <button class="sidenav-btn bg-gradient-to-tl from-blue-500 to-violet-500 text-white" data-class="bg-transparent">White</button>
          <button class="sidenav-btn border border-blue-500 text-blue-500" data-class="bg-white">Dark</button>
        </div>
      </div>

      <!-- Navbar Fixed Toggle -->
      <div class="mb-4 flex justify-between items-center">
        <h6 class="text-sm font-semibold dark:text-white">Navbar Fixed</h6>
        <label class="inline-flex items-center cursor-pointer">
          <input type="checkbox" navbarFixed class="sr-only peer" />
          <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all"></div>
        </label>
      </div>

      <!-- Light / Dark Mode -->
      <div class="mb-4 flex justify-between items-center">
        <h6 class="text-sm font-semibold dark:text-white">Light / Dark</h6>
        <label class="inline-flex items-center cursor-pointer">
          <input type="checkbox" dark-toggle class="sr-only peer" />
          <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all"></div>
        </label>
      </div>
    </div>
  </div>
</div>
