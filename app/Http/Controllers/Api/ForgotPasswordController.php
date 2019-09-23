<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Support\Facades\Password;
use App\User;

class ForgotPasswordController extends Controller
{
    use SendsPasswordResetEmails;

    public function __construct()
	{
		$this->middleware('guest');
	}

	public function __invoke(Request $request)
	{
		$this->validateEmail($request);

		if (User::where('email', $request->email)->count() != 1) {
			return response()->json(['message' => 'Email is not correct', 'status' => false]);
		}

		// We will send the password reset link to this user. Once we have attempted
		// to send the link, we will examine the response then see the message we
		// need to show to the user. Finally, we'll send out a proper response.
		$response = $this->broker()->sendResetLink(
			$request->only('email')
		);
		return $response == Password::RESET_LINK_SENT
			? response()->json(['message' => 'Reset link sent to your email.', 'status' => true], 201)
			: response()->json(['message' => 'Unable to send reset link', 'status' => false], 401);
	}
}
