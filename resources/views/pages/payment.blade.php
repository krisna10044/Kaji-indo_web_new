@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-body text-center">
                    <h4>Selesaikan Pembayaran</h4>
                    <p class="text-muted">Anda akan diarahkan ke halaman pembayaran Midtrans</p>
                    
                    <div id="snap-container"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}"></script>
<script>
    snap.pay('{{ $snapToken }}', {
        onSuccess: function(result) {
            window.location.href = "{{ route('upgrade.success') }}?order_id={{ $order_id }}";
        },
        onPending: function(result) {
            window.location.href = "{{ route('upgrade.success') }}?order_id={{ $order_id }}";
        },
        onError: function(result) {
            alert('Pembayaran gagal atau dibatalkan.');
        }
    });
</script>
@endsection