@php
  $theme = session('theme', 'light');
@endphp

<!doctype html>
<html lang="en" class="{{ $theme === 'dark' ? 'dark' : '' }}">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Notes App</title>
    @vite(['resources/css/app.css','resources/js/app.js'])
  </head>

  <body class="bg-gray-100 dark:bg-gray-900 text-gray-900 dark:text-gray-100 h-screen overflow-hidden">
    <div class="flex h-full">
      
      <!-- Sidebar (fixed, full height) -->
      <aside class="w-64 bg-gray-900 text-white fixed inset-y-0 flex flex-col">
        <div class="p-4 text-xl font-bold border-b border-gray-700 text-white">
          NotesApp
        </div>

        <nav class="flex-1 p-4 space-y-2 overflow-y-auto">
          <!-- Core -->
          <h2 class="text-gray-400 uppercase text-xs font-semibold mt-4 mb-2">Core</h2>
          <a href="{{ route('dashboard') }}" class="block px-3 py-2 rounded hover:bg-gray-800">Dashboard</a>
          <a href="{{ route('notes.index') }}" class="block px-3 py-2 rounded hover:bg-gray-800">Notes</a>
          <a href="{{ route('tags.index') }}" class="block px-3 py-2 rounded hover:bg-gray-800">Tags / Categories</a>
          <a href="{{ route('notes.trash') }}" class="block px-3 py-2 rounded hover:bg-gray-800">Trash</a>

          <!-- Utility -->
          <h2 class="text-gray-400 uppercase text-xs font-semibold mt-4 mb-2">Utility</h2>
          <a href="{{ route('settings') }}" class="block px-3 py-2 rounded hover:bg-gray-800">Settings</a>
          <a href="{{ route('profile.edit') }}" class="block px-3 py-2 rounded hover:bg-gray-800">Account</a>
          <a href="{{ route('activity') }}" class="block px-3 py-2 rounded hover:bg-gray-800">Activity Log</a>
          <a href="{{ route('backup') }}" class="block px-3 py-2 rounded hover:bg-gray-800">Backup / Export</a>
        </nav>

        <div class="p-4 border-t border-gray-700">
          <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="w-full text-left px-3 py-2 rounded hover:bg-gray-800">
              Logout
            </button>
          </form>
        </div>
      </aside>

      <!-- Content Area (scrollable) -->
      <main class="flex-1 ml-64 overflow-y-auto p-6">
        @yield('content')
      </main>
    </div>
  </body>
</html>
