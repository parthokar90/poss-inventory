@extends('layouts.app')
@section('title') Inventory | Login @endsection

@section('content')
<form method="POST" action="{{ route('login') }}">
    @csrf

    <div class="text-center text-gray-400 mb-6 font-medium text-sm tracking-wide">
        Sign in to start your session
    </div>

    <div class="mb-5">
        <div class="relative flex items-center border-b-2 border-gray-200 focus-within:border-blue-600 transition-colors duration-200">
            <span class="absolute left-0 text-gray-400">
                <i class="material-icons text-xl">email</i>
            </span>
            <input type="text"
                class="w-full pl-8 pr-3 py-2 bg-transparent outline-none text-gray-700 placeholder-gray-400 @error('email') border-red-500 @enderror"
                name="email"
                placeholder="Email"
                value="{{ old('email', 'admin@email.com') }}"
                required autofocus>
        </div>

        @error('email')
        <p class="text-red-500 text-xs italic mt-1.5" role="alert">
            <strong>{{ $message }}</strong>
        </p>
        @enderror
    </div>

    <div class="mb-6">
        <div class="relative flex items-center border-b-2 border-gray-200 focus-within:border-blue-600 transition-colors duration-200">
            <span class="absolute left-0 text-gray-400">
                <i class="material-icons text-xl">lock</i>
            </span>
            <input type="password"
                class="w-full pl-8 pr-3 py-2 bg-transparent outline-none text-gray-700 placeholder-gray-400 @error('password') border-red-500 @enderror"
                name="password"
                placeholder="Password"
                value="12345678"
                required>
        </div>

        @error('password')
        <p class="text-red-500 text-xs italic mt-1.5" role="alert">
            <strong>{{ $message }}</strong>
        </p>
        @enderror
    </div>

    <div class="flex items-center justify-between gap-4">
        <div class="flex items-center">
            <input type="checkbox" name="remember" id="remember"
                class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500 checked:bg-blue-600 cursor-pointer">
            <label for="remember" class="ml-2 text-sm font-medium text-gray-500 select-none cursor-pointer hover:text-blue-600 transition-colors">
                Remember Me
            </label>
        </div>

        <div>
            <button class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-6 rounded shadow-md hover:shadow-lg active:bg-blue-800 transition duration-150 ease-in-out uppercase text-sm tracking-wider"
                type="submit">
                SIGN IN
            </button>
        </div>
    </div>

</form>
@endsection