<?php

namespace App\Http\Controllers;

use App\Models\ContactInquiry;
use App\Models\HomeSection;
use App\Models\Job;
use App\Models\JobApplication;
use App\Models\SiteSetting;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    /**
     * Display the dynamic Home Page.
     */
    public function index()
    {
        $sections = HomeSection::where('is_visible', true)
            ->orderBy('sort_order', 'asc')
            ->get()
            ->keyBy('section_key');

        $jobs = Job::active()->orderBy('sort_order', 'asc')->orderBy('created_at', 'desc')->get();
        $siteLogo = SiteSetting::get('site_logo', 'assets/images/logo.png');
        $siteName = SiteSetting::get('site_name', 'Bright Future Consultancy');
        $contactPhone = SiteSetting::get('contact_phone', '+91 7001420469');
        $contactEmail = SiteSetting::get('contact_email', 'brightfutureconsultancybwn@gmail.com');
        $whatsappNumber = SiteSetting::get('whatsapp_number', '7001420469');
        $siteAddress = SiteSetting::get('address', 'Golapbagh, Barddhaman, West Bengal, India');
        $footerAbout = SiteSetting::get('footer_about');

        return view('frontend.index', compact(
            'sections',
            'jobs',
            'siteLogo',
            'siteName',
            'contactPhone',
            'contactEmail',
            'whatsappNumber',
            'siteAddress',
            'footerAbout'
        ));
    }

    /**
     * Display the dynamic Jobs Listing page.
     */
    public function jobs(Request $request)
    {
        $query = Job::active();

        if ($request->filled('keyword')) {
            $query->search($request->keyword);
        }

        if ($request->filled('sector')) {
            $query->sector($request->sector);
        }

        if ($request->filled('location')) {
            $query->where('location', 'like', '%'.$request->location.'%');
        }

        $jobs = $query->orderBy('sort_order', 'asc')->orderBy('created_at', 'desc')->paginate(12);

        $siteLogo = SiteSetting::get('site_logo', 'assets/images/logo.png');
        $siteName = SiteSetting::get('site_name', 'Bright Future Consultancy');
        $contactPhone = SiteSetting::get('contact_phone', '+91 7001420469');
        $contactEmail = SiteSetting::get('contact_email', 'brightfutureconsultancybwn@gmail.com');
        $whatsappNumber = SiteSetting::get('whatsapp_number', '7001420469');

        return view('frontend.jobs', compact('jobs', 'siteLogo', 'siteName', 'contactPhone', 'contactEmail', 'whatsappNumber'));
    }

    /**
     * Display the dynamic Single Job Details Page.
     */
    public function singleJob($identifier)
    {
        // Find job by ID or by Slug
        $job = Job::where('id', $identifier)
            ->orWhere('slug', $identifier)
            ->firstOrFail();

        $relatedJobs = Job::active()
            ->where('id', '!=', $job->id)
            ->where('sector_slug', $job->sector_slug)
            ->take(3)
            ->get();

        if ($relatedJobs->isEmpty()) {
            $relatedJobs = Job::active()
                ->where('id', '!=', $job->id)
                ->take(3)
                ->get();
        }

        $siteLogo = SiteSetting::get('site_logo', 'assets/images/logo.png');
        $siteName = SiteSetting::get('site_name', 'Bright Future Consultancy');
        $contactPhone = SiteSetting::get('contact_phone', '+91 7001420469');
        $contactEmail = SiteSetting::get('contact_email', 'brightfutureconsultancybwn@gmail.com');
        $whatsappNumber = SiteSetting::get('whatsapp_number', '7001420469');

        return view('frontend.single-job', compact(
            'job',
            'relatedJobs',
            'siteLogo',
            'siteName',
            'contactPhone',
            'contactEmail',
            'whatsappNumber'
        ));
    }

    /**
     * Handle auxiliary static pages dynamically.
     */
    public function page($pageName)
    {
        $allowedPages = ['about', 'contact', 'service', 'companies', 'categories', 'certificate', 'join'];

        $cleanPage = str_replace('.html', '', strtolower($pageName));

        if (! in_array($cleanPage, $allowedPages)) {
            abort(404);
        }

        $siteLogo = SiteSetting::get('site_logo', 'assets/images/logo.png');
        $siteName = SiteSetting::get('site_name', 'Bright Future Consultancy');
        $contactPhone = SiteSetting::get('contact_phone', '+91 7001420469');
        $contactEmail = SiteSetting::get('contact_email', 'brightfutureconsultancybwn@gmail.com');
        $whatsappNumber = SiteSetting::get('whatsapp_number', '7001420469');
        $siteAddress = SiteSetting::get('address', 'Golapbagh, Barddhaman, West Bengal, India');
        $sections = HomeSection::all()->keyBy('section_key');
        $jobs = Job::active()->take(6)->get();

        if (view()->exists("frontend.pages.{$cleanPage}")) {
            return view("frontend.pages.{$cleanPage}", compact(
                'siteLogo', 'siteName', 'contactPhone', 'contactEmail', 'whatsappNumber', 'siteAddress', 'sections', 'jobs'
            ));
        }

        return view('frontend.index', compact(
            'sections', 'jobs', 'siteLogo', 'siteName', 'contactPhone', 'contactEmail', 'whatsappNumber', 'siteAddress'
        ));
    }

    /**
     * Handle Contact form submission.
     */
    public function submitContact(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:50',
            'subject' => 'nullable|string|max:255',
            'message' => 'required|string',
        ]);

        ContactInquiry::create($validated);

        return back()->with('success', 'Thank you for reaching out! Your message has been received. Our counselor will contact you shortly.');
    }

    /**
     * Handle Candidate Join/Application form submission.
     */
    public function submitJoin(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:50',
            'email' => 'required|email|max:255',
            'qualification' => 'nullable|string|max:255',
            'preferred_sector' => 'nullable|string|max:255',
            'preferred_location' => 'nullable|string|max:255',
            'experience' => 'nullable|string',
        ]);

        JobApplication::create($validated);

        return back()->with('success', 'Your application has been registered successfully! Our placement executive will review your profile and share suitable interview call letters.');
    }
}
