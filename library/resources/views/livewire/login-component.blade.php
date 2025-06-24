<div class="login-container col-5">
    <div class="login-header">
        <img src={{ asset('assets/logo-2.png') }} alt="Library Logo">
        <h2>Ibbadurrahman Montessori School</h2>
    </div>
    <form>
        <div class="form-group">
            <input type="text" wire:model="email" class="form-control" id="email" placeholder="Email Address"
                required>
        </div>
        <div class="form-group">
            <input type="password" wire:model="password" class="form-control" id="password" placeholder="Password"
                required>
        </div>
        <button type="button" wire:click="proses" class="btn btn-primary btn-login">Login</button>
        @if (session()->has('error'))
            <div class="alert alert-danger mt-2">
                {{ session('error') }}
            </div>
        @endif
    </form>

</div>
