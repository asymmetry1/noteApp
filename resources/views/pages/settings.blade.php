@extends('layouts.app')
@section('content')
<div class="max-w-lg mx-auto space-y-4">
  <h1 class="text-2xl font-semibold">Settings</h1>
  <div class="p-4 bg-white rounded shadow flex justify-between items-center">
    <span>Theme: {{ ucfirst($theme) }}</span>
    <form method="POST" action="{{ route('settings.toggle') }}">
      @csrf
      <button class="px-3 py-2 bg-gray-800 text-white rounded">Toggle</button>
    </form>
  </div>
</div>
@endsection
