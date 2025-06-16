@extends('layouts.app')

@section('content')
<main>
    <section class="container mt-5 text-center">
        <h3>Konfirmasi Pembayaran</h3>
        <button id="pay-button" class="btn btn-primary">Bayar Sekarang</button>
    </section>
</main>
@endsection

@push('scripts')
<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ env('MIDTRANS_CLIENT_KEY') }}"></script>
<script>
    document.getElementById('pay-button').onclick = function() {
        snap.pay('{{ $snapToken }}', {
            onSuccess: function(result) {
                alert("Pembayaran berhasil!");
                window.location.href = "{{ route('booking.check') }}";
            },
            onPending: function(result) {
                alert("Pembayaran masih pending.");
                window.location.href = "{{ route('booking.check') }}";
            },
            onError: function(result) {
                alert("Pembayaran gagal.");
            },
            onClose: function() {
                alert('Pembayaran dibatalkan.');
            }
        });
        
    };
</script>
@endpush
