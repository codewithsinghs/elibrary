<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class CheckToken
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    // public function handle(Request $request, Closure $next): Response
    // {
    //     return $next($request);
    // }

    public function handle($request, Closure $next)
    {
        //     dd("CheckToken middleware executed"); // Debugging statement
        // dd(Session::get('token')); // Check if the token is present
        // Check if the token exists in the session
        if (!Session::has('token')) {
            // Get the intended URL from the request
            $intendedUrl = $request->fullUrl();

            // Store the intended URL in the session
            Session::put('url.intended', $intendedUrl);
            Auth::logout();

            // Redirect to the login page with the intended URL as a query parameter
            return redirect('/login')->with('error', 'Unauthorized access! Host has Access Denied.');
        }

        // Retrieve the token from the session
        $token = Session::get('token');
         //dd($token);

        // Validate the token
        try {
            // Check if the token has expired
            if ($this->isTokenExpired($token)) {
                // Token has expired, attempt to refresh it
                $refreshedToken = $this->refreshToken($token);

                // Update the session with the refreshed token
                Session::put('token', $refreshedToken);
            }
        } catch (\Exception $e) {
            // Token validation or refreshing failed
            return redirect('/login')->with('error', $e->getMessage());
        }

        return $next($request);
    }

    private function isTokenExpired($token)
    {
        try {
            // Decode the token to extract the expiration time
            $decodedToken = json_decode(base64_decode(explode('.', $token)[1]), true);

            // Check if the expiration time is in the past using Carbon
            return Carbon::now()->timestamp > $decodedToken['exp'];
        } catch (\Exception $e) {
            // Handle decoding errors or invalid tokens
            return true; // Consider the token as expired in case of errors
        }
    }

    private function refreshToken($token)
    {
        try {
            // Call the refresh endpoint in Project 1
            $response = Http::post('http://127.0.0.1:8002/api/auth/refresh', [
                'token' => $token,
            ]);

            // Parse the JSON response
            $data = $response->json();

            if (isset($data['access_token'])) {
                return $data['access_token'];
            } else {
                // Handle the case where the refresh token request failed
                throw new \Exception('Token refresh failed');
            }
        } catch (\Exception $e) {
            // Log the error or take appropriate action
            // In this example, I'm rethrowing the exception for simplicity
            throw $e;
        }
    }
}
