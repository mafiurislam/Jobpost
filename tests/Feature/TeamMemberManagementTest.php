<?php

namespace Tests\Feature;

use App\Models\SiteSetting;
use App\Models\TeamMember;
use App\Models\User;
use Database\Seeders\TeamMemberSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class TeamMemberManagementTest extends TestCase
{
    use RefreshDatabase;

    protected User $admin;

    protected function setUp(): void
    {
        parent::setUp();

        $this->admin = User::factory()->create([
            'email' => 'admin@bfconsultancy.in',
            'password' => bcrypt('password123'),
        ]);

        $this->seed(TeamMemberSeeder::class);
    }

    /**
     * Test admin can view team members list and section customization form.
     */
    public function test_admin_can_view_team_members_list(): void
    {
        $response = $this->actingAs($this->admin)->get(route('admin.team.index'));

        $response->assertStatus(200);
        $response->assertSee('Meet Our Leadership Team (CRUD)');
        $response->assertSee('Mohammad Manirul');
        $response->assertSee('Founder & CEO');
    }

    /**
     * Test admin can create a new team member with image upload.
     */
    public function test_admin_can_create_new_team_member(): void
    {
        Storage::fake('public');

        $file = UploadedFile::fake()->image('executive.jpg', 300, 300);

        $payload = [
            'name' => 'Dr. Ananya Roy',
            'role' => 'Senior Career Counselor',
            'bio' => 'Expert in vocational guidance and psychometric assessment for job candidates.',
            'image' => $file,
            'sort_order' => 10,
            'is_active' => '1',
        ];

        $response = $this->actingAs($this->admin)->post(route('admin.team.store'), $payload);

        $response->assertRedirect(route('admin.team.index'));
        $response->assertSessionHas('success');

        $this->assertDatabaseHas('team_members', [
            'name' => 'Dr. Ananya Roy',
            'role' => 'Senior Career Counselor',
            'sort_order' => 10,
            'is_active' => true,
        ]);
    }

    /**
     * Test admin can view edit page and update a team member.
     */
    public function test_admin_can_update_team_member(): void
    {
        $member = TeamMember::first();

        $editResponse = $this->actingAs($this->admin)->get(route('admin.team.edit', $member));
        $editResponse->assertStatus(200);
        $editResponse->assertSee($member->name);

        $updateResponse = $this->actingAs($this->admin)->put(route('admin.team.update', $member), [
            'name' => 'Mohammad Manirul Updated',
            'role' => 'Group CEO & Managing Director',
            'bio' => 'Updated leadership bio details.',
            'sort_order' => 1,
            'is_active' => '1',
        ]);

        $updateResponse->assertRedirect(route('admin.team.index'));
        $this->assertDatabaseHas('team_members', [
            'id' => $member->id,
            'name' => 'Mohammad Manirul Updated',
            'role' => 'Group CEO & Managing Director',
        ]);
    }

    /**
     * Test admin can toggle a member's active status.
     */
    public function test_admin_can_toggle_member_status(): void
    {
        $member = TeamMember::first();
        $this->assertTrue($member->is_active);

        $response = $this->actingAs($this->admin)->post(route('admin.team.toggle-status', $member));

        $response->assertSessionHas('success');
        $this->assertFalse($member->fresh()->is_active);
    }

    /**
     * Test admin can delete a team member.
     */
    public function test_admin_can_delete_team_member(): void
    {
        $member = TeamMember::create([
            'name' => 'Temporary Executive',
            'role' => 'Interim Consultant',
            'bio' => 'Temporary profile for deletion test.',
            'sort_order' => 99,
            'is_active' => true,
        ]);

        $response = $this->actingAs($this->admin)->delete(route('admin.team.destroy', $member));

        $response->assertRedirect(route('admin.team.index'));
        $this->assertDatabaseMissing('team_members', [
            'id' => $member->id,
        ]);
    }

    /**
     * Test admin can update section header and visibility settings.
     */
    public function test_admin_can_update_section_header_settings(): void
    {
        $response = $this->actingAs($this->admin)->post(route('admin.team.section-settings'), [
            'team_section_tagline' => 'OUR EXECUTIVES',
            'team_section_title' => 'Executive Board & Advisors',
            'team_section_subtitle' => 'Guiding your career path with industry experts.',
            'team_section_visible' => '1',
        ]);

        $response->assertRedirect(route('admin.team.index'));
        $this->assertEquals('OUR EXECUTIVES', SiteSetting::get('team_section_tagline'));
        $this->assertEquals('Executive Board & Advisors', SiteSetting::get('team_section_title'));
    }

    /**
     * Test frontend about page displays active team members and customized section title.
     */
    public function test_frontend_about_page_displays_active_team_members(): void
    {
        SiteSetting::set('team_section_title', 'Verified Leadership Board', 'team');

        $response = $this->get('/about');

        $response->assertStatus(200);
        $response->assertSee('Verified Leadership Board');
        $response->assertSee('Mohammad Manirul');
        $response->assertSee('Visionary founder dedicated to transparent placement services');
        $response->assertDontSee('border: 1px solid rgba(22, 163, 74, 0.2);', false);
    }

    /**
     * Test frontend about page hides section when team_section_visible is false.
     */
    public function test_frontend_about_page_hides_section_when_invisible(): void
    {
        SiteSetting::set('team_section_visible', '0', 'team');

        $response = $this->get('/about');

        $response->assertStatus(200);
        $response->assertDontSee('id="leadership-team"', false);
    }
}
