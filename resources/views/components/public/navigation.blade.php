<nav class="relative w-full">
    <div class="container">
        <div class="flex items-center justify-between">
            <menu>
                <nav>
                    <ul class="flex items-center justify-center">
                        <li class="px-5 flex flex-row items-center justify-center">
                            <a href="/">Home Page</a>
                        </li>
                        <li class="px-5">
                            <a href="{{ route('stripe.index') }}">Stripe test</a>
                        </li>
                        <li class="px-5">
                            <a href="{{ route('orders.index') }}">Orders</a>
                        </li>
                    </ul>
                </nav>
            </menu>
            <header class="">
                @if (Route::has('login'))
                    <nav class="-mx-3 flex flex-1 justify-end">
                        @auth
                            <a href="{{ url('/dashboard') }}"
                                class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20]">
                                Dashboard
                            </a>
                        @else
                            <a href="{{ route('login') }}"
                                class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20]">
                                Log in
                            </a>

                            @if (Route::has('register'))
                                <a href="{{ route('register') }}"
                                    class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20]">
                                    Register
                                </a>
                            @endif
                        @endauth
                    </nav>
                @endif
            </header>
            <div class="feedback-container">
                <a href="{{ route('feedback.index') }}">
                    {{ __('Feedback') }}
                </a>
            </div>
        </div>
    </div>
</nav>
