<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BlogPost;
use App\Models\Project;
use App\Models\Service;
use App\Models\TeamMember;
use App\Models\Testimonial;

class DashboardController extends Controller
{
    public function index(): mixed
    {
        $counts = [
            'services'     => Service::count(),
            'projects'     => Project::count(),
            'posts'        => BlogPost::count(),
            'testimonials' => Testimonial::count(),
            'team'         => TeamMember::count(),
        ];

        $recent = [
            'projects' => Project::latest('updated_at')->take(5)->get(),
            'posts'    => BlogPost::latest('updated_at')->take(5)->get(),
        ];

        return view('admin.dashboard', compact('counts', 'recent'));
    }
}
