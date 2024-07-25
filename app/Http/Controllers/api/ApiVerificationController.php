<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Verified;
use Illuminate\Http\Request;
use App\Models\DataIbuHamil;

class ApiVerificationController extends Controller
{
    public function verify(Request $request, $id, $hash)
    {
        // Find the user by ID
        $user = DataIbuHamil::findOrFail($id);

        // Check if the user is already verified
        if ($user->hasVerifiedEmail()) {
            return response()->json([
                'status' => false,
                'message' => 'Email is already verified.'
            ], 400);
        }

        // Check if the hash matches
        if (!hash_equals((string) $hash, sha1($user->getEmailForVerification()))) {
            return response()->json([
                'status' => false,
                'message' => 'Invalid verification link.'
            ], 403);
        }

        // Mark the email as verified
        $user->markEmailAsVerified();

        // Trigger the Verified event
        event(new Verified($user));

        // Return success response
        return response()->json([
            'status' => true,
            'message' => 'Email verified successfully.'
        ], 200);
    }

    public function resend(Request $request)
    {
        // Check if the user is already verified
        if ($request->user()->hasVerifiedEmail()) {
            return response()->json([
                'status' => false,
                'message' => 'Email is already verified.'
            ], 400);
        }

        // Resend the email verification notification
        $request->user()->sendEmailVerificationNotification();

        // Return success response
        return response()->json([
            'status' => true,
            'message' => 'Verification link sent!'
        ], 200);
    }
}
