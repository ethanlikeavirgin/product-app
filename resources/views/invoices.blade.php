<x-guest-layout>
<div class="container">
    <h1>Your Invoices</h1>

    @if ($invoices->isEmpty())
        <p>No invoices found.</p>
    @else
        <ul>
            @foreach ($invoices as $invoice)
                <li>
                    {{ $invoice->date()->toFormattedDateString() }} - 
                    <a href="{{ $invoice->downloadUrl() }}">Download Invoice</a>
                </li>
            @endforeach
        </ul>
    @endif
</div>
</x-guest-layout>