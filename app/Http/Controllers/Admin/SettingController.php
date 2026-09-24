<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index()
    {
        $settings = [
            'site_name' => SiteSetting::get('site_name', 'Bright Future Consultancy'),
            'site_tagline' => SiteSetting::get('site_tagline', 'HR & Educational Consulting Agency'),
            'contact_phone' => SiteSetting::get('contact_phone', '+91 7001420469'),
            'contact_email' => SiteSetting::get('contact_email', 'brightfutureconsultancybwn@gmail.com'),
            'whatsapp_number' => SiteSetting::get('whatsapp_number', '7001420469'),
            'address' => SiteSetting::get('address', 'Barrackpore, Kolkata-700121, West Bengal, India'),
            'footer_about' => SiteSetting::get('footer_about', ''),
        ];

        return view('admin.settings.index', compact('settings'));
    }

    public function update(Request $request)
    {
        $fields = ['site_name', 'site_tagline', 'contact_phone', 'contact_email', 'whatsapp_number', 'address', 'footer_about'];

        foreach ($fields as $field) {
            if ($request->has($field)) {
                SiteSetting::set($field, $request->input($field), 'general');
            }
        }

        return redirect()->back()->with('success', 'Website settings updated successfully!');
    }
}
