<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TestimonialController extends Controller
{
    public function index(): View
    {
        $testimonials = Testimonial::orderBy('sort_order')->get();

        return view('admin.testimonials.index', compact('testimonials'));
    }

    public function create(): View
    {
        $testimonial = new Testimonial();

        return view('admin.testimonials.create', compact('testimonial'));
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $this->validateTestimonial($request);

        $data['is_published'] = $request->boolean('is_published');
        $data['sort_order'] = (int) Testimonial::max('sort_order') + 1;

        Testimonial::create($data);

        return redirect()->route('admin.testimonials.index')
            ->with('status', 'Testimonial created.');
    }

    public function edit(Testimonial $testimonial): View
    {
        return view('admin.testimonials.edit', compact('testimonial'));
    }

    public function update(Request $request, Testimonial $testimonial): RedirectResponse
    {
        $data = $this->validateTestimonial($request);

        $data['is_published'] = $request->boolean('is_published');

        $testimonial->update($data);

        return redirect()->route('admin.testimonials.index')
            ->with('status', 'Testimonial updated.');
    }

    public function destroy(Testimonial $testimonial): RedirectResponse
    {
        $testimonial->delete();

        return redirect()->route('admin.testimonials.index')
            ->with('status', 'Testimonial deleted.');
    }

    /**
     * @return array<string, mixed>
     */
    private function validateTestimonial(Request $request): array
    {
        return $request->validate([
            'name'   => 'required|string|max:255',
            'role'   => 'nullable|string|max:255',
            'rating' => 'required|integer|min:1|max:5',
            'text'   => 'required|string',
        ]);
    }
}
