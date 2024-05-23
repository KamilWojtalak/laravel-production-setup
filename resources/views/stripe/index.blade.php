<x-public-layout>
    <x-slot name="header">
        {{ __('Stripe') }}
    </x-slot>

    <section class="public-section">
        <div class="container">
            <h2>Tutaj będzie coś ze stripe</h2>

            {{-- To ze stripe jest --}}
            <div class="product">
                <img src="https://i.imgur.com/EHyR2nP.png" alt="The cover of Stubborn Attachments" />
                <div class="description">
                    <h3>Nazwa produktu</h3>
                    <h5>cena: $20.00</h5>
                </div>
            </div>

            <form action="{{ route('stripe.store') }}" method="POST">
                @csrf
                <button type="submit" id="checkout-button">Checkout</button>
            </form>
        </div>
    </section>
</x-public-layout>
