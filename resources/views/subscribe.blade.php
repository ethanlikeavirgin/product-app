<x-app-layout>
    <div class="container text-black">
        <h1>Subscribe for $10/month</h1>
    
        <form action="{{ route('subscribe.post') }}" method="POST">
            @csrf
    
            <label for="payment-method">Payment Method:</label>
            <select name="mollie_payment_method" id="payment-method" required>
                @foreach ($methods as $method)
                    <option value="{{ $method->id }}">{{ $method->description }}</option>
                @endforeach
            </select>
    
            <button type="submit">Subscribe</button>
        </form>
    </div>
</x-app-layout>
    