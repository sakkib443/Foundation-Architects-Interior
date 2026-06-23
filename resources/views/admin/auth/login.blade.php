<!DOCTYPE html>
<html lang="en" class="h-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noindex, nofollow">
    <title>Admin Login · {{ $settings->get('site.name', config('app.name')) }}</title>
    <link rel="icon" type="image/svg+xml" href="{{ asset($settings->get('site.favicon', 'images/logo.svg')) }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css'])
</head>
<body class="flex min-h-full items-center justify-center bg-gradient-to-br from-brand-50 via-white to-brand-100 p-4 font-sans text-stone-800 antialiased">

    <div class="w-full max-w-md">
        <div class="flex flex-col items-center">
            <img src="{{ asset($settings->get('site.logo', 'images/logo.svg')) }}" alt="" class="h-14 w-14 rounded-full shadow-lg ring-1 ring-brand-200">
            <h1 class="mt-4 font-display text-2xl font-bold text-brand-900">{{ $settings->get('site.name', config('app.name')) }}</h1>
            <p class="mt-1 text-sm text-stone-500">Admin panel — please sign in</p>
        </div>

        <form method="POST" action="{{ route('admin.login.attempt') }}" class="mt-8 space-y-5 rounded-3xl border border-stone-100 bg-white p-8 shadow-xl shadow-stone-900/5">
            @csrf

            @if ($errors->any())
                <div class="rounded-xl border border-rose-200 bg-rose-50 px-4 py-3 text-sm font-medium text-rose-700">
                    {{ $errors->first() }}
                </div>
            @endif

            <x-form.input name="email" label="Email" type="email" required autofocus autocomplete="username" placeholder="you@example.com" />
            <x-form.input name="password" label="Password" type="password" required autocomplete="current-password" placeholder="••••••••" />

            <label class="flex items-center gap-2 text-sm text-stone-600">
                <input type="checkbox" name="remember" value="1" class="rounded border-stone-300 text-brand-600 focus:ring-brand-500">
                Remember me
            </label>

            <button type="submit"
                class="w-full rounded-full bg-gradient-to-r from-brand-500 to-brand-700 px-6 py-3 text-sm font-semibold text-white shadow-lg shadow-brand-500/30 transition hover:from-brand-600 hover:to-brand-800">
                Sign in
            </button>
        </form>

        <p class="mt-6 text-center text-xs text-stone-400">
            &larr; <a href="{{ route('home') }}" class="hover:text-brand-600">Back to site</a>
        </p>
    </div>
</body>
</html>
