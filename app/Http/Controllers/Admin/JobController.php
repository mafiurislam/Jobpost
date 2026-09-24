<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Job;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class JobController extends Controller
{
    /**
     * Display all job posts in Admin Dashboard.
     */
    public function index(Request $request)
    {
        $query = Job::query();

        if ($request->filled('search')) {
            $query->search($request->search);
        }

        $jobs = $query->orderBy('sort_order', 'asc')->orderBy('created_at', 'desc')->paginate(15);

        return view('admin.jobs.index', compact('jobs'));
    }

    /**
     * Render Add New Single Job form.
     */
    public function create()
    {
        return view('admin.jobs.create');
    }

    /**
     * Store newly created Single Job post.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'sector_name' => 'required|string|max:255',
            'company' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'salary' => 'required|string|max:255',
            'qualification' => 'required|string|max:255',
            'badge_tag' => 'nullable|string|max:255',
            'description' => 'required|string',
            'requirements' => 'nullable|string',
            'duties' => 'nullable|string',
            'benefits' => 'nullable|string',
            'contact_phone' => 'nullable|string|max:50',
            'contact_email' => 'nullable|email|max:100',
            'poster_image' => 'nullable|image|mimes:jpeg,jpg,png,webp,svg|max:4096',
            'is_active' => 'nullable|boolean',
            'is_featured' => 'nullable|boolean',
        ]);

        $job = new Job;
        $job->title = $validated['title'];
        $job->slug = Str::slug($validated['title']).'-'.Str::random(5);
        $job->sector_name = $validated['sector_name'];
        $job->sector_slug = Str::slug($validated['sector_name']);
        $job->company = $validated['company'];
        $job->location = $validated['location'];
        $job->salary = $validated['salary'];
        $job->qualification = $validated['qualification'];
        $job->badge_tag = $validated['badge_tag'] ?? '100% FREE PLACEMENT';
        $job->description = $validated['description'];
        $job->requirements = $validated['requirements'] ?? null;
        $job->duties = $validated['duties'] ?? null;
        $job->benefits = $validated['benefits'] ?? null;
        $job->contact_phone = $validated['contact_phone'] ?? '+91 7001420469';
        $job->contact_email = $validated['contact_email'] ?? 'brightfutureconsultancybwn@gmail.com';
        $job->is_active = $request->has('is_active');
        $job->is_featured = $request->has('is_featured');

        if ($request->hasFile('poster_image')) {
            $file = $request->file('poster_image');
            $filename = 'job_'.time().'_'.Str::random(6).'.'.$file->getClientOriginalExtension();
            $path = $file->storeAs('jobs', $filename, 'public');
            $job->poster_image = 'storage/'.$path;
        } else {
            $job->poster_image = 'assets/images/roles/overseas_jobs.svg';
        }

        $job->save();

        return redirect()->route('admin.jobs.index')->with('success', 'New Job Post created successfully! It is now live on the website.');
    }

    /**
     * Show single job details preview or edit.
     */
    public function show($id)
    {
        $job = Job::findOrFail($id);

        return redirect()->route('admin.jobs.edit', $job->id);
    }

    /**
     * Render Edit Job Post form.
     */
    public function edit($id)
    {
        $job = Job::findOrFail($id);

        return view('admin.jobs.edit', compact('job'));
    }

    /**
     * Update existing Job post.
     */
    public function update(Request $request, $id)
    {
        $job = Job::findOrFail($id);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'sector_name' => 'required|string|max:255',
            'company' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'salary' => 'required|string|max:255',
            'qualification' => 'required|string|max:255',
            'badge_tag' => 'nullable|string|max:255',
            'description' => 'required|string',
            'requirements' => 'nullable|string',
            'duties' => 'nullable|string',
            'benefits' => 'nullable|string',
            'contact_phone' => 'nullable|string|max:50',
            'contact_email' => 'nullable|email|max:100',
            'poster_image' => 'nullable|image|mimes:jpeg,jpg,png,webp,svg|max:4096',
            'is_active' => 'nullable|boolean',
            'is_featured' => 'nullable|boolean',
        ]);

        $job->title = $validated['title'];
        $job->sector_name = $validated['sector_name'];
        $job->sector_slug = Str::slug($validated['sector_name']);
        $job->company = $validated['company'];
        $job->location = $validated['location'];
        $job->salary = $validated['salary'];
        $job->qualification = $validated['qualification'];
        $job->badge_tag = $validated['badge_tag'] ?? '100% FREE PLACEMENT';
        $job->description = $validated['description'];
        $job->requirements = $validated['requirements'] ?? null;
        $job->duties = $validated['duties'] ?? null;
        $job->benefits = $validated['benefits'] ?? null;
        $job->contact_phone = $validated['contact_phone'] ?? '+91 7001420469';
        $job->contact_email = $validated['contact_email'] ?? 'brightfutureconsultancybwn@gmail.com';
        $job->is_active = $request->has('is_active');
        $job->is_featured = $request->has('is_featured');

        if ($request->hasFile('poster_image')) {
            $file = $request->file('poster_image');
            $filename = 'job_'.time().'_'.Str::random(6).'.'.$file->getClientOriginalExtension();
            $path = $file->storeAs('jobs', $filename, 'public');
            $job->poster_image = 'storage/'.$path;
        }

        $job->save();

        return redirect()->route('admin.jobs.index')->with('success', "Job post '{$job->title}' updated successfully!");
    }

    /**
     * Toggle Job Active status.
     */
    public function toggleStatus($id)
    {
        $job = Job::findOrFail($id);
        $job->is_active = ! $job->is_active;
        $job->save();

        $status = $job->is_active ? 'Activated' : 'Deactivated';

        return redirect()->back()->with('success', "Job status changed to {$status}.");
    }

    /**
     * Delete Job post.
     */
    public function destroy($id)
    {
        $job = Job::findOrFail($id);
        $title = $job->title;
        $job->delete();

        return redirect()->route('admin.jobs.index')->with('success', "Job post '{$title}' deleted successfully.");
    }
}
