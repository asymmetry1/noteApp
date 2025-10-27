@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto space-y-8">
  <h1 class="text-3xl font-semibold mb-6 text-gray-800 dark:text-gray-100">Dashboard</h1>

  <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
    <!-- Total Notes -->
    <div class="p-6 bg-white dark:bg-gray-800 rounded-2xl shadow hover:shadow-lg transition">
      <div class="text-gray-500 dark:text-gray-400 text-sm">Total Notes</div>
      <div class="text-3xl font-bold text-gray-800 dark:text-gray-100 mt-1">{{ $totalNotes }}</div>
    </div>

    <!-- Pinned Notes -->
    <div class="p-6 bg-white dark:bg-gray-800 rounded-2xl shadow hover:shadow-lg transition">
      <div class="text-gray-500 dark:text-gray-400 text-sm">Pinned Notes</div>
      <div class="text-3xl font-bold text-gray-800 dark:text-gray-100 mt-1">{{ $pinnedNotes }}</div>
    </div>

    <!-- In Trash -->
    <div class="p-6 bg-white dark:bg-gray-800 rounded-2xl shadow hover:shadow-lg transition">
      <div class="text-gray-500 dark:text-gray-400 text-sm">In Trash</div>
      <div class="text-3xl font-bold text-gray-800 dark:text-gray-100 mt-1">{{ $deletedNotes }}</div>
    </div>
  </div>

  <!-- Optional: recent activity / chart placeholder -->
  <!-- <div class="mt-10 p-6 bg-white dark:bg-gray-800 rounded-2xl shadow">
    <h2 class="text-xl font-semibold mb-4 text-gray-800 dark:text-gray-100">Recent Activity</h2>
    <p class="text-gray-500 dark:text-gray-400 text-sm">Coming soon — track your notes and actions here.</p>
  </div>
</div> -->
@endsection
