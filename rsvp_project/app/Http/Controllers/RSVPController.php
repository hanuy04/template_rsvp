<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Guest;
use Illuminate\Support\Carbon;

class RSVPController extends Controller
{
    private function checkAdmin()
    {
        if (! session('is_admin')) {
            return redirect()->route('login')->send();
        }
    }

    // Tampilkan form RSVP publik
    public function showForm()
    {
        return view('rsvp.form');
    }

    // Proses penyimpanan data tamu
    public function submitForm(Request $request)
    {
        $request->validate([
            'name'    => 'required|string|max:255',
            'phone'   => 'nullable|string|max:20',
            // tambahkan field lain sesuai kebutuhan
        ]);

        Guest::create([
            'name'    => $request->name,
            'email'   => $request->email,
            'notelp'  => $request->phone,
            'created_at' => Carbon::now(),
            // ...
        ]);

        return view('rsvp.thankyou');
    }

    // Dashboard admin: statistik + list tamu
    public function dashboard()
    {
        $this->checkAdmin();

        $totalGuests = Guest::count();
        $guests      = Guest::orderBy('created_at', 'desc')->get();

        return view('admin.dashboard', compact('totalGuests', 'guests'));
    }

    // Export data tamu ke CSV
    public function exportCsv()
    {
        $this->checkAdmin();

        $guests = Guest::all();

        $filename = 'guests-' . date('Y-m-d') . '.csv';

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ];

        $callback = function () use ($guests) {
            $file = fopen('php://output', 'w');

            // Header CSV
            fputcsv($file, ['Nama', 'Email', 'Telepon']);

            // Data
            foreach ($guests as $guest) {
                fputcsv($file, [
                    $guest->name,
                    $guest->email ?? '',
                    $guest->notelp ?? ''
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
