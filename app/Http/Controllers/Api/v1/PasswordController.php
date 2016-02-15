<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Api\ApiController;
use Illuminate\Http\Request;

class PasswordController extends ApiController
{
    public function reset(Request $request)
    {
        $credentials = $request->only('email', 'password', 'password_confirmation', 'token');

        $validator = \Validator::make($credentials, [
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed|min:6',
        ]);

        if ($validator->fails()) {
            return $this->respondWithError('Validation fails', [
                'error' => [
                    'fields' => $validator->errors()
                ]
            ]);
        }

        $response = \Password::reset($credentials, function ($user, $password) {
            $this->resetPassword($user, $password);
        });

        switch ($response) {
            case \Password::PASSWORD_RESET:
                return $this->respond(['message' => 'Password changed.']);

            default:
                return $this->respondWithError('Something went wrong');
        }
    }

    /**
     * Reset the given user's password.
     *
     * @param  \Illuminate\Contracts\Auth\CanResetPassword  $user
     * @param  string  $password
     * @return void
     */
    protected function resetPassword($user, $password)
    {
        $user->password = $password;
        $user->save();
    }
}
