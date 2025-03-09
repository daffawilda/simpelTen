<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Registration;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RegistrationController extends Controller
{
    public function dashboard()
    {
        $user = Auth::user();
        $student = Student::where('user_id', $user->id)->first();
        $registrations = $student ? $student->registrations : collect();

        return view('dashboard', compact('student', 'registrations'));
    }

    public function index()
    {
        $courses = Course::with('requirements')->get();
        return view('courses.index', compact('courses'));
    }

    public function register(Course $course)
    {
        $user = Auth::user();
        $student = Student::where('user_id', $user->id)->first();

        // Check if student meets the requirements
        $meetsRequirements = true;
        foreach ($course->requirements as $requirement) {
            // Assume you have a method to get student's score for a subject
            $score = $this->getStudentScore($student, $requirement->subject);
            if ($score < $requirement->min_score) {
                $meetsRequirements = false;
                break;
            }
        }

        if ($meetsRequirements) {
            Registration::create([
                'student_id' => $student->id,
                'course_id' => $course->id,
                'status' => 'pending',
            ]);

            return redirect()->route('dashboard')->with('success', 'Pendaftaran berhasil diajukan.');
        } else {
            return redirect()->route('courses.index')->with('error', 'Anda tidak memenuhi persyaratan untuk mendaftar ke kelas ini.');
        }
    }

    public function registrations()
    {
        $registrations = Registration::with(['student', 'course'])->get();
        return view('registrations.index', compact('registrations'));
    }

    public function approve(Registration $registration)
    {
        $registration->update(['status' => 'accepted']);
        return redirect()->route('registrations.index')->with('success', 'Pendaftaran diterima.');
    }

    public function reject(Registration $registration)
    {
        $registration->update(['status' => 'rejected']);
        return redirect()->route('registrations.index')->with('success', 'Pendaftaran ditolak.');
    }

    private function getStudentScore($student, $subject)
    {
        // Implement logic to get student's score for a subject
        // This is just a placeholder
        return 80; // Example score
    }
}