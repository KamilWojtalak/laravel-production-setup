<x-public-layout>
    <x-slot name="header">
        {{ __('Stripe') }}
    </x-slot>

    <section class="public-section">
        <div class="container">

            <div class="product">
                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="14px" height="16px" viewBox="0 0 14 16" version="1.1">
                    <defs/>
                    <g id="Flow" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                        <g id="0-Default" transform="translate(-121.000000, -40.000000)" fill="#E184DF">
                            <path d="M127,50 L126,50 C123.238576,50 121,47.7614237 121,45 C121,42.2385763 123.238576,40 126,40 L135,40 L135,56 L133,56 L133,42 L129,42 L129,56 L127,56 L127,50 Z M127,48 L127,42 L126,42 C124.343146,42 123,43.3431458 123,45 C123,46.6568542 124.343146,48 126,48 L127,48 Z" id="Pilcrow"/>
                        </g>
                    </g>
                </svg>
                <div class="description">
                  <h3>First plan</h3>
                  <h5>$2.00 / month</h5>
                </div>
              </div>
              <form action="{{ route('stripe.subscription.store') }}" method="POST">
                @csrf
                <!-- Add a hidden field with the lookup_key of your Price -->
                <input type="hidden" name="lookup_key" value="prod_QBUa5t5a2aO5jn" />
                <button id="checkout-and-portal-button" type="submit">Checkout</button>
              </form>

            {{-- <div class="flex">
                @forelse ($plans as $plan)
                    <div class="product">
                        <img src="https://place-hold.it/450" alt="The cover of Stubborn Attachments" />
                        <div class="description">
                            <h3>{{ $plan->name }}</h3>
                            <h5>cena: ${{ $plan->price }}</h5>
                        </div>
                        <form action="{{ route('stripe.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="plan_id" value="{{ $plan->id }}">
                            <button type="submit" id="checkout-button">Checkout Plan {{ $plan->name }}</button>
                        </form>
                    </div>
                @empty
                    <div class="">Brak Planów w bazie</div>
                @endforelse
            </div> --}}

        </div>
    </section>
</x-public-layout>
