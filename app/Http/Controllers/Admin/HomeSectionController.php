<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HomeSection;
use Illuminate\Http\Request;

class HomeSectionController extends Controller
{
    /**
     * Display all Home Page Sections with clear separators.
     */
    public function index()
    {
        $sections = HomeSection::orderBy('sort_order', 'asc')->get();

        return view('admin.home.index', compact('sections'));
    }

    /**
     * Edit form for a specific section.
     */
    public function edit($key)
    {
        $section = HomeSection::where('section_key', $key)->firstOrFail();

        return view('admin.home.edit', compact('section'));
    }

    /**
     * Update dynamic section content and images.
     */
    public function update(Request $request, $key)
    {
        $section = HomeSection::where('section_key', $key)->firstOrFail();

        $request->validate([
            'title' => 'nullable|string|max:255',
            'tagline' => 'nullable|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'button_text' => 'nullable|string|max:255',
            'button_url' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,jpg,png,webp,svg|max:4096',
            'extra_image' => 'nullable|image|mimes:jpeg,jpg,png,webp,svg|max:4096',
            'is_visible' => 'nullable|boolean',
        ]);

        $section->title = $request->input('title');
        $section->tagline = $request->input('tagline');
        $section->subtitle = $request->input('subtitle');
        $section->description = $request->input('description');
        $section->button_text = $request->input('button_text');
        $section->button_url = $request->input('button_url');
        $section->is_visible = $request->has('is_visible');

        // Handle Main Image upload
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = 'section_'.$key.'_'.time().'.'.$file->getClientOriginalExtension();
            $path = $file->storeAs('sections', $filename, 'public');
            $section->image_path = 'storage/'.$path;
        }

        // Handle Extra Image upload (e.g., CEO Photo)
        if ($request->hasFile('extra_image')) {
            $file = $request->file('extra_image');
            $filename = 'section_extra_'.$key.'_'.time().'.'.$file->getClientOriginalExtension();
            $path = $file->storeAs('sections', $filename, 'public');
            $section->extra_image_path = 'storage/'.$path;
        }

        // Handle custom JSON data based on section (e.g. CEO details or FAQ list or Placement stories)
        if ($request->has('content_json')) {
            $contentJson = $request->input('content_json');
            if (is_string($contentJson)) {
                $contentJson = json_decode($contentJson, true) ?? $contentJson;
            }
            $section->content_json = $contentJson;
        }

        // Specific handling for Our Story leadership card
        if ($key === 'our_story' && ($request->has('leader_name') || $request->has('leader_role'))) {
            $currentJson = $section->content_json ?? [];
            if ($request->filled('leader_name')) {
                $currentJson['leader_name'] = $request->input('leader_name');
            }
            if ($request->filled('leader_role')) {
                $currentJson['leader_role'] = $request->input('leader_role');
            }
            if ($request->filled('leader_bio')) {
                $currentJson['leader_bio'] = $request->input('leader_bio');
            }
            $section->content_json = $currentJson;
        }

        $section->save();

        return redirect()->route('admin.home.index')->with('success', "{$section->section_name} updated successfully! Live website refreshed.");
    }
}
