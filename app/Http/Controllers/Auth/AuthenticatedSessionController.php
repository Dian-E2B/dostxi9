<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;


class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */



    public function create()
    {/*
        if (Auth::check()) {
            // Redirect to the dashboard if the user is already logged in
            return redirect('/dashboard');
        } */
        if (Auth::guard('student')->check()) {
            // Redirect to the student dashboard if the user is already logged in as a student
            return redirect('student/profile');
        } elseif (Auth::guard('web')->check()) {
            return redirect('/dashboard');
        }
        // Otherwise, show the login page
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();
        $role = $request->user()->role;
        switch ($role) {
            case 'admin':
                return redirect(route('dashboardadmin'));
                break;
            case 'staff':
                return redirect()->intended(RouteServiceProvider::HOME);
                break;
        }
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        //MODIFIED
        header('Cache-Control: no-store, no-cache, must-revalidate');
        header('Pragma: no-cache');
        header('Expires: 0');

        return redirect('/login');
    }
}
