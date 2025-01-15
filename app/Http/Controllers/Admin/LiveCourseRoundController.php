<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LiveCourseRound;
use App\Models\LiveCourse;
use App\Models\Instructor;
use Illuminate\Http\Request;

class LiveCourseRoundController extends Controller
{
    public function index()
    {
        $rounds = LiveCourseRound::with(['livecourse', 'instructor'])->latest()->paginate(10);
        return view('admin.live-course-rounds.index', compact('rounds'));
    }

    public function create()
    {
        $livecourses = LiveCourse::orderBy('name')->get(['id', 'name']);
        $instructors = Instructor::orderBy('name')->get(['id', 'name', 'specialization_id']);
        return view('admin.live-course-rounds.create', compact('livecourses', 'instructors'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'livecourse_id' => 'required|exists:livecourses,id',
            'instructor_id' => 'required|exists:instructors,id',
            'round_name' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'hours_count' => 'required|integer|min:1',
            'price' => 'required|numeric|min:0',
            'notes' => 'nullable|string',
            'status' => 'required|in:upcoming,ongoing,completed'
        ]);

        LiveCourseRound::create($request->all());

        return redirect()->route('admin.live-course-rounds.index')
            ->with('success', 'تم إضافة الجولة بنجاح');
    }

    public function edit(LiveCourseRound $livecoursesround)
    {
        $livecourses = LiveCourse::orderBy('name')->get(['id', 'name']);
        $instructors = Instructor::orderBy('name')->get(['id', 'name', 'specialization_id']);
        return view('admin.live-course-rounds.edit', compact('livecoursesround', 'livecourses', 'instructors'));
    }

    public function update(Request $request, LiveCourseRound $livecoursesround)
    {
        $request->validate([
            'livecourse_id' => 'required|exists:livecourses,id',
            'instructor_id' => 'required|exists:instructors,id',
            'round_name' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'hours_count' => 'required|integer|min:1',
            'price' => 'required|numeric|min:0',
            'notes' => 'nullable|string',
            'status' => 'required|in:upcoming,ongoing,completed'
        ]);

        $livecoursesround->update($request->all());

        return redirect()->route('admin.live-course-rounds.index')
            ->with('success', 'تم تحديث الجولة بنجاح');
    }

    public function destroy(LiveCourseRound $livecoursesround)
    {
        $livecoursesround->delete();

        return redirect()->route('admin.live-course-rounds.index')
            ->with('success', 'تم حذف الجولة بنجاح');
    }
}
