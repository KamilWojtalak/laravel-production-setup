<x-public-layout>
    <x-slot name="header">
        {{ __('Stripe') }}
    </x-slot>

    <section class="public-section">
        <div class="container">

            <div class="flex">
                @forelse ($plans as $plan)
                    {{-- To ze stripe jest --}}
                    <div class="product">
                        <img src="https://place-hold.it/450" alt="The cover of Stubborn Attachments" />
                        <div class="description">
                            <h3>{{ $plan->name }}</h3>
                            <h5>cena: $3.00</h5>
                        </div>
                        <form action="{{ route('stripe.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="plan" value="{{ $plan->name }}">
                            <button type="submit" id="checkout-button">Checkout Plan {{ $plan->name }}</button>
                        </form>
                    </div>
                @empty
                    <div class="">Brak Planów w bazie</div>
                @endforelse
            </div>

        </div>
    </section>
</x-public-layout>
