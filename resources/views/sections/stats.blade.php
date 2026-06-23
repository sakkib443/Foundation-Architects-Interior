@php
    $stats = $settings->get('homepage.stats', [
        [
            'value' => '15+',
            'label' => 'Awards Won',
            'icon'  => '<circle cx="12" cy="8" r="6"/><path stroke-linecap="round" stroke-linejoin="round" d="M8.21 13.89L7 22l5-3 5 3-1.21-8.12"/>',
        ],
        [
            'value' => '500+',
            'label' => 'Happy Clients',
            'icon'  => '<path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z"/>',
        ],
        [
            'value' => '100%',
            'label' => 'Quality Assured',
            'icon'  => '<path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>',
        ],
        [
            'value' => '98%',
            'label' => 'Client Satisfaction',
            'icon'  => '<path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18L9 11.25l4.306 4.307a11.95 11.95 0 015.814-5.519l2.74-1.22m0 0l-5.94-2.28m5.94 2.28l-2.28 5.941"/>',
        ],
    ]);
@endphp

<section class="bg-gradient-to-r from-brand-500 to-brand-600">
    <div class="mx-auto max-w-7xl px-4 py-12 sm:px-6 sm:py-14 lg:px-8">
        <div class="grid grid-cols-2 gap-y-10 gap-x-6 lg:grid-cols-4">
            @foreach ($stats as $stat)
                <div class="flex flex-col items-center text-center">
                    <div class="flex h-16 w-16 items-center justify-center rounded-full bg-white/15 text-white ring-1 ring-white/25 backdrop-blur">
                        <svg class="h-7 w-7" fill="none" stroke="currentColor" stroke-width="1.7" viewBox="0 0 24 24">
                            {!! $stat['icon'] !!}
                        </svg>
                    </div>
                    <p class="mt-4 text-4xl font-bold tracking-tight text-white sm:text-5xl" data-stat="{{ $stat['value'] }}">
                        {{ $stat['value'] }}
                    </p>
                    <p class="mt-1.5 text-sm font-medium text-white/80">{{ $stat['label'] }}</p>
                </div>
            @endforeach
        </div>
    </div>
</section>
