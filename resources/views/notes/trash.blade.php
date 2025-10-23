@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto">
  <h1 class="text-2xl font-semibold mb-4">Trash</h1>

  @if($notes->isEmpty())
    <p class="text-gray-500">Trash is empty.</p>
  @else
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
      @foreach($notes as $note)
        <div class="bg-white rounded-lg p-4 shadow-sm hover:shadow-md transition">
          <h3 class="text-lg font-medium">{{ $note->title }}</h3>
          <p class="text-sm text-gray-600 mt-1 whitespace-pre-line">{{ Str::limit($note->content, 120) }}</p>

          <div class="mt-3 flex justify-between items-center">
            <form method="POST" action="{{ route('notes.restore', $note->id) }}">
              @csrf
              <button class="text-blue-500 text-sm">Restore</button>
            </form>

            <form method="POST" action="{{ route('notes.forceDelete', $note->id) }}">
              @csrf @method('DELETE')
              <button class="text-red-500 text-sm">Delete Permanently</button>
            </form>
          </div>
        </div>
      @endforeach
    </div>
  @endif
</div>
@endsection
