<?php

namespace Tests\Feature;

use App\Models\SiteSetting;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;
use Tests\TestCase;

class LogoManagementTest extends TestCase
{
    protected User $admin;

    protected function setUp(): void
    {
        parent::setUp();
        $this->artisan('migrate');
        $this->seed();

        $this->admin = User::first() ?? User::create([
            'name' => 'Admin User',
            'email' => 'admin@bfconsultancy.in',
            'password' => bcrypt('password123'),
        ]);
    }

    /**
     * Test admin can load the logo management interface.
     */
    public function test_admin_can_view_logo_management_page(): void
    {
        $response = $this->actingAs($this->admin)->get('/admin/logo');
        $response->assertStatus(200);
        $response->assertSee('Logo Upload');
        $response->assertSee('Current Active Website Logo');
    }

    /**
     * Test admin can successfully upload and activate a new logo.
     */
    public function test_admin_can_upload_and_update_logo(): void
    {
        $fakeImage = UploadedFile::fake()->image('custom_agency_logo.png', 300, 100);

        $response = $this->actingAs($this->admin)->post('/admin/logo', [
            'logo' => $fakeImage,
        ]);

        $response->assertRedirect(route('admin.logo.index'));
        $response->assertSessionHas('success');

        $activeLogo = SiteSetting::get('site_logo');
        $this->assertStringStartsWith('storage/logos/logo_', $activeLogo);
        $this->assertTrue(File::exists(storage_path('app/public/'.str_replace('storage/', '', $activeLogo))));

        // Clean up test file
        @unlink(storage_path('app/public/'.str_replace('storage/', '', $activeLogo)));
    }

    /**
     * Test admin can reset the logo back to default.
     */
    public function test_admin_can_reset_logo_to_default(): void
    {
        SiteSetting::set('site_logo', 'uploads/logos/temp_test.png', 'logo');

        $response = $this->actingAs($this->admin)->post('/admin/logo/reset');
        $response->assertRedirect(route('admin.logo.index'));
        $response->assertSessionHas('success');

        $this->assertEquals('assets/images/logo.png', SiteSetting::get('site_logo'));
    }
}
