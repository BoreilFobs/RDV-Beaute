<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log; // Don't forget to import the Log facade!

class FcmTokenController extends Controller
{
    public function store(Request $request)
    {
        try {
            $request->validate([
                'fcm_token' => 'required|string',
            ]);

            $user = Auth::user();

            if (!$user) {
                // Log unauthorized attempts (optional, but good for security monitoring)
                Log::warning('FCM Token Save Attempt: Unauthorized user tried to save token.', [
                    'ip_address' => $request->ip(),
                    'user_agent' => $request->header('User-Agent'),
                ]);
                return response()->json(['error' => 'Unauthorized'], 401);
            }

            $user->fcm_token = $request->fcm_token;
            $user->save();

            // Log successful token saves (optional, but good for tracking)
            Log::info('FCM Token Save Success: Token saved for user.', [
                'user_id' => $user->id,
                'fcm_token_prefix' => substr($request->fcm_token, 0, 20) . '...' // Log only a portion for security
            ]);

            return response()->json(['message' => 'FCM token saved successfully.'], 200);

        } catch (\Illuminate\Validation\ValidationException $e) {
            // Log validation failures
            Log::error('FCM Token Save Error: Validation failed.', [
                'user_id' => Auth::id(), // Log user ID if available
                'errors' => $e->errors(),
                'request_data' => $request->all(),
                'ip_address' => $request->ip(),
            ]);

            return response()->json([
                'error' => 'Validation failed',
                'messages' => $e->errors(),
            ], 422);

        } catch (\Exception $e) {
            // THIS IS THE CRITICAL PART FOR INTERNAL SERVER ERRORS
            Log::critical('FCM Token Save Fatal Error: Unhandled exception occurred.', [
                'user_id' => Auth::id(), // Log user ID if available
                'exception' => [
                    'message' => $e->getMessage(),
                    'code' => $e->getCode(),
                    'file' => $e->getFile(),
                    'line' => $e->getLine(),
                    'trace' => $e->getTraceAsString(), // Full stack trace
                ],
                'request_data' => $request->all(), // Log the request payload
                'ip_address' => $request->ip(),
                'user_agent' => $request->header('User-Agent'),
            ]);

            return response()->json([
                'error' => 'Something went wrong',
                'message' => 'An unexpected error occurred. Please try again later.', // Generic message for client
            ], 500);
        }
    }
}