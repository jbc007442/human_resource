<form id="payment-form-{{ $plan }}" method="POST" action="{{ route('payments.store') }}">
    @csrf

    <input type="hidden" name="plan" value="{{ $plan }}">
    <input type="hidden" name="razorpay_payment_id">

    <button type="button"
        onclick="payNow('{{ $plan }}', {{ $amount }})"
        class="w-full bg-indigo-600 text-white py-3 rounded-xl font-bold hover:bg-indigo-700">
        Buy Now
    </button>
</form>