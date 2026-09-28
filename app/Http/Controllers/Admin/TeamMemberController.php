<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use App\Models\TeamMember;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class TeamMemberController extends Controller
{
    /**
     * Display a listing of team members and section settings.
     */
    public function index(Request $request)
    {
        $search = $request->query('search');

        $query = TeamMember::query()->orderBy('sort_order', 'asc')->orderBy('id', 'asc');

        if (! empty($search)) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('role', 'like', "%{$search}%")
                    ->orWhere('bio', 'like', "%{$search}%");
            });
        }

        $members = $query->paginate(15)->withQueryString();

        $sectionTagline = SiteSetting::get('team_section_tagline', 'LEADERSHIP & EXPERTISE');
        $sectionTitle = SiteSetting::get('team_section_title', 'Meet Our Leadership Team');
        $sectionSubtitle = SiteSetting::get('team_section_subtitle', 'Dedicated counselors and HR professionals helping you take the next big step in your career.');
        $sectionVisible = (bool) SiteSetting::get('team_section_visible', true);

        return view('admin.team.index', compact(
            'members',
            'search',
            'sectionTagline',
            'sectionTitle',
            'sectionSubtitle',
            'sectionVisible'
        ));
    }

    /**
     * Show form for creating a new team member.
     */
    public function create()
    {
        $maxOrder = TeamMember::max('sort_order') ?? 0;
        $nextSortOrder = $maxOrder + 1;

        return view('admin.team.create', compact('nextSortOrder'));
    }

    /**
     * Store a newly created team member in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'role' => 'required|string|max:255',
            'bio' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,jpg,png,webp,svg|max:4096',
            'sort_order' => 'nullable|integer',
            'is_active' => 'nullable|boolean',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = 'team_'.time().'_'.Str::random(6).'.'.$file->getClientOriginalExtension();
            $path = $file->storeAs('team', $filename, 'public');
            $imagePath = 'storage/'.$path;

            // Also mirror to public/uploads/team for hostinger compatibility
            $mirrorDir = public_path('uploads/team');
            if (! File::isDirectory($mirrorDir)) {
                File::makeDirectory($mirrorDir, 0755, true, true);
            }
            @copy(storage_path('app/public/'.$path), $mirrorDir.'/'.$filename);
        }

        $member = TeamMember::create([
            'name' => $validated['name'],
            'role' => $validated['role'],
            'bio' => $validated['bio'] ?? null,
            'image_path' => $imagePath,
            'sort_order' => $validated['sort_order'] ?? ((TeamMember::max('sort_order') ?? 0) + 1),
            'is_active' => $request->has('is_active'),
        ]);

        return redirect()->route('admin.team.index')
            ->with('success', "Team member '{$member->name}' added successfully!");
    }

    /**
     * Show form for editing an existing team member.
     */
    public function edit(TeamMember $teamMember)
    {
        return view('admin.team.edit', compact('teamMember'));
    }

    /**
     * Update specified team member in storage.
     */
    public function update(Request $request, TeamMember $teamMember)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'role' => 'required|string|max:255',
            'bio' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,jpg,png,webp,svg|max:4096',
            'remove_image' => 'nullable|boolean',
            'sort_order' => 'nullable|integer',
            'is_active' => 'nullable|boolean',
        ]);

        $teamMember->name = $validated['name'];
        $teamMember->role = $validated['role'];
        $teamMember->bio = $validated['bio'] ?? null;
        $teamMember->sort_order = $validated['sort_order'] ?? $teamMember->sort_order;
        $teamMember->is_active = $request->has('is_active');

        // Handle image removal if requested
        if ($request->boolean('remove_image')) {
            $this->cleanupImage($teamMember->image_path);
            $teamMember->image_path = null;
        }

        // Handle new image upload
        if ($request->hasFile('image')) {
            $this->cleanupImage($teamMember->image_path);

            $file = $request->file('image');
            $filename = 'team_'.time().'_'.Str::random(6).'.'.$file->getClientOriginalExtension();
            $path = $file->storeAs('team', $filename, 'public');
            $teamMember->image_path = 'storage/'.$path;

            // Mirror copy for server compatibility
            $mirrorDir = public_path('uploads/team');
            if (! File::isDirectory($mirrorDir)) {
                File::makeDirectory($mirrorDir, 0755, true, true);
            }
            @copy(storage_path('app/public/'.$path), $mirrorDir.'/'.$filename);
        }

        $teamMember->save();

        return redirect()->route('admin.team.index')
            ->with('success', "Team member '{$teamMember->name}' updated successfully!");
    }

    /**
     * Remove the specified team member from storage.
     */
    public function destroy(TeamMember $teamMember)
    {
        $name = $teamMember->name;
        $this->cleanupImage($teamMember->image_path);
        $teamMember->delete();

        return redirect()->route('admin.team.index')
            ->with('success', "Team member '{$name}' deleted successfully!");
    }

    /**
     * Toggle active status of a team member.
     */
    public function toggleStatus(TeamMember $teamMember)
    {
        $teamMember->is_active = ! $teamMember->is_active;
        $teamMember->save();

        $statusText = $teamMember->is_active ? 'activated' : 'deactivated';

        return redirect()->back()
            ->with('success', "Team member '{$teamMember->name}' is now {$statusText}.");
    }

    /**
     * Update section header settings (tagline, title, subtitle, visibility).
     */
    public function updateSection(Request $request)
    {
        $validated = $request->validate([
            'team_section_tagline' => 'nullable|string|max:255',
            'team_section_title' => 'required|string|max:255',
            'team_section_subtitle' => 'nullable|string',
            'team_section_visible' => 'nullable|boolean',
        ]);

        SiteSetting::set('team_section_tagline', $validated['team_section_tagline'] ?? 'LEADERSHIP & EXPERTISE', 'team');
        SiteSetting::set('team_section_title', $validated['team_section_title'], 'team');
        SiteSetting::set('team_section_subtitle', $validated['team_section_subtitle'] ?? '', 'team');
        SiteSetting::set('team_section_visible', $request->has('team_section_visible') ? '1' : '0', 'team');

        return redirect()->route('admin.team.index')
            ->with('success', 'Leadership section header and visibility settings updated successfully!');
    }

    /**
     * Delete an uploaded image file safely.
     */
    protected function cleanupImage(?string $path): void
    {
        if (empty($path)) {
            return;
        }

        // Do not delete default factory/seeder assets
        if (str_starts_with($path, 'assets/')) {
            return;
        }

        if (str_starts_with($path, 'storage/')) {
            $relativePath = str_replace('storage/', '', $path);
            $fullStoragePath = storage_path('app/public/'.$relativePath);
            if (File::exists($fullStoragePath)) {
                File::delete($fullStoragePath);
            }
        }

        $publicUploadPath = public_path($path);
        if (File::exists($publicUploadPath)) {
            File::delete($publicUploadPath);
        }
    }
}
