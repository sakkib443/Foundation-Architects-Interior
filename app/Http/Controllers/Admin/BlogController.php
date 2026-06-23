<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\Concerns\HandlesUploads;
use App\Http\Controllers\Controller;
use App\Models\BlogPost;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class BlogController extends Controller
{
    use HandlesUploads;

    public function index(): View
    {
        $posts = BlogPost::orderBy('sort_order')->get();

        return view('admin.blog.index', compact('posts'));
    }

    public function create(): View
    {
        $blog = new BlogPost();

        return view('admin.blog.create', compact('blog'));
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $this->validatePost($request);

        $data['slug'] = $data['slug'] ?: Str::slug($data['title']);
        $data['body'] = $this->cleanBody($request->input('body', []));
        $data['is_published'] = $request->boolean('is_published');
        $data['sort_order'] = (int) BlogPost::max('sort_order') + 1;

        if ($path = $this->storeUpload($request, 'image', 'blog')) {
            $data['image'] = $path;
        }

        BlogPost::create($data);

        return redirect()->route('admin.blog.index')
            ->with('status', 'Post created.');
    }

    public function edit(BlogPost $blog): View
    {
        return view('admin.blog.edit', compact('blog'));
    }

    public function update(Request $request, BlogPost $blog): RedirectResponse
    {
        $data = $this->validatePost($request, $blog);

        $data['slug'] = $data['slug'] ?: Str::slug($data['title']);
        $data['body'] = $this->cleanBody($request->input('body', []));
        $data['is_published'] = $request->boolean('is_published');

        if ($path = $this->storeUpload($request, 'image', 'blog')) {
            $data['image'] = $path;
        } else {
            unset($data['image']);
        }

        $blog->update($data);

        return redirect()->route('admin.blog.index')
            ->with('status', 'Post updated.');
    }

    public function destroy(BlogPost $blog): RedirectResponse
    {
        $blog->delete();

        return redirect()->route('admin.blog.index')
            ->with('status', 'Post deleted.');
    }

    /**
     * @return array<string, mixed>
     */
    private function validatePost(Request $request, ?BlogPost $blog = null): array
    {
        $slugRule = 'nullable|string|max:255|unique:blog_posts,slug';
        if ($blog && $blog->exists) {
            $slugRule .= ','.$blog->id;
        }

        return $request->validate([
            'title'    => 'required|string|max:255',
            'slug'     => $slugRule,
            'category' => 'nullable|string|max:255',
            'date'     => 'nullable|string|max:255',
            'read'     => 'nullable|integer|min:1',
            'excerpt'  => 'nullable|string',
            'image'    => 'nullable|image|max:4096',
            'body'     => 'nullable|array',
            'body.*'   => 'nullable|string',
        ]);
    }

    /**
     * Drop empty paragraphs and reindex the body array.
     *
     * @param  array<int, string|null>  $paragraphs
     * @return array<int, string>
     */
    private function cleanBody(array $paragraphs): array
    {
        return array_values(array_filter(
            $paragraphs,
            fn ($p) => trim((string) $p) !== ''
        ));
    }
}
