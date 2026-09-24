<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\HomeSectionController;
use App\Http\Controllers\Admin\JobController;
use App\Http\Controllers\Admin\LogoController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\FrontendController;
use App\Models\ContactInquiry;
use App\Models\Job;
use App\Models\JobApplication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes - Bright Future Consultancy & Admin Portal
|--------------------------------------------------------------------------
*/

// Public Frontend Dynamic Routes
Route::get('/', [FrontendController::class, 'index'])->name('home');
Route::get('/index.html', [FrontendController::class, 'index']);

// Dynamic Jobs Routes
Route::get('/jobs', [FrontendController::class, 'jobs'])->name('jobs.index');
Route::get('/jobs.html', [FrontendController::class, 'jobs']);

// Dynamic Single Job Page
Route::get('/jobs/{job}', [FrontendController::class, 'singleJob'])->name('jobs.show');
Route::get('/singlejobs.html', function (Request $request) {
    if ($request->filled('id')) {
        return app(FrontendController::class)->singleJob($request->id);
    }
    if ($request->filled('sector')) {
        $job = Job::active()->where('sector_slug', $request->sector)->first();
        if ($job) {
            return app(FrontendController::class)->singleJob($job->id);
        }
    }
    $firstJob = Job::active()->first();
    if ($firstJob) {
        return app(FrontendController::class)->singleJob($firstJob->id);
    }
    abort(404);
});

// Dynamic Auxiliary Pages
Route::get('/about', fn () => app(FrontendController::class)->page('about'))->name('about');
Route::get('/about.html', fn () => app(FrontendController::class)->page('about'));

Route::get('/contact', fn () => app(FrontendController::class)->page('contact'))->name('contact');
Route::get('/contact.html', fn () => app(FrontendController::class)->page('contact'));
Route::post('/contact', [FrontendController::class, 'submitContact'])->name('contact.submit');

Route::get('/service', fn () => app(FrontendController::class)->page('service'))->name('service');
Route::get('/service.html', fn () => app(FrontendController::class)->page('service'));
Route::get('/services', fn () => app(FrontendController::class)->page('service'));

Route::get('/companies', fn () => app(FrontendController::class)->page('companies'))->name('companies');
Route::get('/companies.html', fn () => app(FrontendController::class)->page('companies'));

Route::get('/categories', fn () => app(FrontendController::class)->page('categories'))->name('categories');
Route::get('/categories.html', fn () => app(FrontendController::class)->page('categories'));

Route::get('/certificate', fn () => app(FrontendController::class)->page('certificate'))->name('certificate');
Route::get('/certificate.html', fn () => app(FrontendController::class)->page('certificate'));

Route::get('/join', fn () => app(FrontendController::class)->page('join'))->name('join');
Route::get('/join.html', fn () => app(FrontendController::class)->page('join'));
Route::post('/join', [FrontendController::class, 'submitJoin'])->name('join.submit');

// Admin Authentication Routes
Route::get('/admin/login', [AuthController::class, 'showLogin'])->name('admin.login');
Route::post('/admin/login', [AuthController::class, 'login'])->name('admin.login.submit');
Route::post('/admin/logout', [AuthController::class, 'logout'])->name('admin.logout');

// Protected Admin Dashboard Routes
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', fn () => view('admin.dashboard'))->name('dashboard');
    Route::get('/dashboard', fn () => view('admin.dashboard'));

    // Logo Management
    Route::get('/logo', [LogoController::class, 'index'])->name('logo.index');
    Route::post('/logo', [LogoController::class, 'update'])->name('logo.update');

    // Home Page Sections Management
    Route::get('/home', [HomeSectionController::class, 'index'])->name('home.index');
    Route::get('/home/{key}/edit', [HomeSectionController::class, 'edit'])->name('home.edit');
    Route::put('/home/{key}', [HomeSectionController::class, 'update'])->name('home.update');

    // Jobs CRUD Management
    Route::get('/jobs', [JobController::class, 'index'])->name('jobs.index');
    Route::get('/jobs/create', [JobController::class, 'create'])->name('jobs.create');
    Route::post('/jobs', [JobController::class, 'store'])->name('jobs.store');
    Route::get('/jobs/{job}/edit', [JobController::class, 'edit'])->name('jobs.edit');
    Route::put('/jobs/{job}', [JobController::class, 'update'])->name('jobs.update');
    Route::post('/jobs/{job}/toggle-status', [JobController::class, 'toggleStatus'])->name('jobs.toggle-status');
    Route::delete('/jobs/{job}', [JobController::class, 'destroy'])->name('jobs.destroy');

    // Candidate Job Applications
    Route::get('/applications', fn () => view('admin.applications', [
        'applications' => JobApplication::latest()->paginate(15),
    ]))->name('applications.index');

    // Contact Inquiries
    Route::get('/inquiries', fn () => view('admin.inquiries', [
        'inquiries' => ContactInquiry::latest()->paginate(15),
    ]))->name('inquiries.index');

    // Website Settings
    Route::get('/settings', [SettingController::class, 'index'])->name('settings.index');
    Route::post('/settings', [SettingController::class, 'update'])->name('settings.update');
});
