<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UsersController extends Controller
{
    public function create_user(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'email' => 'required|max:255|email|unique:users',
            'registration_number' => 'required|max:255|email|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);
        /**
         * if fails on validation
         */
        if ($validator->fails()) {
            return self::return_response('Invalid request for create cousellor', false, ['error' => $validator->errors()->all()], 0, 401);
        }
        try {
            /**
             * Create default data for user table
             */
            $userModelInsertObj = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'registration_number' => $request->registration_number,
                'password' => bcrypt($request->password),
            ]);
            if ($userModelInsertObj->id) {
                return self::return_response('User created successfully', true, [
                    'name' => $request->name,
                    'email' => $request->email,
                ], 0, 200);
            } else {
                return self::return_response('Error while created counsellor user', false, [], 0, 200);
            }
        } catch (\Exception $e) {
            return self::return_response('Exception occured', false, ['error' => $e->getMessage()], 0, 403);
        }
    }
}
