@extends('template.main')

@section('bg_src', asset('images/admin_bg.jpg'))

@section('content')
    <div class="container text-white">
        <h2 class="mb-4">Admin Dashboard</h2>
        <div class="d-flex justify-content-end mb-4">
            <a href="{{ route('admin.export.csv') }}" class="btn btn-success me-2">Export to CSV</a>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn btn-danger">Logout</button>
            </form>
        </div>

        <div class="row mb-4">
            <div class="col-md-4">
                <div class="card text-dark">
                    <div class="card-body">
                        <h5>Total Guests</h5>
                        <p>{{ $totalGuests }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="card text-dark">
            <div class="card-body">
                <h5>Daftar Tamu</h5>
                <table class="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Telepon</th>
                            <th>Waktu Submit</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($guests as $idx => $guest)
                            <tr>
                                <td>{{ $idx + 1 }}</td>
                                <td>{{ $guest->name }}</td>
                                <td>{{ $guest->email ?? '-' }}</td>
                                <td>{{ $guest->notelp ?? '-' }}</td>
                                <td>{{ $guest->created_at->format('d M Y H:i') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
