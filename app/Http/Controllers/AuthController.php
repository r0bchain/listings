<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function create() 
    {

        return inertia('Auth/Login');
    }

    public function store(Request $request) 
    {
        if (!Auth::attempt(

            // Inertia middleware
            $request->validate([
                // 'username' => 'required|string',
                'email' => 'required|string|email',
                'password' => 'required|string'
            ])
        )) {
            // Only will trigger if it does not match with any user in the db.
            throw ValidationException::withMessages([
                'email' => 'Authentication failed.'
            ]);
            // return back()->withErrors([
            //     'email' => 'The provided credentials do not match our records.'
            // ]);
        }

        // ataque de fijación de sesión.
        /* security reasons, to avoid the session fixation attack, when a potential attacher might
        * trick your users into using a link with his session ID can be passed as a parameter to PHP and then 
        * when the user authenticates unknowingly by using someone else's session ID, then it gives the attacker
        * the access to the authenticated user unless that your regenerate the session straight after authenticating
        * then hithe attacker's session id is no longer valid anyway .
        */
        $request->session()->regenerate(); 

        // return redirect()->intended();

        return redirect()->intended('/listing');
       

    }

    public function destroy(Request $request) 
    {
        Auth::logout();

        $request->session()->invalidate();

        // Regenerate the CSRF token after logout
        $request->session()->regenerateToken();

        return redirect()->route('listing.index');

    }
}
