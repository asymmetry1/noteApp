@extends('layouts.app')

@section('content')
<div class="max-w-lg mx-auto space-y-4">
  <h1 class="text-2xl font-semibold">Settings</h1>

  <div class="p-4 bg-white dark:bg-gray-800 rounded-2xl shadow flex justify-between items-center">
    <div>
      <span class="block text-sm text-gray-500 dark:text-gray-400">Current Theme</span>
      <span class="text-lg font-medium text-gray-800 dark:text-gray-100">{{ ucfirst($theme) }}</span>
    </div>

    <form method="POST" action="{{ route('settings.toggle') }}">
      @csrf
      <button
        class="px-4 py-2 bg-gray-800 dark:bg-gray-200 text-white dark:text-gray-900 rounded-xl hover:opacity-90 transition"
      >
        Toggle
      </button>
    </form>
  </div>
</div>
@endsection
