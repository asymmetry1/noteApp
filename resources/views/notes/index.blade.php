@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto" x-data="noteDashboard()">
  <div class="flex items-center justify-between mb-6">
    <h1 class="text-2xl font-semibold">Notes</h1>
    <button @click="openEditor()" class="flex items-center gap-1 px-3 py-2 bg-blue-600 text-black rounded">
      <span class="text-lg font-bold">+</span>
      <span>Add Note</span>
    </button>
  </div>

  <!-- Popup Form -->
  <div x-show="showForm" class="fixed inset-0 bg-black/40 flex items-center justify-center z-50" x-cloak>
    <div class="bg-white w-full max-w-3xl p-6 rounded-lg shadow-xl overflow-y-auto max-h-[90vh]" @click.away="closeEditor()">
      <h2 class="text-xl font-semibold mb-3" x-text="editMode ? 'Edit Note' : 'New Note'"></h2>

      <form @submit.prevent="saveNote">
        <input
          x-model="title"
          placeholder="Title..."
          class="w-full px-3 py-2 mb-3 border rounded text-lg font-medium"
        />

        <textarea
          x-model="content"
          rows="12"
          placeholder="Write your thoughts..."
          class="w-full px-3 py-2 mb-3 border rounded resize-y font-mono text-base"
        ></textarea>

        <!-- Tag selection -->
        <div class="mb-3">
          <label class="block text-sm font-semibold mb-1">Tags</label>
          <div class="flex flex-wrap gap-2">
            @foreach($tags as $tag)
              <label class="inline-flex items-center space-x-1">
                <input type="checkbox" value="{{ $tag->id }}" x-model="selectedTags">
                <span>{{ $tag->name }}</span>
              </label>
            @endforeach
          </div>
        </div>

        <div class="flex justify-end gap-2">
          <button type="button" @click="closeEditor()" class="px-3 py-2 border rounded">Cancel</button>
          <button type="submit" class="px-3 py-2 bg-blue-600 text-black rounded">Save</button>
        </div>
      </form>
    </div>
  </div>

  <!-- Notes Grid -->
  <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6 mt-4">
    @foreach($notes as $note)
      <div class="bg-white rounded-lg p-4 shadow-sm hover:shadow-md transition flex flex-col justify-between">
        <div>
          <h3 class="text-lg font-medium">{{ $note->title }}</h3>
          <p class="text-sm text-gray-600 mt-1 whitespace-pre-line">{{ Str::limit($note->content, 160) }}</p>
          @if($note->tags->count())
            <div class="mt-2 flex flex-wrap gap-1">
              @foreach($note->tags as $tag)
                <span class="text-xs bg-gray-200 px-2 py-1 rounded">{{ $tag->name }}</span>
              @endforeach
            </div>
          @endif
        </div>

        <div class="flex items-center justify-between mt-4">
          <div class="flex gap-2">
            <button @click="editNote({{ $note->toJson() }})" class="px-2 py-1 border rounded text-xs">Edit</button>
            <form method="POST" action="{{ route('notes.pin', $note) }}">
              @csrf
              @method('PATCH')
              <input type="hidden" name="is_pinned" value="{{ $note->is_pinned ? 0 : 1 }}" />
              <button class="px-2 py-1 border rounded text-xs">{{ $note->is_pinned ? 'Unpin' : 'Pin' }}</button>
            </form>
            <form method="POST" action="{{ route('notes.destroy', $note) }}">
              @csrf
              @method('DELETE')
              <button class="px-2 py-1 border rounded text-xs text-red-500">Delete</button>
            </form>
          </div>
        </div>
      </div>
    @endforeach
  </div>
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

    openEditor() {
      this.resetForm();
      this.showForm = true;
    },

    closeEditor() {
      this.showForm = false;
      this.resetForm();
    },

    editNote(note) {
      this.editMode = true;
      this.noteId = note.id;
      this.title = note.title;
      this.content = note.content;
      this.selectedTags = note.tags?.map(t => t.id) || [];
      this.showForm = true;
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
            // It's good practice to accept JSON back too
            'Accept': 'application/json', 
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({
            title: this.title,
            content: this.content,
            tags: this.selectedTags
        })
     });

      if (res.ok) {
        // Successful response means the data was saved
        location.reload(); 
      } else {
          // Optional: Log the exact status for debugging
          console.error('Failed to save note. Status:', res.status); 
          alert('Failed to save note.');
      }
    }
  };
}
</script>
@endsection
