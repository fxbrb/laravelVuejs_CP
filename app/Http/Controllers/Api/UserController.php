<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function get_users(){
        $users = User::all();

        return response()->json([
            'users' => $users,
        ], 200);
    }
}
