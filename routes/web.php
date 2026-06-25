<?php

use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\HomepageController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\SiteContentController;
use App\Http\Controllers\Admin\TeamController;
use App\Http\Controllers\Admin\TestimonialController;
use App\Models\BlogPost;
use App\Models\Project;
use App\Models\Service;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Public site
|--------------------------------------------------------------------------
*/
Route::get('/', fn () => view('home'))->name('home');
Route::get('/about', fn () => view('about'))->name('about');

Route::get('/services', fn () => view('services'))->name('services');
Route::get('/services/{slug}', function (string $slug) {
    $service = Service::where('slug', $slug)->where('is_published', true)->firstOrFail();

    return view('services.show', ['slug' => $slug, 'service' => $service]);
})->name('services.show');

Route::get('/projects', fn () => view('projects'))->name('projects');
Route::get('/projects/{slug}', function (string $slug) {
    $project = Project::where('slug', $slug)->where('is_published', true)->firstOrFail();

    return view('projects.show', ['slug' => $slug, 'project' => $project]);
})->name('projects.show');

Route::get('/blog', fn () => view('blog'))->name('blog');
Route::get('/blog/{slug}', function (string $slug) {
    $post = BlogPost::where('slug', $slug)->where('is_published', true)->firstOrFail();

    return view('blog.show', ['post' => $post]);
})->name('blog.show');

Route::get('/testimonials', fn () => view('testimonials'))->name('testimonials');
Route::get('/contact', fn () => view('contact'))->name('contact');

Route::post('/contact', function (\Illuminate\Http\Request $request) {
    $data = $request->validate([
        'name'    => ['required', 'string', 'max:120'],
        'email'   => ['required', 'email', 'max:160'],
        'phone'   => ['nullable', 'string', 'max:40'],
        'subject' => ['nullable', 'string', 'max:120'],
        'message' => ['required', 'string', 'max:5000'],
    ]);

    // Mail isn't configured yet, so capture the inquiry in the log for now.
    \Illuminate\Support\Facades\Log::info('Contact form submission', $data);

    return back()->with('contact_status', "Thanks, {$data['name']}! Your message has been received — we'll get back within one working day.");
})->name('contact.submit');

/*
|--------------------------------------------------------------------------
| Admin authentication
|--------------------------------------------------------------------------
*/
Route::middleware('guest')->group(function () {
    Route::get('/admin/login', [LoginController::class, 'show'])->name('admin.login');
    Route::post('/admin/login', [LoginController::class, 'login'])->name('admin.login.attempt');
});

Route::post('/admin/logout', [LoginController::class, 'logout'])
    ->middleware('auth')->name('admin.logout');

/*
|--------------------------------------------------------------------------
| Admin panel
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    // Homepage (settings-backed)
    Route::get('homepage', [HomepageController::class, 'edit'])->name('homepage.edit');
    Route::put('homepage', [HomepageController::class, 'update'])->name('homepage.update');

    // Collections (resourceful CRUD; no public "show" in admin)
    Route::resource('services', ServiceController::class)->except('show');
    Route::resource('projects', ProjectController::class)->except('show');
    Route::resource('blog', BlogController::class)->except('show');
    Route::resource('testimonials', TestimonialController::class)->except('show');
    Route::resource('team', TeamController::class)->except('show');

    // Site content (settings-backed sections)
    Route::get('site-content', [SiteContentController::class, 'index'])->name('site-content.index');
    Route::get('site-content/about', [SiteContentController::class, 'aboutEdit'])->name('site-content.about.edit');
    Route::put('site-content/about', [SiteContentController::class, 'aboutUpdate'])->name('site-content.about.update');
    Route::get('site-content/contact', [SiteContentController::class, 'contactEdit'])->name('site-content.contact.edit');
    Route::put('site-content/contact', [SiteContentController::class, 'contactUpdate'])->name('site-content.contact.update');
    Route::get('site-content/footer', [SiteContentController::class, 'footerEdit'])->name('site-content.footer.edit');
    Route::put('site-content/footer', [SiteContentController::class, 'footerUpdate'])->name('site-content.footer.update');
    Route::get('site-content/banners', [SiteContentController::class, 'bannersEdit'])->name('site-content.banners.edit');
    Route::put('site-content/banners', [SiteContentController::class, 'bannersUpdate'])->name('site-content.banners.update');

    // Global settings (site identity, branding, contact)
    Route::get('settings', [SettingController::class, 'edit'])->name('settings.edit');
    Route::put('settings', [SettingController::class, 'update'])->name('settings.update');
});
