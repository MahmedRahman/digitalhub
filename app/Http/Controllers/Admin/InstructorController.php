<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Instructor;
use App\Models\Specialization;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class InstructorController extends Controller
{
    public function index()
    {
        $instructors = Instructor::with('specialization')->paginate(10);
        return view('admin.instructors.index', compact('instructors'));
    }

    public function create()
    {
        $specializations = Specialization::where('is_active', true)->get();
        $statusOptions = Instructor::getStatusOptions();
        return view('admin.instructors.create', compact('specializations', 'statusOptions'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:instructors,email',
            'phone' => 'nullable|string|max:20',
            'title' => 'required|string|max:255',
            'bio' => 'nullable|string',
            'experience' => 'nullable|string',
            'facebook' => 'nullable|url',
            'twitter' => 'nullable|url',
            'linkedin' => 'nullable|url',
            'website' => 'nullable|url',
            'status' => 'required|in:' . implode(',', array_keys(Instructor::getStatusOptions())),
            'specialization_id' => 'required|exists:specializations,id',
            'profile_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('profile_photo')) {
            $validated['profile_photo_path'] = $request->file('profile_photo')->store('instructors', 'public');
        }

        $instructor = Instructor::create($validated);

        return redirect()->route('admin.instructors.index')
            ->with('success', 'تم إضافة المدرب بنجاح');
    }

    public function edit(Instructor $instructor)
    {
        $instructor->loadCount('courses');
        $instructor->load(['courses' => function($query) {
            $query->select('id', 'title', 'status', 'instructor_id')
                  ->orderBy('created_at', 'desc');
        }]);
        $specializations = Specialization::where('is_active', true)->get();
        $statusOptions = Instructor::getStatusOptions();
        return view('admin.instructors.edit', compact('instructor', 'specializations', 'statusOptions'));
    }

    public function update(Request $request, Instructor $instructor)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:instructors,email,' . $instructor->id,
            'phone' => 'nullable|string|max:20',
            'title' => 'required|string|max:255',
            'bio' => 'nullable|string',
            'experience' => 'nullable|string',
            'facebook' => 'nullable|url',
            'twitter' => 'nullable|url',
            'linkedin' => 'nullable|url',
            'website' => 'nullable|url',
            'status' => 'required|in:' . implode(',', array_keys(Instructor::getStatusOptions())),
            'specialization_id' => 'required|exists:specializations,id',
            'profile_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('profile_photo')) {
            // Delete old photo if exists
            if ($instructor->profile_photo_path) {
                Storage::disk('public')->delete($instructor->profile_photo_path);
            }
            $validated['profile_photo_path'] = $request->file('profile_photo')->store('instructors', 'public');
        }

        $instructor->update($validated);

        return redirect()->route('admin.instructors.index')
            ->with('success', 'تم تحديث بيانات المدرب بنجاح');
    }

    public function destroy(Instructor $instructor)
    {
        if ($instructor->profile_photo_path) {
            Storage::disk('public')->delete($instructor->profile_photo_path);
        }
        
        $instructor->delete();

        return redirect()->route('admin.instructors.index')
            ->with('success', 'تم حذف المدرب بنجاح');
    }
}
