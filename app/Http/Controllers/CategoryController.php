<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the categories.
     */
    public function index()
    {
        $categories = Category::query()
            ->withCount('courses')
            ->when(request('search'), function($query, $search) {
                $query->where('name', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%");
            })
            ->when(request('sort'), function($query, $sort) {
                switch($sort) {
                    case 'name':
                        $query->orderBy('name');
                        break;
                    case 'courses':
                        $query->orderByDesc('courses_count');
                        break;
                    default:
                        $query->latest();
                }
            }, function($query) {
                $query->latest();
            })
            ->paginate(12)
            ->withQueryString();

        return view('categories.index', compact('categories'));
    }

    /**
     * Display the specified category.
     */
    public function show(Category $category)
    {
        $courses = $category->courses()
            ->with(['instructor' => function($query) {
                $query->select('id', 'user_id', 'name')
                    ->with(['user' => function($q) {
                        $q->select('id', 'profile_photo_path');
                    }]);
            }])
            ->withCount('users as students_count')
            ->latest()
            ->paginate(9);

        return view('categories.show', compact('category', 'courses'));
    }
}
