<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Lesson;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class LessonController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'course_id' => 'required|exists:courses,id',
                'title' => 'required|string|max:255',
                'description' => 'nullable|string',
                'content' => 'required|string',
                'video_url' => 'nullable|url',
                'video_duration' => 'nullable|integer|min:1',
                'order' => 'required|integer|min:1',
                'is_free' => 'boolean',
                'is_published' => 'boolean'
            ]);
            
            // Convert checkbox values
            $validated['is_free'] = $request->has('is_free');
            $validated['is_published'] = $request->has('is_published');
            
            // Generate slug from title
            $validated['slug'] = Str::slug($validated['title']);
            
            // Make sure slug is unique
            $baseSlug = $validated['slug'];
            $counter = 1;
            while (Lesson::where('slug', $validated['slug'])->exists()) {
                $validated['slug'] = $baseSlug . '-' . $counter;
                $counter++;
            }
            
            $lesson = Lesson::create($validated);

            return redirect()
                ->back()
                ->with('success', 'تم إضافة الدرس بنجاح');
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'حدث خطأ أثناء إضافة الدرس: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $lesson = Lesson::findOrFail($id);
            
            $validated = $request->validate([
                'course_id' => 'required|exists:courses,id',
                'title' => 'required|string|max:255',
                'description' => 'nullable|string',
                'content' => 'nullable|string',
                'video_url' => 'nullable|url',
                'video_duration' => 'nullable|integer|min:1',
                'order' => 'required|integer|min:1',
            ]);

            // Handle boolean fields
            $validated['is_free'] = $request->has('is_free');
            $validated['is_published'] = $request->has('is_published');

            // Generate slug from title if title changed
            if ($lesson->title !== $validated['title']) {
                $validated['slug'] = Str::slug($validated['title']);
                
                // Make sure slug is unique
                $baseSlug = $validated['slug'];
                $counter = 1;
                while (Lesson::where('slug', $validated['slug'])
                             ->where('id', '!=', $lesson->id)
                             ->exists()) {
                    $validated['slug'] = $baseSlug . '-' . $counter;
                    $counter++;
                }
            }

            $lesson->update($validated);

            return redirect()
                ->back()
                ->with('success', 'تم تحديث الدرس بنجاح');
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'حدث خطأ أثناء تحديث الدرس: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $lesson = Lesson::findOrFail($id);
            $lesson->delete();

            return redirect()
                ->back()
                ->with('success', 'تم حذف الدرس بنجاح');
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->with('error', 'حدث خطأ أثناء حذف الدرس: ' . $e->getMessage());
        }
    }

    protected function validateLesson(Request $request): array
    {
        return $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'video' => 'nullable|string|url',
            'order' => 'required|integer|min:1',
            'duration' => 'nullable|string|max:50',
            'course_id' => 'required|exists:courses,id',
            'status' => 'required|in:draft,published'
        ]);
    }
}
