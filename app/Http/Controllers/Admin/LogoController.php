<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class LogoController extends Controller
{
    /**
     * Show Logo Management interface.
     */
    public function index()
    {
        $currentLogo = SiteSetting::get('site_logo', 'assets/images/logo.png');
        $siteName = SiteSetting::get('site_name', 'Bright Future Consultancy');

        // Check if file physically exists
        $logoExists = false;
        if (! empty($currentLogo)) {
            $logoExists = file_exists(public_path($currentLogo)) || file_exists(storage_path('app/public/'.str_replace('storage/', '', $currentLogo)));
        }

        return view('admin.logo.index', compact('currentLogo', 'siteName', 'logoExists'));
    }

    /**
     * Update dynamic site logo.
     */
    public function update(Request $request)
    {
        $request->validate([
            'logo' => ['required', 'file', 'mimes:jpeg,jpg,png,svg,webp,gif,ico', 'max:8192'],
        ], [
            'logo.required' => 'Please select an image file to upload as the new logo.',
            'logo.mimes' => 'The logo must be a file of type: PNG, JPG, JPEG, SVG, WEBP, or GIF.',
            'logo.max' => 'The logo image may not be greater than 8 megabytes.',
        ]);

        if ($request->hasFile('logo')) {
            $file = $request->file('logo');
            $extension = strtolower($file->getClientOriginalExtension());
            $filename = 'logo_'.time().'_'.substr(md5(uniqid()), 0, 6).'.'.$extension;

            // Store using Laravel storage public disk (consistent with JobController & HomeSectionController)
            $storedPath = $file->storeAs('logos', $filename, 'public');

            // Mirror copy to public/assets/images/logo.png so legacy references and direct asset paths work
            $storedFullPath = storage_path('app/public/'.$storedPath);
            $legacyAssetPath = public_path('assets/images/logo.png');
            if (File::exists(dirname($legacyAssetPath)) && File::exists($storedFullPath)) {
                @copy($storedFullPath, $legacyAssetPath);
            }

            // Save public URL path into site settings: storage/logos/...
            $savedPath = 'storage/'.$storedPath;
            SiteSetting::set('site_logo', $savedPath, 'logo');

            return redirect()->route('admin.logo.index')->with('success', 'Website logo updated successfully! The new logo is now active throughout the entire website.');
        }

        return redirect()->back()->with('error', 'Please select a valid image file (PNG, JPG, JPEG, SVG, WEBP).');
    }

    /**
     * Reset site logo back to official default logo.
     */
    public function reset()
    {
        SiteSetting::set('site_logo', 'assets/images/logo.png', 'logo');

        return redirect()->route('admin.logo.index')->with('success', 'Website logo has been reset to the default official logo.');
    }
}
