<?php

namespace Tests\Feature;

use App\Models\Job;
use App\Models\User;
use Tests\TestCase;

class WebsiteFeatureTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        $this->artisan('migrate');
        $this->seed();
    }

    /**
     * Test public homepage loads successfully.
     */
    public function test_homepage_loads_successfully(): void
    {
        $response = $this->get('/');
        $response->assertStatus(200);
        $response->assertSee('Bright Future Consultancy');
    }

    /**
     * Test jobs listing and filter.
     */
    public function test_jobs_page_loads_and_filters(): void
    {
        $response = $this->get('/jobs');
        $response->assertStatus(200);
        $response->assertSee('ALL JOBS');

        $filteredResponse = $this->get('/jobs?sector=overseas');
        $filteredResponse->assertStatus(200);
    }

    /**
     * Test single job page.
     */
    public function test_single_job_page_loads(): void
    {
        $firstJob = Job::first();
        if ($firstJob) {
            $response = $this->get('/jobs/'.$firstJob->id);
            $response->assertStatus(200);
            $response->assertSee($firstJob->title);
        }
    }

    /**
     * Test auxiliary pages.
     */
    public function test_auxiliary_pages_load(): void
    {
        $pages = ['about.html', 'contact.html', 'service.html', 'companies.html', 'categories.html', 'certificate.html', 'join.html'];
        foreach ($pages as $page) {
            $res = $this->get('/'.$page);
            $res->assertStatus(200);
        }
    }

    /**
     * Test contact inquiry submission.
     */
    public function test_contact_inquiry_submission(): void
    {
        $data = [
            'name' => 'Sourav Mukherjee',
            'email' => 'sourav@example.com',
            'phone' => '9832100000',
            'subject' => 'Job Placement Inquiry',
            'message' => 'Seeking immediate placement in Kolkata back office.',
        ];

        $response = $this->post('/contact', $data);
        $response->assertSessionHas('success');

        $this->assertDatabaseHas('contact_inquiries', [
            'email' => 'sourav@example.com',
            'phone' => '9832100000',
        ]);
    }

    /**
     * Test candidate application form submission.
     */
    public function test_candidate_application_submission(): void
    {
        $data = [
            'name' => 'Ananya Sen',
            'phone' => '9123456789',
            'email' => 'ananya@example.com',
            'qualification' => 'Graduate',
            'preferred_sector' => 'Banking & Finance',
            'preferred_location' => 'Barddhaman',
            'experience' => '1 year customer service',
        ];

        $response = $this->post('/join', $data);
        $response->assertSessionHas('success');

        $this->assertDatabaseHas('job_applications', [
            'email' => 'ananya@example.com',
            'phone' => '9123456789',
        ]);
    }

    /**
     * Test admin authentication and dashboard access.
     */
    public function test_admin_login_and_dashboard_access(): void
    {
        $user = User::where('email', 'admin@bfconsultancy.in')->first();
        if (! $user) {
            $user = User::create([
                'name' => 'Admin',
                'email' => 'admin@bfconsultancy.in',
                'password' => bcrypt('password123'),
            ]);
        }

        $loginResponse = $this->post('/admin/login', [
            'email' => 'admin@bfconsultancy.in',
            'password' => 'password123',
        ]);

        $loginResponse->assertRedirect('/admin');

        $dashResponse = $this->actingAs($user)->get('/admin');
        $dashResponse->assertStatus(200);
        $dashResponse->assertSee('Dashboard Overview');

        $inqResponse = $this->actingAs($user)->get('/admin/inquiries');
        $inqResponse->assertStatus(200);

        $appResponse = $this->actingAs($user)->get('/admin/applications');
        $appResponse->assertStatus(200);
    }

    /**
     * Test API endpoints.
     */
    public function test_public_api_endpoints(): void
    {
        $response = $this->getJson('/api/jobs');
        $response->assertStatus(200);
        $response->assertJsonStructure(['status', 'count', 'data']);

        $sectorsRes = $this->getJson('/api/sectors');
        $sectorsRes->assertStatus(200);
        $sectorsRes->assertJsonStructure(['status', 'data']);
    }
}
