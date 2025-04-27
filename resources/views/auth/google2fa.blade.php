<p>Scan this QR code with Google Authenticator:</p>
<div>
    <img src="{{ $qr_image }}" alt="QR Code">
</div>
<p>Or use this code: {{ $secret }}</p>
<a href="{{ route('login') }}">Continue to Login</a>