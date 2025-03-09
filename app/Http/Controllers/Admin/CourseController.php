<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course;

class CourseController extends Controller
{
    // Menampilkan form tambah course
    public function create()
    {
        return view('admin.courses.create');
    }

    // Menyimpan data course
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        // Simpan data ke database
        Course::create([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        // Redirect dengan pesan sukses
        return redirect()->route('admin.courses.create')->with('success', 'Course berhasil ditambahkan!');
    }
}
