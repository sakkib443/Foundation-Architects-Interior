<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\Concerns\HandlesUploads;
use App\Http\Controllers\Controller;
use App\Models\TeamMember;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TeamController extends Controller
{
    use HandlesUploads;

    public function index(): View
    {
        $team = TeamMember::orderBy('sort_order')->get();

        return view('admin.team.index', compact('team'));
    }

    public function create(): View
    {
        $team = new TeamMember();

        return view('admin.team.create', compact('team'));
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $this->validateTeamMember($request);

        $data['is_published'] = $request->boolean('is_published');
        $data['sort_order'] = (int) TeamMember::max('sort_order') + 1;

        if ($path = $this->storeUpload($request, 'photo', 'team')) {
            $data['photo'] = $path;
        }

        TeamMember::create($data);

        return redirect()->route('admin.team.index')
            ->with('status', 'Team member created.');
    }

    public function edit(TeamMember $team): View
    {
        return view('admin.team.edit', compact('team'));
    }

    public function update(Request $request, TeamMember $team): RedirectResponse
    {
        $data = $this->validateTeamMember($request);

        $data['is_published'] = $request->boolean('is_published');

        if ($path = $this->storeUpload($request, 'photo', 'team')) {
            $data['photo'] = $path;
        } else {
            unset($data['photo']);
        }

        $team->update($data);

        return redirect()->route('admin.team.index')
            ->with('status', 'Team member updated.');
    }

    public function destroy(TeamMember $team): RedirectResponse
    {
        $team->delete();

        return redirect()->route('admin.team.index')
            ->with('status', 'Team member deleted.');
    }

    /**
     * @return array<string, mixed>
     */
    private function validateTeamMember(Request $request): array
    {
        return $request->validate([
            'name'  => 'required|string|max:255',
            'role'  => 'nullable|string|max:255',
            'photo' => 'nullable|image|max:4096',
        ]);
    }
}
