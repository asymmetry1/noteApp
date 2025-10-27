@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto px-4">
  <h1 class="text-2xl font-semibold mb-6 text-gray-800 dark:text-gray-100">Trash</h1>

  @if($notes->isEmpty())
    <div class="p-6 bg-white dark:bg-gray-800 rounded-xl shadow text-center text-gray-500 dark:text-gray-400">
      Trash is empty.
    </div>
  @else
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
      @foreach($notes as $note)
        <div class="bg-white dark:bg-gray-800 rounded-xl p-4 shadow-sm hover:shadow-md transition-all duration-200">
          <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100 truncate">{{ $note->title }}</h3>
          <p class="text-sm text-gray-600 dark:text-gray-400 mt-2 whitespace-pre-line">
            {{ Str::limit($note->content, 120) }}
          </p>

          <div class="mt-4 flex justify-between items-center border-t border-gray-100 dark:border-gray-700 pt-3">
            <form method="POST" action="{{ route('notes.restore', $note->id) }}">
              @csrf
              <button
                class="text-blue-600 dark:text-blue-400 text-sm font-medium hover:underline focus:outline-none"
              >
                Restore
              </button>
            </form>

            <form method="POST" action="{{ route('notes.forceDelete', $note->id) }}">
              @csrf
              @method('DELETE')
              <button
                class="text-red-600 dark:text-red-400 text-sm font-medium hover:underline focus:outline-none"
              >
                Delete Permanently
              </button>
            </form>
          </div>
        </div>
      @endforeach
    </div>
  @endif
</div>
@endsection
