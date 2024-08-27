<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use Illuminate\Auth\Events\Registered;
use App\Providers\RouteServiceProvider;
use Illuminate\Validation\Rules\Password;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        // dd($request->all());
        // Validate the incoming request data
        $validatedData = $request->validate([
            'fname' => ['required', 'string', 'max:255'],
            'lname' => ['nullable', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            // 'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'dob' => ['required', 'date'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],

        ]);

        // Concatenate first name and last name
        $name = $validatedData['fname'] . ' ' . $validatedData['lname'];

        // $user = User::create([
        //     'name' => $name,
        //     'email' => $request->email,
        //     'password' => Hash::make($request->password),
        // ]);

        // Create a new user using the concatenated name and other validated data
        $user = User::create([
            'name' => $name,
            'email' => $validatedData['email'],
            'dob' => $validatedData['dob'],
            'password' => Hash::make($validatedData['password']),
        ]);

        $user->assignRole('member');

        // Extract first name and last name from the 'name' field
        // preg_match('/^(.*?)\s+(?:([^\s]+)\s*)?$/', $user->name, $matches);
        // $firstName = $matches[1];
        // $lastName = isset($matches[2]) ? $matches[2] : '';

        // Create member profile
        $user->profile()->create([
            'fname' => $validatedData['fname'],
            'lname' => $validatedData['lname'],
            'email' => $request->email,
            'dob' => $validatedData['dob'],
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}
