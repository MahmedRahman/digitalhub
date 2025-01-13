<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Specialization;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SpecializationController extends Controller
{
    public function index(Request $request)
    {
        $query = Specialization::query()->latest();

        if ($request->has('search')) {
            $search = $request->get('search');
            $query->where('name', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
        }

        $specializations = $query->paginate(10);
        return view('admin.specializations.index', compact('specializations'));
    }

    public function create()
    {
        return view('admin.specializations.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:specializations',
            'description' => 'nullable|string',
            'icon' => 'nullable|string',
            'is_active' => 'required|boolean',
            'sort_order' => 'required|integer|min:0',
        ]);

        $validated['slug'] = Str::slug($validated['name']);

        Specialization::create($validated);

        return redirect()
            ->route('admin.specializations.index')
            ->with('success', 'تم إضافة التخصص بنجاح');
    }

    public function edit(Specialization $specialization)
    {
        return view('admin.specializations.edit', compact('specialization'));
    }

    public function update(Request $request, Specialization $specialization)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:specializations,name,' . $specialization->id,
            'description' => 'nullable|string',
            'icon' => 'nullable|string',
            'is_active' => 'required|boolean',
            'sort_order' => 'required|integer|min:0',
        ]);

        $validated['slug'] = Str::slug($validated['name']);

        $specialization->update($validated);

        return redirect()
            ->route('admin.specializations.index')
            ->with('success', 'تم تحديث التخصص بنجاح');
    }

    public function destroy(Specialization $specialization)
    {
        if ($specialization->instructors()->count() > 0) {
            return redirect()
                ->route('admin.specializations.index')
                ->with('error', 'لا يمكن حذف التخصص لأنه مرتبط بمدربين');
        }

        $specialization->delete();

        return redirect()
            ->route('admin.specializations.index')
            ->with('success', 'تم حذف التخصص بنجاح');
    }
}
