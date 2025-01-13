<?php

namespace App\Http\Controllers;

use App\Models\Instructor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class InstructorController extends Controller
{
    public function __construct()
    {
       
    }

  

    public function index(Request $request)
    {
        $query = Instructor::query();

        if ($request->filled('search')) {
            $searchTerm = $request->search;
            $query->where(function($q) use ($searchTerm) {
                $q->where('name', 'like', "%{$searchTerm}%")
                  ->orWhere('email', 'like', "%{$searchTerm}%")
                  ->orWhere('specialization', 'like', "%{$searchTerm}%");
            });
        }

        $instructors = $query->latest()->paginate(10);
        return view('instructors.index', compact('instructors'));
    }

    public function indexPublic()
    {
        $instructors = Instructor::withCount('courses')
                               ->with(['specializations'])
                               ->orderBy('courses_count', 'desc')
                               ->paginate(12);

        return view('instructors.index', compact('instructors'));
    }

    public function create()
    {
        return view('admin.instructors.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:instructors'],
            'phone' => ['nullable', 'string', 'max:20'],
            'specialization' => ['required', 'string', 'max:255'],
            'bio' => ['nullable', 'string'],
            'facebook' => ['nullable', 'url'],
            'twitter' => ['nullable', 'url'],
            'linkedin' => ['nullable', 'url'],
            'profile_image' => ['nullable', 'image', 'max:2048'],
            'status' => ['required', 'boolean'],
        ]);

        $social_media_links = array_filter([
            'facebook' => $request->facebook,
            'twitter' => $request->twitter,
            'linkedin' => $request->linkedin,
        ]);

        if ($request->hasFile('profile_image')) {
            $path = $request->file('profile_image')->store('instructors', 'public');
            $validated['profile_image'] = $path;
        }

        $validated['social_media_links'] = $social_media_links;

        Instructor::create($validated);

        return redirect()->route('instructors.index')
            ->with('success', 'تم إضافة المدرب بنجاح');
    }

    public function show(Instructor $instructor)
    {
        $instructor->load(['courses' => function ($query) {
            $query->where('status', 'published')
                  ->with('category')
                  ->latest();
        }]);

        return view('instructors.show', compact('instructor'));
    }

    public function edit(Instructor $instructor)
    {
        return view('admin.instructors.edit', compact('instructor'));
    }

    public function update(Request $request, Instructor $instructor)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:instructors,email,' . $instructor->id],
            'phone' => ['nullable', 'string', 'max:20'],
            'specialization' => ['required', 'string', 'max:255'],
            'bio' => ['nullable', 'string'],
            'facebook' => ['nullable', 'url'],
            'twitter' => ['nullable', 'url'],
            'linkedin' => ['nullable', 'url'],
            'profile_image' => ['nullable', 'image', 'max:2048'],
            'status' => ['required', 'boolean'],
        ]);

        $social_media_links = array_filter([
            'facebook' => $request->facebook,
            'twitter' => $request->twitter,
            'linkedin' => $request->linkedin,
        ]);

        if ($request->hasFile('profile_image')) {
            if ($instructor->profile_image) {
                Storage::disk('public')->delete($instructor->profile_image);
            }
            $path = $request->file('profile_image')->store('instructors', 'public');
            $validated['profile_image'] = $path;
        }

        $validated['social_media_links'] = $social_media_links;

        $instructor->update($validated);

        return redirect()->route('instructors.index')
            ->with('success', 'تم تحديث بيانات المدرب بنجاح');
    }

    public function destroy(Instructor $instructor)
    {
        if ($instructor->profile_image) {
            Storage::disk('public')->delete($instructor->profile_image);
        }
        
        $instructor->delete();
        return redirect()->route('instructors.index')
            ->with('success', 'تم حذف المدرب بنجاح');
    }
}
