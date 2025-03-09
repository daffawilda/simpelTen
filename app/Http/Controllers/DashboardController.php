<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Student;

class DashboardController extends Controller
{
    public function index()
    {
        // Ambil user yang sedang login
        $user = Auth::user();

        // Periksa apakah user memiliki relasi student sebelum mengambil datanya
        $student = $user->student ?? null;

        // Kirim data siswa ke view
        return view('dashboard', compact('student'));
    }
}
