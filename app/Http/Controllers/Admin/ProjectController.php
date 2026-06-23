<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\Concerns\HandlesUploads;
use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class ProjectController extends Controller
{
    use HandlesUploads;

    public function index(): View
    {
        $projects = Project::orderBy('sort_order')->get();

        return view('admin.projects.index', compact('projects'));
    }

    public function create(): View
    {
        $project = new Project();

        return view('admin.projects.create', compact('project'));
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $this->validateProject($request);

        $data['slug'] = $data['slug'] ?: Str::slug($data['title']);
        $data['scope'] = $this->cleanScope($request->input('scope', []));
        $data['gallery'] = $this->resolveGallery($request);
        $data['is_published'] = $request->boolean('is_published');
        $data['sort_order'] = (int) Project::max('sort_order') + 1;

        if ($path = $this->storeUpload($request, 'image', 'projects')) {
            $data['image'] = $path;
        }

        Project::create($data);

        return redirect()->route('admin.projects.index')
            ->with('status', 'Project created.');
    }

    public function edit(Project $project): View
    {
        return view('admin.projects.edit', compact('project'));
    }

    public function update(Request $request, Project $project): RedirectResponse
    {
        $data = $this->validateProject($request, $project);

        $data['slug'] = $data['slug'] ?: Str::slug($data['title']);
        $data['scope'] = $this->cleanScope($request->input('scope', []));
        $data['gallery'] = $this->resolveGallery($request);
        $data['is_published'] = $request->boolean('is_published');

        if ($path = $this->storeUpload($request, 'image', 'projects')) {
            $data['image'] = $path;
        } else {
            unset($data['image']);
        }

        $project->update($data);

        return redirect()->route('admin.projects.index')
            ->with('status', 'Project updated.');
    }

    public function destroy(Project $project): RedirectResponse
    {
        $project->delete();

        return redirect()->route('admin.projects.index')
            ->with('status', 'Project deleted.');
    }

    /**
     * @return array<string, mixed>
     */
    private function validateProject(Request $request, ?Project $project = null): array
    {
        $slugRule = 'nullable|string|max:255|unique:projects,slug';
        if ($project) {
            $slugRule .= ','.$project->id;
        }

        return $request->validate([
            'title'        => 'required|string|max:255',
            'slug'         => $slugRule,
            'category'     => 'nullable|string|max:255',
            'location'     => 'nullable|string|max:255',
            'year'         => 'nullable|string|max:255',
            'area'         => 'nullable|string|max:255',
            'summary'      => 'nullable|string',
            'overview'     => 'nullable|string',
            'scope'        => 'nullable|array',
            'scope.*'      => 'nullable|string|max:255',
            'image'        => 'nullable|image|max:4096',
            'gallery'      => 'nullable|array',
            'gallery.*'    => 'nullable|string',
            'gallery_new'  => 'nullable|array',
            'gallery_new.*' => 'nullable|image|max:4096',
        ]);
    }

    /**
     * Drop empty rows and reindex the submitted scope strings.
     *
     * @param  array<int, string|null>  $rows
     * @return array<int, string>
     */
    private function cleanScope(array $rows): array
    {
        return array_values(array_filter(
            array_map(fn ($row) => is_string($row) ? trim($row) : '', $rows),
            fn ($row) => filled($row)
        ));
    }

    /**
     * Merge the kept existing gallery paths with any newly uploaded images.
     *
     * @return array<int, string>
     */
    private function resolveGallery(Request $request): array
    {
        $kept = array_values(array_filter(
            (array) $request->input('gallery', []),
            fn ($path) => is_string($path) && filled($path)
        ));

        $added = $this->storeUploads($request, 'gallery_new', 'projects');

        return array_values(array_merge($kept, $added));
    }
}
