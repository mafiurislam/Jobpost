<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JobApplication;
use Illuminate\Http\Request;

class ApplicationController extends Controller
{
    /**
     * Display all candidate job applications and registrations.
     */
    public function index(Request $request)
    {
        $search = $request->query('search');
        $status = $request->query('status');

        $query = JobApplication::query()->orderBy('created_at', 'desc');

        if (! empty($search)) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('phone', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('preferred_sector', 'like', "%{$search}%")
                    ->orWhere('preferred_location', 'like', "%{$search}%")
                    ->orWhere('job_title', 'like', "%{$search}%");
            });
        }

        if (! empty($status)) {
            $query->where('status', $status);
        }

        $applications = $query->paginate(15)->withQueryString();

        return view('admin.applications', compact('applications', 'search', 'status'));
    }

    /**
     * Update the candidate application review status.
     */
    public function updateStatus(Request $request, JobApplication $application)
    {
        $request->validate([
            'status' => 'required|string|in:pending,contacted,shortlisted,rejected',
        ]);

        $application->status = $request->input('status');
        $application->save();

        return redirect()->back()->with('success', "Application status for '{$application->name}' updated to ".ucfirst($application->status).'.');
    }

    /**
     * Remove the specified application from the database.
     */
    public function destroy(JobApplication $application)
    {
        $name = $application->name;
        $application->delete();

        return redirect()->back()->with('success', "Registration for candidate '{$name}' has been deleted.");
    }
}
