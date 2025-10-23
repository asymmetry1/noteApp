@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto space-y-6">
  <h1 class="text-2xl font-semibold mb-4">Dashboard</h1>

  <div class="grid grid-cols-3 gap-6">
    <div class="p-4 bg-white rounded shadow">
      <div class="text-gray-500 text-sm">Total Notes</div>
      <div class="text-2xl font-bold">{{ $total }}</div>
    </div>
    <div class="p-4 bg-white rounded shadow">
      <div class="text-gray-500 text-sm">Pinned Notes</div>
      <div class="text-2xl font-bold">{{ $pinned }}</div>
    </div>
    <div class="p-4 bg-white rounded shadow">
      <div class="text-gray-500 text-sm">In Trash</div>
      <div class="text-2xl font-bold">{{ $trashed }}</div>
    </div>
  </div>
</div>
@endsection
