<form method="POST" action="{{ route('login') }}">
    @csrf
    <div>
        <label for="email">Email</label>
        <input id="email" type="email" name="email" required autofocus>
    </div>
    <div>
        <label for="password">Password</label>
        <input id="password" type="password" name="password" required>
    </div>
    <div>
        <label for="google2fa_token">Google Authenticator Code</label>
        <input id="google2fa_token" type="text" name="google2fa_token" required>
    </div>
    <button type="submit">Login</button>
</form>