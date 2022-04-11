<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;


use App\User;
use App\Device;
use Validator;
use Hash;
use Auth;
use Mail;
use JWTAuth;

class AuthController extends Controller
{
    public function __construct(Request $request)
    {
        $this->middleware('auth:api', ['except' => ['login','register','socialLogin','sendOtp','verfiyOtp','updatePassword']]);    
    }
     /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    
    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'full_name' => ['bail','required', 'string', 'max:255'],
            'email' => 'required|email|max:255|regex:/(.*)\.com/i|unique:users,email',
            'password' => ['required', 'string', 'min:8', 'confirmed'],
           
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $user = new User();
        $user->name = $request['full_name'];
        $user->email = $request['email'];
        $user->timezone = $request['timezone'];
        $user->role = 'user';
        $user->password = Hash::make($request['password']);
        $status = $user->save();
        if ($status) {
            if ($request->fcm_token != null) {
                $data= Device::where('token',$request->fcm_token)->where('cat_id',null)
                    ->where('post_id',null)
                    ->where('video_id',null)
                    ->where('mass_id',null)->get();
                    if ($data == null) {
                        $d = Device::create([
                            'token' => $request->fcm_token,
                            'isview' => 'yes',
                        ]);
                    }else{
                        foreach ($data as $item) {
                            $item->update(['user_id' => $user->id]);
                        }
                    }
            }

            $token = JWTAuth::fromUser($user);
    
            return response()->json([
                'access_token' => $token,
                'token_type' => 'bearer',
                'expires_in' => auth('api')->factory()->getTTL() * 60*200,
                'message' => 'Registrated successfully.',
                'user' => $user,
                
            ], 201);
        }
        // $token = auth()->login($user);
        // return $this->respondWithToken($token);
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string|min:8',
        ]);

        if ($validator->fails()) {
            return response()->json(['error'=>'Invalid Email or Password'], 422);
        }

        if (! $token = JWTAuth::attempt($validator->validated())) {
            if ($request->fcm_token != null) {
                $data= Device::where('token',$request->fcm_token)->where('cat_id',null)
                    ->where('post_id',null)
                    ->where('video_id',null)
                    ->where('mass_id',null)->get();
                    if ($data == null) {
                        $d = Device::create([
                            'token' => $request->fcm_token,
                            'isview' => 'yes',
                        ]);
                    }else{
                        foreach ($data as $item) {
                            $item->update(['user_id' => auth()->user()->id]);
                        }
                    }
            }
            return response()->json(['error' => 'Invalid Email or Password'], 401);
        }

        return $this->respondWithToken($token);
    }

    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL() * 60*200,
            'message' => 'You have been successfully login to FSTV.',
            'user'=> auth()->user(),
        ]);
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function guard()
    {
        return Auth::guard();
    }

    public function socialLogin(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'nullable|string',
            'email' => 'nullable|email',
            'access_token' => 'required|string|unique:users,access_token',
        ]);
      	
        if($request->email != null){
            $euser = User::where('email',$request->email)->first();
            if($euser){
                if ($request->fcm_token != null) {
                    $data= Device::where('token',$request->fcm_token)->where('cat_id',null)
                    ->where('post_id',null)
                    ->where('video_id',null)
                    ->where('voter_id',null)
                    ->where('quiz_id',null)
                    ->where('mass_id',null)->get();
                    if ($data == null) {
                        $d = Device::create([
                            'token' => $request->fcm_token,
                            'isview' => 'yes',
                        ]);
                    }else{
                        foreach ($data as $item) {
                            $item->update(['user_id' => $euser->id]);
                        }
                    }
                }

            $token = JWTAuth::fromUser($euser);
                return response()->json([
                    'access_token' => $token,
                    'token_type' => 'bearer',
                    'expires_in' => auth('api')->factory()->getTTL() * 60*200,
                    'message' => 'Login Successfully.',
                    'user'=> $euser,
                ]);
            }
            
        }

        $user = User::where('access_token',$request->access_token)->first();
        if ($user == null) {
            $user = New User();
            $user->name = $request['name'];
            $user->email = $request['email'];
            $user->access_token = $request['access_token'];
            $user->role = 'user';
            $status = $user->save();
            if($status){
                if ($request->fcm_token != null) {
                    $data= Device::where('token',$request->fcm_token)->where('cat_id',null)
                    ->where('post_id',null)
                    ->where('video_id',null)
                    ->where('voter_id',null)
                    ->where('quiz_id',null)
                    ->where('mass_id',null)->get();
                    if ($data == null) {
                        $d = Device::create([
                            'token' => $request->fcm_token,
                            'isview' => 'yes',
                        ]);
                    }else{
                        foreach ($data as $item) {
                            $item->update(['user_id' => $user->id]);
                        }
                    }
                }

                $token = JWTAuth::fromUser($user);    
                return response()->json([
                    'access_token' => $token,
                    'token_type' => 'bearer',
                    'expires_in' => auth('api')->factory()->getTTL() * 60*200,
                    'message' => 'Login successfully.',
                    'user' => $user,
                    
                ], 201);
            }
            
        }else{
            if ($request->fcm_token != null) {
                $data= Device::where('token',$request->fcm_token)->where('cat_id',null)
                ->where('post_id',null)
                ->where('video_id',null)
                ->where('voter_id',null)
                ->where('quiz_id',null)
                ->where('mass_id',null)->get();
                if ($data == null) {
                    $d = Device::create([
                        'token' => $request->fcm_token,
                        'isview' => 'yes',
                    ]);
                }else{
                    foreach ($data as $item) {
                        $item->update(['user_id' => $user->id]);
                    }
                }
            }
            $token = JWTAuth::fromUser($user);
            return response()->json([
                'access_token' => $token,
                'token_type' => 'bearer',
                'expires_in' => auth('api')->factory()->getTTL() * 60*200,
                'message' => 'Login Successfully.',
                'user'=> $user,
            ]);
        }

    }

    public function sendOtp(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:users',
        ]);

        if ($validator->fails()) {
            return response()->json(['message'=> 'Enter valid Email address'], 422);
        }

        $otp = rand(100000, 999999);
       
        $user = User::whereEmail($request->email)->first();
        if ($user) {
            $user->update([
                'otp' => $otp,
            ]);
        }

        $email = $user->email;
        $data = array([
            'code'=> $user->otp,
            ]);
            
            // return response()->json(['s'=>$data]);
    //     Mail::send('otpmail', $data, function($message) use($email) {
    //        $message->to($email);
    //         $message->from('noreply@fstv.com','Firescreen Tv');
    //    });

        return response()->json([
            "user_id" => $user->id,
            "code"=> $user->otp,
            'message' => 'Verification code has been sent to your email address.',
        ]);
        
    }

    public function verfiyOtp(Request $request)
    { 
        $user = User::where('otp', $request->otp)->whereId($request->user_id)->first();
        // return response()->json(['a'=>$user]);
        if ($user == null) {
            return response()->json([
                'message'=>'Wrong verification code.',
            ],401);
        }

        $id=$user->id;
        return response()->json([
            'user_id'=>$id,
            'message'=>'OTP verified',
        ]);        
    }

    public function updatePassword(Request $request)
    {
        // return response()->json(['s'=>$request->password]);
        $validator = Validator::make($request->all(), [
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        if ($validator->fails()) {
            return response()->json('Password not match.', 422);
        }

        $user = User::where('id',$request->user_id)->first();
        if ($user == null) {
            return response()->json(['User not found.']);
        }else{
            $user->update([
                'password'=>Hash::make($request['password']),
                'otp' => '',
            ]);
        }
        return response()->json(['message'=>'Password changed successfully.']);
    }

}
