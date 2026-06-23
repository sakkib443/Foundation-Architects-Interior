<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\Concerns\HandlesUploads;
use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class ServiceController extends Controller
{
    use HandlesUploads;

    public function index(): View
    {
        $services = Service::orderBy('sort_order')->get();

        return view('admin.services.index', compact('services'));
    }

    public function create(): View
    {
        $service = new Service();

        return view('admin.services.create', compact('service'));
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $this->validateService($request);

        $data['slug'] = $data['slug'] ?: Str::slug($data['title']);
        $data['features'] = $this->cleanFeatures($request->input('features', []));
        $data['is_published'] = $request->boolean('is_published');
        $data['sort_order'] = (int) Service::max('sort_order') + 1;

        if ($path = $this->storeUpload($request, 'image', 'services')) {
            $data['image'] = $path;
        }

        Service::create($data);

        return redirect()->route('admin.services.index')
            ->with('status', 'Service created.');
    }

    public function edit(Service $service): View
    {
        return view('admin.services.edit', compact('service'));
    }

    public function update(Request $request, Service $service): RedirectResponse
    {
        $data = $this->validateService($request, $service);

        $data['slug'] = $data['slug'] ?: Str::slug($data['title']);
        $data['features'] = $this->cleanFeatures($request->input('features', []));
        $data['is_published'] = $request->boolean('is_published');

        if ($path = $this->storeUpload($request, 'image', 'services')) {
            $data['image'] = $path;
        } else {
            unset($data['image']);
        }

        $service->update($data);

        return redirect()->route('admin.services.index')
            ->with('status', 'Service updated.');
    }

    public function destroy(Service $service): RedirectResponse
    {
        $service->delete();

        return redirect()->route('admin.services.index')
            ->with('status', 'Service deleted.');
    }

    /**
     * @return array<string, mixed>
     */
    private function validateService(Request $request, ?Service $service = null): array
    {
        $slugRule = 'nullable|string|max:255|unique:services,slug';
        if ($service) {
            $slugRule .= ','.$service->id;
        }

        return $request->validate([
            'title'             => 'required|string|max:255',
            'slug'              => $slugRule,
            'tagline'           => 'nullable|string|max:255',
            'icon'              => 'nullable|string',
            'summary'           => 'nullable|string',
            'intro'             => 'nullable|string',
            'image'             => 'nullable|image|max:4096',
            'features'          => 'nullable|array',
            'features.*.title'  => 'nullable|string|max:255',
            'features.*.text'   => 'nullable|string',
        ]);
    }

    /**
     * Reindex submitted feature rows, dropping any with an empty title.
     *
     * @param  array<int, array{title?: string|null, text?: string|null}>  $rows
     * @return array<int, array{title: string, text: string}>
     */
    private function cleanFeatures(array $rows): array
    {
        $clean = array_filter($rows, fn ($row) => filled($row['title'] ?? null));

        return array_values(array_map(fn ($row) => [
            'title' => $row['title'] ?? '',
            'text'  => $row['text'] ?? '',
        ], $clean));
    }
}
