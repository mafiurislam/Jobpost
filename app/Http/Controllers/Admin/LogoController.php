<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use Illuminate\Http\Request;

class LogoController extends Controller
{
    /**
     * Show Logo Management interface.
     */
    public function index()
    {
        $currentLogo = SiteSetting::get('site_logo', 'assets/images/logo.png');
        $siteName = SiteSetting::get('site_name', 'Bright Future Consultancy');

        return view('admin.logo.index', compact('currentLogo', 'siteName'));
    }

    /**
     * Update dynamic site logo.
     */
    public function update(Request $request)
    {
        $request->validate([
            'logo' => 'required|image|mimes:jpeg,jpg,png|max:4096',
        ]);

        if ($request->hasFile('logo')) {
            $file = $request->file('logo');
            $filename = 'logo_'.time().'.'.$file->getClientOriginalExtension();
            $path = $file->storeAs('logos', $filename, 'public');

            SiteSetting::set('site_logo', 'storage/'.$path, 'logo');

            return redirect()->back()->with('success', 'Website logo updated successfully! The new logo is now active across the website.');
        }

        return redirect()->back()->with('error', 'Please select a valid JPG, JPEG, or PNG image file.');
    }
}
