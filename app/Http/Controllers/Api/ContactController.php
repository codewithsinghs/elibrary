<?php

namespace App\Http\Controllers\Api;

use App\Models\Contact;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{

    // public function store(Request $request)
    // {
    //      // Validate the request using the validate() method
    //      $validatedData = $request->validate([
    //         'fname' => 'required|string|max:255',
    //         'lname' => 'required|string|max:255',
    //         'email' => 'required|email|max:255',
    //         'phone' => 'nullable|phone|max:255',
    //         'subject' => 'nullable|string|min:255',
    //         'message' => 'nullable|string|min:255',
    //     ]);

    //     // Check if validation fails
    //      // If validation fails, return an error response
    //     //  if ($validator->fails()) {
    //     //     return response()->json([
    //     //         'success' => false,
    //     //         'errors' => $validator->errors(),
    //     //     ], 422);
    //     // }

    //     // Create a new contact entry
    //     $contact = Contact::create([
    //         'fname' => $validatedData['fname'],
    //         'lname' => $validatedData['lname'],
    //         'email' => $validatedData['fname'],
    //         'phone' => $validatedData['phone'],
    //         'subject' => $validatedData['subject'],
    //         'message' => $validatedData['message']
    //     ]);

    //     // Respond with success
    //     return response()->json([
    //         'success' => true,
    //         'message' => 'Contact data stored successfully',
    //         'data' => $contact
    //     ], 201);
    // }

    // public function store(Request $request)
    // {
    //     // Validate the request using the validate() method
    //     $validatedData = $request->validate([
    //         'fname' => 'required|string|max:255',
    //         'lname' => 'required|string|max:255',
    //         'email' => 'required|email|max:255',
    //         'phone' => 'nullable|email|max:255',
    //         'subject' => 'nullable|email|max:255',
    //         'message' => 'required|string|min:10',
    //     ]);

    //     // Process the validated data
    //     // Save data, send response, etc.

    //     return response()->json(['message' => 'Contact message sent successfully!']);
    // }

    public function store(Request $request)
    {
        // Validate the incoming request
        $validator = Validator::make($request->all(), [
            'fname' => 'required|string|max:255',
            'lname' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|regex:/^[0-9]{10}$/', // 10-digit phone number
            'subject' => 'nullable|string|max:255',
            'message' => 'nullable|string|min:10',
        ]);

        // If validation fails, return an error response
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors(),
            ], 422);
        }

        // Store the data in the contacts table
        $contact = Contact::create([
            'name' => $request->name,
            'email' => $request->email,
            'message' => $request->message,
        ]);

        // Return a success response
        return response()->json([
            'success' => true,
            'message' => "'Hey! We have recieved you message successfully'",
            'data' => $contact,
        ], 201);
    }
}
