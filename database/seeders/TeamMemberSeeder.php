<?php

namespace Database\Seeders;

use App\Models\SiteSetting;
use App\Models\TeamMember;
use Illuminate\Database\Seeder;

class TeamMemberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Default section header settings
        SiteSetting::set('team_section_tagline', 'LEADERSHIP & EXPERTISE', 'team');
        SiteSetting::set('team_section_title', 'Meet Our Leadership Team', 'team');
        SiteSetting::set('team_section_subtitle', 'Dedicated counselors and HR professionals helping you take the next big step in your career.', 'team');
        SiteSetting::set('team_section_visible', '1', 'team');

        $members = [
            [
                'name' => 'Mohammad Manirul',
                'role' => 'Founder & CEO',
                'bio' => 'Visionary founder dedicated to transparent placement services, youth empowerment, and student career transformation across West Bengal.',
                'image_path' => 'assets/images/team/manirul.svg',
                'sort_order' => 1,
                'is_active' => true,
            ],
            [
                'name' => 'Hafijur Mondal',
                'role' => 'Director & Operations',
                'bio' => 'Spearheading company recruitment drives, employer tie-ups, logistics, and verification protocols for verified spot-hiring drives.',
                'image_path' => 'assets/images/team/hafijur.svg',
                'sort_order' => 2,
                'is_active' => true,
            ],
            [
                'name' => 'Sk Samim',
                'role' => 'Placement Head',
                'bio' => 'Guiding candidates through interview rounds, aptitude test coaching, and securing direct corporate payroll job contracts.',
                'image_path' => 'assets/images/team/samim.svg',
                'sort_order' => 3,
                'is_active' => true,
            ],
            [
                'name' => 'Sahil Sk',
                'role' => 'Overseas Coordinator',
                'bio' => 'Managing Gulf and Europe trade test verification, visa documentation assistance, and airport departure orientation.',
                'image_path' => 'assets/images/team/sahil.svg',
                'sort_order' => 4,
                'is_active' => true,
            ],
            [
                'name' => 'Dhiman Das',
                'role' => 'Training & Skill Head',
                'bio' => 'Conducting vocational skill development, computer operator training, and interview grooming sessions for students.',
                'image_path' => 'assets/images/team/dhiman.svg',
                'sort_order' => 5,
                'is_active' => true,
            ],
            [
                'name' => 'Prasanna Ghosh',
                'role' => 'Public Relations',
                'bio' => 'Assisting candidates with inquiry resolution on helpline queries, document upload support, and WhatsApp job subscriptions.',
                'image_path' => 'assets/images/team/prasanna.svg',
                'sort_order' => 6,
                'is_active' => true,
            ],
        ];

        foreach ($members as $data) {
            TeamMember::updateOrCreate(
                ['name' => $data['name']],
                $data
            );
        }
    }
}
