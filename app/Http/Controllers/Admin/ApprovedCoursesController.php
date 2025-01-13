<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Enrollment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ApprovedCoursesController extends Controller
{
    public function index(Request $request)
    {
        $query = Course::where('status', 'published')
            ->withCount(['enrollments as total_enrollments' => function($query) {
                $query->where('status', 'approved');
            }])
            ->withCount(['enrollments as completed_count' => function($query) {
                $query->where('status', 'approved')
                      ->whereNotNull('completed_at');
            }])
            ->withSum(['enrollments as total_revenue' => function($query) {
                $query->where('status', 'approved');
            }], 'courses.price')
            ->with(['instructor', 'category']);

        // Handle sorting
        switch ($request->get('sort')) {
            case 'revenue':
                $query->orderByDesc('total_revenue');
                break;
            case 'enrollments':
                $query->orderByDesc('total_enrollments');
                break;
            case 'title':
                $query->orderBy('title');
                break;
            case 'date':
                $query->orderByDesc('created_at');
                break;
            default:
                $query->orderByDesc('total_revenue');
                break;
        }

        $approvedCourses = $query->get();

        $totalRevenue = $approvedCourses->sum('total_revenue');
        $totalEnrollments = $approvedCourses->sum('total_enrollments');

        return view('admin.approved-courses.index', compact('approvedCourses', 'totalRevenue', 'totalEnrollments'));
    }
}
