<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{

    public function login(Request $request)
    {

        $request->validate([
            'phone' => 'required',
            'password' => 'required',
        ]);
     
        $user = User::where('phone', $request->phone)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'phone' => ['The provided credentials are incorrect.'],
            ]);
        }
        // return 'done';
        // header("Access-Control-Allow-Origin: *");
        return $user->createToken($user->user_type, ['user_type' => $user->user_type])->plainTextToken;
    }

    public function passwordUpdate(Request $request)
    {
        $fileds = $request->validate([
            'new_password' => 'required'
        ]);

        $request->user()->update([
            'password' => Hash::make($fileds['new_password'])
        ]);

        return response(['message'=>'تم تحديث كلمة المرور'],200);
    }

    public function logout()
    {
        auth()->user()->token()->delete();
        return response(['message'=>'تم تسجيل الخروج'],200);
    }
}
