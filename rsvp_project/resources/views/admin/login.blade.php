@extends('template.main')

@section('bg_src', asset('download.jpg'))

@section('content')
    <div class="rsvp-container fade-in-up">
        <h2 class="wedding-subtitle mb-4 text-center text-black">Admin Login</h2>

        @if ($errors->any())
            <div class="alert alert-danger animate__animated animate__shakeX">
                <ul class="mb-0">
                    @foreach ($errors->all() as $e)
                        <li>{{ $e }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger animate__animated animate__shakeX">
                {{ session('error') }}
            </div>
        @endif

        <form action="{{ route('login.post') }}" method="POST" class="card card-rsvp p-4">
            @csrf

            <div class="mb-3">
                <label for="email" class="form-label">Username</label>
                <input type="text" name="email" id="email" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" name="password" id="password" class="form-control" required>
            </div>

            <div class="text-center mt-4">
                <button type="submit" class="btn btn-rsvp btn-lg">Login</button>
            </div>
        </form>
    </div>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', () => AOS.init({
            duration: 800,
            once: true
        }));
    </script>
@endsection
