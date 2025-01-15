<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LiveCourse;
use Illuminate\Http\Request;

class LiveCourseController extends Controller
{
    public function index()
    {
        $livecourses = LiveCourse::latest()->paginate(10);
        return view('admin.livecourses.index', compact('livecourses'));
    }

    public function create()
    {
        return view('admin.livecourses.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'objectives' => 'nullable|string',
            'video_url' => 'nullable|url',
            'material_url' => 'nullable|url',
            'powerpoint_url' => 'nullable|url',
        ]);

        LiveCourse::create($request->all());

        return redirect()->route('admin.livecourses.index')
            ->with('success', 'تم إضافة الدورة المباشرة بنجاح');
    }

    public function edit(LiveCourse $livecourse)
    {
        return view('admin.livecourses.edit', compact('livecourse'));
    }

    public function update(Request $request, LiveCourse $livecourse)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'objectives' => 'nullable|string',
            'video_url' => 'nullable|url',
            'material_url' => 'nullable|url',
            'powerpoint_url' => 'nullable|url',
        ]);

        $livecourse->update($request->all());

        return redirect()->route('admin.livecourses.index')
            ->with('success', 'تم تحديث الدورة المباشرة بنجاح');
    }

    public function destroy(LiveCourse $livecourse)
    {
        $livecourse->delete();

        return redirect()->route('admin.livecourses.index')
            ->with('success', 'تم حذف الدورة المباشرة بنجاح');
    }
}
