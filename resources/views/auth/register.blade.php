<!DOCTYPE html>
<html lang="en">

    <head>
        <title>DOST XI - SIMS</title>
        <meta charset="UTF-8">
        <link rel="icon" href="\icons\DOSTLOGOsmall.png" type="image/x-icon" />
        <meta content="width=device-width, initial-scale=1.0" name="viewport">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <title>Document</title>
    </head>

    <body class="toggle-sidebar">
        <main id="main">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="container-fluid ">
                <div class="">
                    <div class="row justify-content-center">
                        <div class="col-4">
                            <div class="card">
                                <div class="card-body">
                                    <form method="post" action="{{ route('register') }}">
                                        @csrf

                                        <!-- Role -->
                                        <div class="mt-4">
                                            <label for="role" :value="__('Email')">Role:</label>
                                            <input id="role" class="block mt-1 w-full form-control form-control-sm" type="text" name="role" :value="old('role')" required autocomplete="username" />
                                        </div>

                                        <!-- Email Address -->
                                        <div class="mt-4">
                                            <label for="email" :value="__('Email')">Email:</label>
                                            <input id="email" class="block mt-1 w-full form-control form-control-sm" type="email" name="email" :value="old('email')" required autocomplete="username" />

                                        </div>

                                        <!-- Password -->
                                        <div class="mt-4">
                                            <label for="password" :value="__('Password')">Password: </label>
                                            <input id="password" class="block mt-1 w-full form-control form-control-sm" type="password" name="password" required autocomplete="new-password" />
                                        </div>

                                        <!-- Confirm Password -->
                                        <div class="mt-4">
                                            <label for="password_confirmation" :value="__('Confirm Password')">Confirm Password: </label>
                                            <input id="password_confirmation" class="block mt-1 w-full form-control form-control-sm" type="password" name="password_confirmation" required autocomplete="new-password" />

                                        </div>

                                        <div class="flex items-center justify-end mt-4">
                                            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                                                {{ __('Already registered?') }}
                                            </a>

                                            <button type="submit" class="btn btn-primary ml-4">
                                                {{ __('Register') }}
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
        </main>
        <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
        <script src="{{ asset('js/app.js') }}"></script>
    </body>

</html>
