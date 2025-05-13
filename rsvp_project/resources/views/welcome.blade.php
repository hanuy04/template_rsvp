@extends('template.main')

@section('bg_src', asset('a-dreamy-pre-wedding-shoot-of-two-artists-on-mount-bromo-1.jpg'))

@section('content')
    <h1 class="wedding-title">The Wedding of Amelia & William</h1>
    <p class="wedding-subtitle">25 May 2025 | VASA Hotel</p>
    <a href="{{ route('rsvp.form') }}" class="btn btn-light btn-lg mt-4">
        Isi Data Diri
    </a>
@endsection
