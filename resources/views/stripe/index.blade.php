<x-public-layout>
    <x-slot name="header">
        {{ __('Stripe') }}
    </x-slot>

    <section class="public-section">
        <div class="container">
            <div class="flex">
                {{-- To ze stripe jest --}}
                <div class="product">
                    <img src="https://i.imgur.com/EHyR2nP.png" alt="The cover of Stubborn Attachments" width="450" />
                    <div class="description">
                        <h3>Plan One</h3>
                        <h5>cena: $2.00</h5>
                    </div>
                    <form action="{{ route('stripe.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="plan" value="one">
                        <button type="submit" id="checkout-button">Checkout Plan One</button>
                    </form>
                </div>
                {{-- To ze stripe jest --}}
                <div class="product">
                    <img src="https://place-hold.it/450" alt="The cover of Stubborn Attachments" />
                    <div class="description">
                        <h3>Plan Two</h3>
                        <h5>cena: $3.00</h5>
                    </div>
                    <form action="{{ route('stripe.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="plan" value="two">
                        <button type="submit" id="checkout-button">Checkout Plan Two</button>
                    </form>
                </div>
            </div>

        </div>
    </section>
</x-public-layout>
