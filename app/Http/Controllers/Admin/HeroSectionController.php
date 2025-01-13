<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HeroSection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HeroSectionController extends Controller
{
    public function index()
    {
        $heroSections = HeroSection::orderBy('sort_order')->get();
        return view('admin.hero-sections.index', compact('heroSections'));
    }

    public function create()
    {
        return view('admin.hero-sections.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'button_text' => 'required|string|max:50',
            'button_link' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'is_active' => 'boolean',
            'sort_order' => 'integer',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('hero-sections', 'public');
        }

        HeroSection::create($validated);

        return redirect()
            ->route('admin.hero-sections.index')
            ->with('success', 'تم إضافة البانر بنجاح');
    }

    public function edit(HeroSection $heroSection)
    {
        return view('admin.hero-sections.edit', compact('heroSection'));
    }

    public function update(Request $request, HeroSection $heroSection)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'button_text' => 'required|string|max:50',
            'button_link' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'is_active' => 'boolean',
            'sort_order' => 'integer',
        ]);

        if ($request->hasFile('image')) {
            // Delete old image
            if ($heroSection->image) {
                Storage::disk('public')->delete($heroSection->image);
            }
            $validated['image'] = $request->file('image')->store('hero-sections', 'public');
        }

        $heroSection->update($validated);

        return redirect()
            ->route('admin.hero-sections.index')
            ->with('success', 'تم تحديث البانر بنجاح');
    }

    public function destroy(HeroSection $heroSection)
    {
        if ($heroSection->image) {
            Storage::disk('public')->delete($heroSection->image);
        }
        
        $heroSection->delete();

        return redirect()
            ->route('admin.hero-sections.index')
            ->with('success', 'تم حذف البانر بنجاح');
    }
}
