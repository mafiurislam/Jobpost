<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Job;
use Illuminate\Http\Request;

class JobApiController extends Controller
{
    /**
     * Get live list of active job posts with optional search & sector filtering.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        $sector = $request->input('sector', 'all');
        $location = $request->input('location');

        $query = Job::active();

        if ($search) {
            $query->search($search);
        }

        if ($sector && strtolower($sector) !== 'all') {
            $query->sector($sector);
        }

        if ($location) {
            $query->where('location', 'like', "%{$location}%");
        }

        $jobs = $query->orderBy('is_featured', 'desc')
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json([
            'status' => 'success',
            'count' => $jobs->count(),
            'data' => $jobs,
        ]);
    }

    /**
     * Get details of a single job post.
     */
    public function show($id)
    {
        $job = Job::find($id);

        if (! $job) {
            return response()->json([
                'status' => 'error',
                'message' => 'Job post not found.',
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'data' => $job,
        ]);
    }

    /**
     * Get sector categories with dynamic vacancy counts.
     */
    public function sectors()
    {
        $sectors = [
            ['id' => 1, 'slug' => 'all', 'title' => 'All New and Update Jobs Section', 'image' => 'assets/images/roles/all_new_jobs.svg', 'link' => 'jobs.html'],
            ['id' => 2, 'slug' => 'overseas', 'title' => 'ALL OVERSEAS JOBS', 'image' => 'assets/images/roles/overseas_jobs.svg', 'link' => 'singlejobs.html?sector=overseas'],
            ['id' => 3, 'slug' => 'naps', 'title' => 'ALL JOBS UNDER NAPS', 'image' => 'assets/images/roles/naps_jobs.svg', 'link' => 'singlejobs.html?sector=naps'],
            ['id' => 4, 'slug' => 'govt', 'title' => 'Govt. Contractual Jobs Section', 'image' => 'assets/images/roles/govt_contractual.svg', 'link' => 'singlejobs.html?sector=govt'],
            ['id' => 5, 'slug' => 'airlines', 'title' => 'AIRLINES SECTOR JOBS', 'image' => 'assets/images/roles/airlines_jobs.svg', 'link' => 'singlejobs.html?sector=airlines'],
            ['id' => 6, 'slug' => 'backoffice', 'title' => 'Back Office Sector', 'image' => 'assets/images/roles/backoffice_jobs.svg', 'link' => 'singlejobs.html?sector=backoffice'],
            ['id' => 7, 'slug' => 'medical', 'title' => 'Medical Sector', 'image' => 'assets/images/roles/medical_sector.svg', 'link' => 'singlejobs.html?sector=medical'],
            ['id' => 8, 'slug' => 'auto', 'title' => 'Automobile Sector', 'image' => 'assets/images/roles/automobile_jobs.svg', 'link' => 'singlejobs.html?sector=auto'],
            ['id' => 9, 'slug' => 'ac_coach', 'title' => 'Ac Coach Attender Jobs', 'image' => 'assets/images/roles/ac_coach_attender.svg', 'link' => 'singlejobs.html?sector=ac_coach'],
            ['id' => 10, 'slug' => 'driver', 'title' => 'Driver Jobs', 'image' => 'assets/images/roles/driver_jobs.svg', 'link' => 'singlejobs.html?sector=driver'],
            ['id' => 11, 'slug' => 'banking', 'title' => 'Banking Sector', 'image' => 'assets/images/roles/banking_sector.svg', 'link' => 'singlejobs.html?sector=banking'],
            ['id' => 12, 'slug' => 'security', 'title' => 'Security Guard', 'image' => 'assets/images/roles/security_guard.svg', 'link' => 'singlejobs.html?sector=security'],
            ['id' => 13, 'slug' => 'housekeeping', 'title' => 'Housekeeping Stuff', 'image' => 'assets/images/roles/housekeeping_stuff.svg', 'link' => 'singlejobs.html?sector=housekeeping'],
            ['id' => 14, 'slug' => 'labour', 'title' => 'Labour-Helper', 'image' => 'assets/images/roles/labour_helper.svg', 'link' => 'singlejobs.html?sector=labour'],
            ['id' => 15, 'slug' => 'warehouse', 'title' => 'Warehouse Executive', 'image' => 'assets/images/roles/warehouse_executive.svg', 'link' => 'singlejobs.html?sector=warehouse'],
            ['id' => 16, 'slug' => 'ac_mechanic', 'title' => 'Ac Mechanic', 'image' => 'assets/images/roles/ac_mechanic.svg', 'link' => 'singlejobs.html?sector=ac_mechanic'],
            ['id' => 17, 'slug' => 'hospitality', 'title' => 'Hospitality and Hotel Sector', 'image' => 'assets/images/roles/hospitality_hotel.svg', 'link' => 'singlejobs.html?sector=hospitality'],
            ['id' => 18, 'slug' => 'it_hardware', 'title' => 'IT sector-Hardware', 'image' => 'assets/images/roles/it_hardware.svg', 'link' => 'singlejobs.html?sector=it_hardware'],
            ['id' => 19, 'slug' => 'call_centre', 'title' => 'Call Centre', 'image' => 'assets/images/roles/call_centre.svg', 'link' => 'singlejobs.html?sector=call_centre'],
        ];

        foreach ($sectors as &$sec) {
            if ($sec['slug'] === 'all') {
                $sec['count'] = Job::active()->count();
            } else {
                $sec['count'] = Job::active()->where('sector_slug', $sec['slug'])->count();
            }
        }

        return response()->json([
            'status' => 'success',
            'data' => $sectors,
        ]);
    }
}
