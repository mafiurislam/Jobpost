<?php

namespace App\Providers;

use App\Models\SiteSetting;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrapFive();

        // Share dynamic site branding and contact information across all views
        View::composer('*', function ($view) {
            try {
                if (Schema::hasTable('site_settings')) {
                    $rawLogo = SiteSetting::get('site_logo', 'assets/images/logo.png');

                    // Verify logo file exists or fallback to default
                    $siteLogo = 'assets/images/logo.png';
                    if (! empty($rawLogo)) {
                        if (str_starts_with($rawLogo, 'http://') || str_starts_with($rawLogo, 'https://')) {
                            $siteLogo = $rawLogo;
                        } elseif (file_exists(public_path($rawLogo))) {
                            $siteLogo = $rawLogo;
                        } elseif (file_exists(storage_path('app/public/'.str_replace('storage/', '', $rawLogo)))) {
                            $siteLogo = $rawLogo;
                        }
                    }

                    $view->with([
                        'siteLogo' => $siteLogo,
                        'siteName' => SiteSetting::get('site_name', 'Bright Future Consultancy'),
                        'siteTagline' => SiteSetting::get('site_tagline', 'HR & Educational Consulting'),
                        'contactPhone' => SiteSetting::get('contact_phone', '+91 7001420469'),
                        'contactEmail' => SiteSetting::get('contact_email', 'brightfutureconsultancybwn@gmail.com'),
                        'whatsappNumber' => SiteSetting::get('whatsapp_number', '7001420469'),
                        'siteAddress' => SiteSetting::get('address', 'Golapbagh, Barddhaman, West Bengal, India'),
                        'footerAbout' => SiteSetting::get('footer_about', 'Bright Future Consultancy is a premier HR and educational consulting agency in West Bengal, providing 100% genuine job updates and career guidance.'),
                    ]);
                }
            } catch (\Throwable $e) {
                // Silently fallback if database is not yet ready or migrating
            }
        });
    }
}
