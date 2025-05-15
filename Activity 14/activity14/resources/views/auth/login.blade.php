<x-guest-layout>
  <div style="max-width:400px; margin:3rem auto; padding:2rem; background:#fff; border:1px solid #d0d7de; border-radius:8px;">
    
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <h2 style="font-size:1.5rem; font-weight:600; color:black; margin-bottom:1.5rem; text-align:center;">
      {{ __('Log in to your account') }}
    </h2>

    <form method="POST" action="{{ route('login') }}">
      @csrf

      <!-- Email Address -->
      <div style="margin-bottom:1.25rem;">
        <x-input-label for="email" :value="__('Email')" />
        <x-text-input 
          id="email" 
          style="width:100%; padding:0.5rem; border-radius:4px; margin-top:0.25rem;" 
          type="email" 
          name="email" 
          :value="old('email')" 
          required 
          autofocus 
          autocomplete="username" 
        />
        <x-input-error :messages="$errors->get('email')" style="color:#dc2626; font-size:0.875rem; margin-top:0.25rem;" />
      </div>

      <!-- Password -->
      <div style="margin-bottom:1.25rem;">
        <x-input-label for="password" :value="__('Password')" />
        <x-text-input 
          id="password" 
          style="width:100%; padding:0.5rem;  border-radius:4px; margin-top:0.25rem;" 
          type="password" 
          name="password" 
          required 
          autocomplete="current-password" 
        />
        <x-input-error :messages="$errors->get('password')" style="color:#dc2626; font-size:0.875rem; margin-top:0.25rem;" />
      </div>

      <!-- Remember Me -->
      <div style="display:flex; align-items:center; margin-bottom:1.5rem;">
        <input 
          id="remember_me" 
          type="checkbox" 
          name="remember" 
          style="width:16px; height:16px;  border-radius:3px;" 
        />
        <label for="remember_me" style="margin-left:0.5rem; font-size:0.875rem; color:black; user-select:none;">
          {{ __('Remember me') }}
        </label>
      </div>

      <div style="display:flex; justify-content:space-between; align-items:center;">
        @if (Route::has('password.request'))
          <a href="{{ route('password.request') }}" style="font-size:0.875rem; color:#3b82f6; text-decoration:underline;">
            {{ __('Forgot your password?') }}
          </a>
        @endif

        <x-primary-button style="background-color:black; padding:0.5rem 1.5rem; font-weight:600; border-radius:4px; color:#fff;">
          {{ __('Log in') }}
        </x-primary-button>
      </div>
    </form>
  </div>
</x-guest-layout>
