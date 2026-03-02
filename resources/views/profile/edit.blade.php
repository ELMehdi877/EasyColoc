@extends('layouts.app')

@section('page_title', 'Profile')

@section('content')

<div class="space-y-6">

    <div class="p-6 bg-white shadow rounded-xl">
        @include('profile.partials.update-profile-information-form')
    </div>

    <div class="p-6 bg-white shadow rounded-xl">
        @include('profile.partials.update-password-form')
    </div>

    <div class="p-6 bg-white shadow rounded-xl">
        @include('profile.partials.delete-user-form')
    </div>

</div>

@endsection