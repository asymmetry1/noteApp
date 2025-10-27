@extends('layouts.app')
@section('content')
<div class="max-w-3xl mx-auto">
  <h1 class="text-2xl font-semibold mb-4">Tags</h1>
  <form method="POST" action="{{ route('tags.store') }}" class="flex gap-2 mb-4">
    @csrf
    <input name="name" placeholder="New tag" class="border px-3 py-2 rounded flex-1" />
    <button class="bg-blue-600 text-black px-4 py-2 rounded">Add</button>
  </form>
  <ul class="space-y-2">
    @foreach($tags as $tag)
      <li class="flex justify-between bg-white p-3 rounded shadow-sm">
        <span>{{ $tag->name }} ({{ $tag->notes_count }})</span>
        <form method="POST" action="{{ route('tags.destroy',$tag) }}">
          @csrf @method('DELETE')
          <button class="text-red-500 text-sm">Delete</button>
        </form>
      </li>
    @endforeach
  </ul>
</div>
@endsection
