@php
    $values = [
        [
            'title' => 'Award-Winning Design',
            'desc'  => 'Recognised excellence in interior design with industry-leading, on-trend concepts.',
            'icon'  => 'M16.5 18.75h-9m9 0a3 3 0 013 3h-15a3 3 0 013-3m9 0v-3.375c0-.621-.503-1.125-1.125-1.125h-.871M7.5 18.75v-3.375c0-.621.504-1.125 1.125-1.125h.872m5.007 0H9.497m5.007 0a7.454 7.454 0 01-.982-3.172M9.497 14.25a7.454 7.454 0 00.981-3.172M5.25 4.236c-.982.143-1.954.317-2.916.52A6.003 6.003 0 007.73 9.728M5.25 4.236V4.5c0 2.108.966 3.99 2.48 5.228M5.25 4.236V2.721C7.456 2.41 9.71 2.25 12 2.25c2.291 0 4.545.16 6.75.47v1.516M7.73 9.728a6.726 6.726 0 002.748 1.35m8.272-6.842V4.5c0 2.108-.966 3.99-2.48 5.228m2.48-5.492a46.32 46.32 0 012.916.52 6.003 6.003 0 01-5.395 4.972m0 0a6.726 6.726 0 01-2.749 1.35m0 0a6.772 6.772 0 01-3.044 0',
        ],
        [
            'title' => 'Expert In-House Team',
            'desc'  => 'Seasoned architects, designers, and 3D artists collaborating under one roof.',
            'icon'  => 'M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z',
        ],
        [
            'title' => 'Client-Focused',
            'desc'  => 'Your taste guides every decision — clear communication from concept to keys.',
            'icon'  => 'M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z',
        ],
        [
            'title' => 'On-Time & On-Budget',
            'desc'  => 'Transparent pricing and disciplined delivery — no surprises, ever.',
            'icon'  => 'M2.25 8.25h19.5M2.25 9h19.5m-16.5 5.25h6m-6 2.25h3m-3.75 3h15a2.25 2.25 0 002.25-2.25V6.75A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25v10.5A2.25 2.25 0 004.5 19.5z',
        ],
    ];
@endphp

<section class="bg-brand-50 py-20 sm:py-28">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">

        {{-- Header --}}
        <div class="mx-auto flex max-w-2xl flex-col items-center text-center">
            <p class="font-script text-3xl leading-none text-brand-600 sm:text-4xl">Why Foundation</p>
            <h2 class="mt-3 font-display text-4xl font-bold tracking-tight text-brand-900 sm:text-5xl">
                Why Choose Us
            </h2>
            <p class="mt-4 text-stone-500">
                What sets our studio apart in the world of design.
            </p>
        </div>

        {{-- Cards --}}
        <div class="mt-14 grid gap-6 sm:grid-cols-2 lg:grid-cols-4">
            @foreach ($values as $v)
                <div class="group rounded-2xl border border-brand-100 bg-white p-6 text-center shadow-sm transition duration-300 hover:-translate-y-1.5 hover:border-brand-300 hover:shadow-xl hover:shadow-brand-500/10">
                    <div class="mx-auto flex h-14 w-14 items-center justify-center rounded-2xl bg-gradient-to-br from-brand-400 to-brand-600 text-white shadow-lg shadow-brand-500/30 transition duration-300 group-hover:scale-110">
                        <svg class="h-7 w-7" fill="none" stroke="currentColor" stroke-width="1.6" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="{{ $v['icon'] }}"/>
                        </svg>
                    </div>
                    <h3 class="mt-5 font-display text-lg font-semibold text-brand-900">{{ $v['title'] }}</h3>
                    <p class="mt-2 text-sm leading-relaxed text-stone-500">{{ $v['desc'] }}</p>
                </div>
            @endforeach
        </div>
    </div>
</section>
