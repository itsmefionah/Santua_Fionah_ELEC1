<x-guest-layout>
  <div style="max-width:400px; margin:3rem auto; padding:2rem; background:#fff; border:1px solid #d0d7de; border-radius:8px;">
    
    <h2 style="font-size:1.5rem; font-weight:600; color:black; margin-bottom:1.5rem; text-align:center;">
      {{ __('Create a new account') }}
    </h2>

    <form method="POST" action="{{ route('register') }}">
      @csrf

      <!-- Name -->
      <div style="margin-bottom:1.25rem;">
        <x-input-label for="name" :value="__('Name')" />
        <x-text-input 
          id="name" 
          style="width:100%; padding:0.5rem; border-radius:4px; margin-top:0.25rem;" 
          type="text" 
          name="name" 
          :value="old('name')" 
          required 
          autofocus 
          autocomplete="name" 
        />
        <x-input-error :messages="$errors->get('name')" style="color:#dc2626; font-size:0.875rem; margin-top:0.25rem;" />
      </div>

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
          autocomplete="username" 
        />
        <x-input-error :messages="$errors->get('email')" style="color:#dc2626; font-size:0.875rem; margin-top:0.25rem;" />
      </div>

      <!-- Password -->
      <div style="margin-bottom:1.25rem;">
        <x-input-label for="password" :value="__('Password')" />
        <x-text-input 
          id="password" 
          style="width:100%; padding:0.5rem; border-radius:4px; margin-top:0.25rem;" 
          type="password" 
          name="password" 
          required 
          autocomplete="new-password" 
        />
        <x-input-error :messages="$errors->get('password')" style="color:#dc2626; font-size:0.875rem; margin-top:0.25rem;" />
      </div>

      <!-- Confirm Password -->
      <div style="margin-bottom:1.5rem;">
        <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
        <x-text-input 
          id="password_confirmation" 
          style="width:100%; padding:0.5rem; border-radius:4px; margin-top:0.25rem;" 
          type="password" 
          name="password_confirmation" 
          required 
          autocomplete="new-password" 
        />
        <x-input-error :messages="$errors->get('password_confirmation')" style="color:#dc2626; font-size:0.875rem; margin-top:0.25rem;" />
      </div>

      <div style="display:flex; justify-content:space-between; align-items:center;">
        <a href="{{ route('login') }}" style="font-size:0.875rem; color:#3b82f6; text-decoration:underline;">
          {{ __('Already registered?') }}
        </a>

        <x-primary-button style="background-color:black; padding:0.5rem 1.5rem; font-weight:600; border-radius:4px; color:#fff;">
          {{ __('Register') }}
        </x-primary-button>
      </div>
    </form>
  </div>
</x-guest-layout>
