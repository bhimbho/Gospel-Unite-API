<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\ForgotPasswordRequest;
use App\Http\Requests\Api\ResetPasswordRequest;
use App\Http\Requests\Api\UserRegistrationRequest;
use App\Models\User;
use Exception;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Twilio\Rest\Client;
use App\Traits\RequestInputValidator;
class AuthController extends Controller
{
    use SendsPasswordResetEmails, RequestInputValidator;
    // use ResetsPasswords;
    /**
     * user login fuction.
     *
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        $generatedNumber = $this->generateAuthenticationCode();
        if (Auth::guard('users')->attempt($request->only('email', 'password'))) {
            //Authentication passed...
            $user = User::find(Auth::guard('users')->user()->id);

            $token = $user->createToken('Laravel Password Grant Client')->accessToken;
            // check if account already active
            if($user->status == 0){
                try {
                    $this->sendMessage("Gospel Unites user confirmation code: " . $generatedNumber, $user->phone);
                } catch (\Exception $th) {
                    return response()->json("Unable to send sms. Retry", 404);
                }

            }

            return response()->json([
                'status' => 201,
                'message' => 'login successful',
                'user' => $user,
                'token' => $token,
            ]);
        }

        return response()->json([
            'message' => 'The provided credentials do not match our records.',
            'status' => 401,
        ], 401);

    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function register(UserRegistrationRequest $request)
    {

        // authentication code sent to sms
        $generatedNumber = $this->generateAuthenticationCode();
        $validPhoneNo = $this->filterPhoneNumber($request->phone_code, $request->phone);

        $user = User::create([
            'fullname' => $request->fullname,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'phone' => $validPhoneNo,
            'gender' => $request->gender,
            'nationality' => $request->nationality,
            'authentication_code' => $generatedNumber,
            'device_id' => $request->device_id
        ]);

             $this->sendMessage("Gospel Unites user confirmation code: " . $generatedNumber, $validPhoneNo);
            try {

            } catch (\Throwable $th) {
                //throw $th;
                $this->sendMessage("Gospel Unites user confirmation code: " . $generatedNumber, $validPhoneNo);
            } catch (Exception $th) {
                return response()->json("Unable to send sms. Retry", 404);
            }
            $token = $user->createToken('Laravel Password Grant Client')->accessToken;
            return response()->json([
                'message' => 'Registration Successful',
                'status' => 201,
                'user' => $user,
                'token' => $token,
            ]);


    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function forgot(ForgotPasswordRequest $request)
    {
        $status = Password::broker('users')->sendResetLink(
            $request->only('email')
        );
        return $status === Password::RESET_LINK_SENT
        ? response()->json(['status' => __($status)])
        : response()->json(['email' => __($status)]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function showResetForm(Request $request)
    {
        $token = $request->route()->parameter('token');
        $email = $request->route()->parameter('email');
        return view('auth.users.reset')->with(['token' => $token, 'email' => $email]);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function resetPassword(ResetPasswordRequest $request)
    {

        $status = Password::broker('users')->reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) use ($request) {
                $user->forceFill([
                    'password' => Hash::make($password),
                ])->setRememberToken(Str::random(60));

                $user->save();

                event(new PasswordReset($user));
            }
        );

        return $status == Password::PASSWORD_RESET
        ? view('auth.users.reset')->with('message', 'Account Password has been reset')
        : view('auth.users.reset')->with('invalid', __($status));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Destroy All User Token.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {

        $request->user()->token()->revoke();

        return response()->json([
            'message' => 'You have been logged out successfully',
            'status' => 201,
        ], 201);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    // public function broker()
    // {
    //    return Password::broker('users');
    // }
    private function sendMessage($message, $recipients)
    {
        $account_sid = getenv("TWILIO_SID");
        $auth_token = getenv("TWILIO_AUTH_TOKEN");
        $twilio_number = getenv("TWILIO_NUMBER");
        $client = new Client($account_sid, $auth_token);
        $client->messages->create($recipients,
            ['from' => $twilio_number, 'body' => $message]);
    }

    private function generateAuthenticationCode()
    {
        $number = rand(0, 123456789);
        return substr($number, 0, 6);
    }

    public function confirmAuthCode(Request $request)
    {
        $user = User::where(['id' => $request->user_id, 'authentication_code' => $request->auth_code])->first();
         if ($user) {
            $user->status = 1; //update status
            $user->save();
            return response()->json([
                'status' => 200,
                'message' => 'User confirmed',
            ], 200);
        }
        return response()->json([
            'status' => 401,
            'message' => 'User not confirmed',
        ], 401);
    }


        public function confirmUserForPasswordReset(Request $request)
        {
            $user = User::whereEmail($request->email)->first();
            $generatedNumber = $this->generateAuthenticationCode();

            if($user){
                 try {

                $user->authentication_code = $generatedNumber;
                $user->save();
                $this->sendMessage("Gospel Unites password reset confirmation code: " . $generatedNumber, $user->phone);
                } catch (\Throwable $th) {
                    //throw $th;
                }

                return response()->json([
                'message' => 'User Confirm',
                'status' => 201,
                'userId' => $user->id
                   ], 200);
            }
             return response()->json([
                'message' => 'User not Confirm',
                'status' => 401,
                'userId' => ''
                   ], 400);

        }


        public function resetPasswordWithoutToken(Request $request)
        {
             $user = User::find($request->id);
             if($user){
                  $user->password = Hash::make($request->password);
                  $user->save();
                  return response()->json([
                    'message' => 'Password Change',
                    'status' => 201,
                    'userId' => $user->id
                       ], 200);
             }
             return response()->json([
                    'message' => 'Password not changed',
                    'status' => 400,
                    'userId' => $user->id
                       ], 400);

        }
}
