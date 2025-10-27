@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto space-y-4">
  <h1 class="text-2xl font-semibold mb-4">Recent Activity</h1>

  @if($recent->isEmpty())
    <div class="p-6 text-center bg-white dark:bg-gray-800 text-gray-500 dark:text-gray-400 rounded-xl shadow">
      No recent activity yet.
    </div>
  @else
    <ul class="space-y-2">
      @foreach($recent as $note)
        <li class="p-4 bg-white dark:bg-gray-800 rounded-xl shadow flex justify-between items-center hover:bg-gray-50 dark:hover:bg-gray-700 transition">
          <div>
            <div class="font-semibold text-gray-800 dark:text-gray-100">{{ $note->title }}</div>
            <div class="text-gray-500 dark:text-gray-400 text-sm">
              Updated {{ $note->updated_at->diffForHumans() }}
            </div>
          </div>
        </li>
      @endforeach
    </ul>
  @endif
</div>
@endsection
