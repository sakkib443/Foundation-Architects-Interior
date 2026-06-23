<?php

namespace Database\Seeders;

use App\Models\TeamMember;
use Illuminate\Database\Seeder;

/**
 * Seeds the team members from the values previously hardcoded in
 * resources/views/sections/about/team.blade.php so the public site is
 * unchanged after the switch to the database.
 */
class TeamSeeder extends Seeder
{
    public function run(): void
    {
        $members = [
            ['name' => 'Md. Rakibul Islam',   'role' => 'Sr. Architect',      'photo' => 'images/team/member-1.jpg'],
            ['name' => 'Md. Tanjeel Hossain', 'role' => 'Civil Engineer',     'photo' => 'images/team/member-2.jpg'],
            ['name' => 'Shahin Alam',         'role' => 'Lead 3D Visualizer', 'photo' => 'images/team/member-3.jpg'],
            ['name' => 'Delwar Hossain',      'role' => 'Project Operations', 'photo' => 'images/team/member-4.jpg'],
            ['name' => 'Mehjabin Sharia',     'role' => 'Interior Designer',  'photo' => 'images/team/member-5.jpg'],
            ['name' => 'Shazadul Ferdoush',   'role' => '3D Visual Artist',   'photo' => 'images/team/member-6.jpg'],
            ['name' => 'Sharmin Akter',       'role' => 'Interior Stylist',   'photo' => 'images/team/member-7.jpg'],
            ['name' => 'Farhad Hossen',       'role' => 'Site Architect',     'photo' => 'images/team/member-8.jpg'],
        ];

        foreach ($members as $order => $member) {
            TeamMember::updateOrCreate(
                ['name' => $member['name']],
                [
                    'role'         => $member['role'],
                    'photo'        => $member['photo'],
                    'sort_order'   => $order,
                    'is_published' => true,
                ]
            );
        }
    }
}
