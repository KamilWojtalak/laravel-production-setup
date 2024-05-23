<x-public-layout>
    <x-slot name="header">
        {{ __('Orders') }}
    </x-slot>

    <section class="public-section">
        <div class="container">
            <p>orders</p>
            @forelse ($orders as $order)
                <li>
                    {{ $order->id }} | {{ $order->status }} | {{ $order->payment_provider }} | {{ $order->price }}
                </li>
            @empty
                <p>Brak zamówień</p>
            @endforelse
        </div>
    </section>
</x-public-layout>
