<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <link rel="icon" href="\icons\DOSTLOGOsmall.png" type="image/x-icon" />
        <meta content="width=device-width, initial-scale=1.0" name="viewport">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <title>Document</title>
    </head>

    <body>
        <main>
            <div class="container">
                <div>
                    <div class="card">
                        <div class="card-body">
                            <form method="POST" action="{{ route('register') }}">
                                @csrf

                                <!-- Name -->
                                <div>
                                    <label for="name" :value="__('Name')">Name: </label>
                                    <input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <!-- Email Address -->
                                <div class="mt-4">
                                    <label for="email" :value="__('Email')">Email:</label>
                                    <input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
                                    {{--   <x-input-error :messages="$errors->get('email')" class="mt-2" /> --}}
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <!-- Password -->
                                <div class="mt-4">
                                    <label for="password" :value="__('Password')">Password: </label>
                                    <input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    {{--   <x-input-error :messages="$errors->get('password')" class="mt-2" /> --}}
                                </div>

                                <!-- Confirm Password -->
                                <div class="mt-4">
                                    <label for="password_confirmation" :value="__('Confirm Password')">Confirm Password: </label>
                                    <input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
                                    @error('password_confirmation')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="flex items-center justify-end mt-4">
                                    <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                                        {{ __('Already registered?') }}
                                    </a>

                                    <button class="btn btn-primary ml-4">
                                        {{ __('Register') }}
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
        </main>
        <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
        <script src="{{ asset('js/app.js') }}"></script>
    </body>

</html>
