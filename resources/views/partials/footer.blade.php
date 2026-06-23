@php
    $siteName = $settings->get('site.name', 'Foundation Architects & Interior');
    $contact = $settings->get('site.contact', []);
    $footerLinks = $settings->get('footer.links', []);
@endphp

<footer id="contact" class="border-t border-brand-900/40 bg-brand-900 text-brand-100">
    <div class="mx-auto grid max-w-7xl gap-10 px-4 py-14 sm:px-6 md:grid-cols-3 lg:px-8">
        <div>
            <div class="flex items-center gap-3">
                <img src="{{ asset($settings->get('site.logo', 'images/logo.svg')) }}" alt="{{ $siteName }}"
                     width="48" height="48" class="h-12 w-12 rounded-full ring-1 ring-white/15">
                <h3 class="font-display text-xl font-semibold text-white">{{ $siteName }}</h3>
            </div>
            <p class="mt-3 max-w-xs text-sm leading-relaxed text-brand-200">
                {{ $settings->get('footer.about', 'A trusted name in the interior sector of Bangladesh — working with faith and honesty.') }}
            </p>
        </div>

        <div>
            <h4 class="text-sm font-semibold uppercase tracking-wide text-brand-300">Explore</h4>
            <ul class="mt-4 space-y-2 text-sm">
                @foreach ($footerLinks as $link)
                    <li><a href="{{ $link['href'] }}" class="text-brand-200 transition hover:text-white">{{ $link['label'] }}</a></li>
                @endforeach
            </ul>
        </div>

        <div>
            <h4 class="text-sm font-semibold uppercase tracking-wide text-brand-300">Get in touch</h4>
            <ul class="mt-4 space-y-2 text-sm text-brand-200">
                @if (!empty($contact['address']))
                    <li>📍 {{ $contact['address'] }}</li>
                @endif
                @if (!empty($contact['phone']))
                    <li>📞 <a href="tel:{{ $contact['phone'] }}" class="transition hover:text-white">{{ $contact['phone_display'] ?? $contact['phone'] }}</a></li>
                @endif
                @if (!empty($contact['whatsapp']))
                    <li>💬 <a href="https://wa.me/{{ $contact['whatsapp'] }}" class="transition hover:text-white">WhatsApp: {{ $contact['whatsapp_display'] ?? $contact['whatsapp'] }}</a></li>
                @endif
                @if (!empty($contact['email']))
                    <li>✉️ <a href="mailto:{{ $contact['email'] }}" class="transition hover:text-white">{{ $contact['email'] }}</a></li>
                @endif
            </ul>
        </div>
    </div>

    <div class="border-t border-brand-800">
        <div class="mx-auto max-w-7xl px-4 py-5 text-center text-xs text-brand-300 sm:px-6 lg:px-8">
            &copy; {{ date('Y') }} {{ $siteName }}. All rights reserved.
        </div>
    </div>
</footer>
