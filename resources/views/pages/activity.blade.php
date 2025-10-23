@extends('layouts.app')
@section('content')
<div class="max-w-3xl mx-auto">
  <h1 class="text-2xl font-semibold mb-4">Recent Activity</h1>
  <ul class="space-y-2">
    @foreach($recent as $note)
      <li class="bg-white p-3 rounded shadow-sm">
        <span class="font-semibold">{{ $note->title }}</span>
        <span class="text-gray-500 text-sm">updated {{ $note->updated_at->diffForHumans() }}</span>
      </li>
    @endforeach
  </ul>
</div>
@endsection
