@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto">
  <h1 class="text-2xl font-semibold mb-4">Account Settings</h1>

  @include('profile.partials.update-profile-information-form')
  @include('profile.partials.update-password-form')
  @include('profile.partials.delete-user-form')
</div>
@endsection
