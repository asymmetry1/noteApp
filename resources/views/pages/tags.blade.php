@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto space-y-6">
  <h1 class="text-2xl font-semibold">Tags</h1>

  {{-- Create Tag Form --}}
  <form method="POST" action="{{ route('tags.store') }}" class="flex gap-2">
    @csrf
    <input 
      name="name" 
      placeholder="New tag name..."
      required
      class="border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 px-3 py-2 rounded flex-1 focus:ring focus:ring-blue-400 focus:outline-none"
    />
    <button 
      class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded transition"
    >
      Add
    </button>
  </form>

  {{-- Tag List --}}
  @if($tags->count())
    <ul class="space-y-2">
      @foreach($tags as $tag)
        <li class="flex justify-between items-center bg-white dark:bg-gray-800 p-3 rounded-lg shadow-sm">
          <div class="flex items-center gap-2">
            <span class="font-medium text-gray-800 dark:text-gray-100">{{ $tag->name }}</span>
            <span class="text-sm text-gray-500 dark:text-gray-400">({{ $tag->notes_count }})</span>
          </div>

          <form method="POST" action="{{ route('tags.destroy', $tag) }}" onsubmit="return confirm('Delete this tag?')">
            @csrf
            @method('DELETE')
            <button class="text-red-500 hover:text-red-600 text-sm font-medium">Delete</button>
          </form>
        </li>
      @endforeach
    </ul>
  @else
    <div class="text-gray-500 dark:text-gray-400 text-center py-6">
      No tags found. Add your first tag above!
    </div>
  @endif
</div>
@endsection
