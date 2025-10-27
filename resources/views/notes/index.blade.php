@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto" x-data="noteDashboard()" x-cloak>
  <!-- Header -->
  <div class="flex items-center justify-between mb-6">
    <h1 class="text-3xl font-semibold text-gray-900 dark:text-gray-100">Notes</h1>
    
  <div class="flex flex-wrap items-center gap-2">
    <!-- Search -->
    <input 
      type="text" 
      placeholder="Search notes..."
      x-model="searchQuery"
      class="border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 px-3 py-2 rounded focus:ring focus:ring-blue-400 focus:outline-none"
    />

    <!-- Tag Filter -->
    <select 
      x-model="selectedTag"
      class="border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 px-3 py-2 rounded focus:ring focus:ring-blue-400 focus:outline-none"
    >
      <option value="">All Tags</option>
      @foreach($tags as $tag)
        <option value="{{ $tag->id }}">{{ $tag->name }}</option>
      @endforeach
    </select>

    <!-- Add Note -->
    <button 
      @click="openEditor()" 
      class="flex items-center gap-1 px-3 py-2 bg-blue-600 text-white rounded"
    >
      <span class="text-lg font-bold">+</span>
      <span>Add Note</span>
    </button>
  </div>
  </div>

  <!-- Modal Overlay -->
  <div
    x-show="showForm"
    class="fixed inset-0 flex items-center justify-center bg-black/40 backdrop-blur-sm z-50"
    x-transition.opacity
  >
    <!-- Modal Card -->
    <div
      class="bg-white dark:bg-gray-800 w-full max-w-3xl rounded-2xl shadow-2xl overflow-hidden"
      @click.away="closeEditor()"
      x-transition.scale
    >
      <div class="p-6 border-b dark:border-gray-700 flex items-center justify-between">
        <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-100" x-text="editMode ? 'Edit Note' : 'New Note'"></h2>
        <button @click="closeEditor()" class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-300">&times;</button>
      </div>

      <form @submit.prevent="saveNote" class="p-6 space-y-4">
        <input
          x-model="title"
          placeholder="Title..."
          class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg text-lg font-medium focus:ring-2 focus:ring-blue-500 outline-none dark:bg-gray-700 dark:text-gray-100"
        />

        <textarea
          x-model="content"
          rows="10"
          placeholder="Write your thoughts..."
          class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg font-mono text-base resize-y focus:ring-2 focus:ring-blue-500 outline-none dark:bg-gray-700 dark:text-gray-100"
        ></textarea>

        <!-- Tag selection -->
        <div>
          <label class="block text-sm font-semibold mb-2 text-gray-700 dark:text-gray-300">Tags</label>
          <div class="flex flex-wrap gap-2">
            @foreach($tags as $tag)
              <label class="inline-flex items-center px-2 py-1 border border-gray-300 dark:border-gray-600 rounded-lg text-sm text-gray-700 dark:text-gray-200 cursor-pointer hover:bg-gray-100 dark:hover:bg-gray-700 transition">
                <input type="checkbox" value="{{ $tag->id }}" x-model="selectedTags" class="mr-2 accent-blue-600">
                {{ $tag->name }}
              </label>
            @endforeach
          </div>
        </div>

        <div class="flex justify-end gap-3 pt-4 border-t dark:border-gray-700">
          <button
            type="button"
            @click="closeEditor()"
            class="px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 transition"
          >
            Cancel
          </button>
          <button
            type="submit"
            class="px-4 py-2 rounded-lg bg-blue-600 text-white hover:bg-blue-700 transition"
          >
            Save
          </button>
        </div>
      </form>
    </div>
  </div>

<!-- Notes Grid -->
<div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6 mt-6">
  @foreach($notes as $note)
    <div 
      class="bg-white dark:bg-gray-800 rounded-xl p-5 shadow hover:shadow-lg transition flex flex-col justify-between border border-gray-100 dark:border-gray-700"
      x-show="matchesFilter('{{ strtolower($note->title) }}', '{{ strtolower($note->content) }}', @json($note->tags->pluck('id')))"
    >
      <div>
        <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">{{ $note->title }}</h3>
        <p class="text-sm text-gray-600 dark:text-gray-300 mt-2 whitespace-pre-line">{{ Str::limit($note->content, 160) }}</p>

        @if($note->tags->count())
          <div class="mt-3 flex flex-wrap gap-1">
            @foreach($note->tags as $tag)
              <span class="text-xs bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-gray-100 px-2 py-1 rounded-md">{{ $tag->name }}</span>
            @endforeach
          </div>
        @endif
      </div>

      <div class="flex items-center justify-between mt-4">
        <div class="flex gap-2">
          <button
            @click="editNote({{ $note->toJson() }})"
            class="px-3 py-1 border border-gray-300 dark:border-gray-600 rounded-md text-xs text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700 transition"
          >
            Edit
          </button>

          <form method="POST" action="{{ route('notes.pin', $note) }}">
            @csrf
            @method('PATCH')
            <input type="hidden" name="is_pinned" value="{{ $note->is_pinned ? 0 : 1 }}" />
            <button class="px-3 py-1 border border-gray-300 dark:border-gray-600 rounded-md text-xs hover:bg-gray-100 dark:hover:bg-gray-700 transition">
              {{ $note->is_pinned ? 'Unpin' : 'Pin' }}
            </button>
          </form>

          <form method="POST" action="{{ route('notes.destroy', $note) }}">
            @csrf
            @method('DELETE')
            <button class="px-3 py-1 border border-red-300 text-red-500 dark:border-red-700 rounded-md text-xs hover:bg-red-50 dark:hover:bg-red-900/40 transition">
              Delete
            </button>
          </form>
        </div>
      </div>
    </div>
  @endforeach
</div>

<script>
function noteDashboard() {
  return {
    showForm: false,
    editMode: false,
    title: '',
    content: '',
    selectedTags: [],
    noteId: null,

    searchQuery: '',
    selectedTag: '',

    matchesFilter(title, content, tagIds) {
      const q = this.searchQuery.toLowerCase();
      const matchesSearch = !q || title.includes(q) || content.includes(q);
      const matchesTag = !this.selectedTag || tagIds.includes(parseInt(this.selectedTag));
      return matchesSearch && matchesTag;
    },

    openEditor() {
      this.resetForm();
      this.showForm = true;
      document.body.classList.add('overflow-hidden');
    },

    closeEditor() {
      this.showForm = false;
      this.resetForm();
      document.body.classList.remove('overflow-hidden');
    },

    editNote(note) {
      this.editMode = true;
      this.noteId = note.id;
      this.title = note.title;
      this.content = note.content;
      this.selectedTags = note.tags?.map(t => t.id) || [];
      this.showForm = true;
      document.body.classList.add('overflow-hidden');
    },

    resetForm() {
      this.editMode = false;
      this.noteId = null;
      this.title = '';
      this.content = '';
      this.selectedTags = [];
    },

    async saveNote() {
      const url = this.editMode
        ? `/notes/${this.noteId}`
        : `{{ route('notes.store') }}`;

      const method = this.editMode ? 'PATCH' : 'POST';

      const res = await fetch(url, {
        method,
        headers: {
          'Content-Type': 'application/json',
          'Accept': 'application/json',
          'X-CSRF-TOKEN': '{{ csrf_token() }}',
        },
        body: JSON.stringify({
          title: this.title,
          content: this.content,
          tags: this.selectedTags,
        }),
      });

      if (res.ok) {
        location.reload();
      } else {
        console.error('Failed to save note. Status:', res.status);
        alert('Failed to save note.');
      }
    },
  };
}
</script>
@endsection
