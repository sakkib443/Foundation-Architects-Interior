<footer id="contact" class="border-t border-brand-900/40 bg-brand-900 text-brand-100">
    <div class="mx-auto grid max-w-7xl gap-10 px-4 py-14 sm:px-6 md:grid-cols-3 lg:px-8">
        <div>
            <div class="flex items-center gap-3">
                <img src="{{ asset('images/logo.svg') }}" alt="Foundation Architects &amp; Interior"
                     width="48" height="48" class="h-12 w-12 rounded-full ring-1 ring-white/15">
                <h3 class="font-display text-xl font-semibold text-white">Foundation Architects &amp; Interior</h3>
            </div>
            <p class="mt-3 max-w-xs text-sm leading-relaxed text-brand-200">
                A trusted name in the interior sector of Bangladesh — working with faith and honesty.
            </p>
        </div>

        <div>
            <h4 class="text-sm font-semibold uppercase tracking-wide text-brand-300">Explore</h4>
            <ul class="mt-4 space-y-2 text-sm">
                <li><a href="{{ route('home') }}" class="text-brand-200 transition hover:text-white">Home</a></li>
                <li><a href="#about" class="text-brand-200 transition hover:text-white">About Us</a></li>
                <li><a href="#projects" class="text-brand-200 transition hover:text-white">Projects</a></li>
                <li><a href="#contact" class="text-brand-200 transition hover:text-white">Contact</a></li>
            </ul>
        </div>

        <div>
            <h4 class="text-sm font-semibold uppercase tracking-wide text-brand-300">Get in touch</h4>
            <ul class="mt-4 space-y-2 text-sm text-brand-200">
                <li>📍 House -27, Road -12, Shekertak, Mohammadpur, Dhaka</li>
                <li>📞 <a href="tel:+8801722752657" class="transition hover:text-white">01722-752657</a></li>
                <li>💬 <a href="https://wa.me/8801722752657" class="transition hover:text-white">WhatsApp: +880 1722-752657</a></li>
                <li>✉️ <a href="mailto:f.architects2016@gmail.com" class="transition hover:text-white">f.architects2016@gmail.com</a></li>
            </ul>
        </div>
    </div>

    <div class="border-t border-brand-800">
        <div class="mx-auto max-w-7xl px-4 py-5 text-center text-xs text-brand-300 sm:px-6 lg:px-8">
            &copy; {{ date('Y') }} Foundation Architects &amp; Interior. All rights reserved.
        </div>
    </div>
</footer>
