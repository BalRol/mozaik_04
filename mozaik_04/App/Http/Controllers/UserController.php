<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cookie;


class UserController extends Controller
{
    public function index(Request $request)
    {
        $email = $request->input("email");
        $pwd = $request->input("password");
        $user = User::where(function ($query) use ($email) {
            $query->where('username', $email)
                  ->orWhere('email', $email);
        })->first();
        if ($user && $pwd === $user->password) {
            $cookieValue = $user->id;
            $minutes = 60 * 12;

            // Sütiket létrehozása
            Cookie::queue('user', $cookieValue, $minutes);
            return response()->json(["message" => 10], 200);
        }

    }

    public function create(Request $request)
    {
        $name = $request->input("name");
        $email = $request->input("email");
        $pwd = $request->input("pwd");

        if ($name == "") {
            return response()->json(["message" => 1], 200);
        } elseif ($email == "") {
            return response()->json(["message" => 2], 200);
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return response()->json(["message" => 6], 200);
        } elseif (
            DB::table("user")
                ->where("username", $name)
                ->exists()
        ) {
            return response()->json(["message" => 7], 200);
        } elseif (
            DB::table("user")
                ->where("email", $email)
                ->exists()
        ) {
            return response()->json(["message" => 8], 200);
        } else {
            DB::table("user")->insert([
                "username" => $name,
                "email" => $email,
                "password" => $pwd,
            ]);
            return response()->json(["message" => 0], 200);
        }
    }

    public function logout()
    {
        setcookie('user', '', 1, '/');

        return response()->json(['success' => true]);
    }

    public function all(Request $request)
    {
        if ($request->hasCookie('user')) {
            $userId = $request->cookie('user');
            $users = User::whereNotIn('id', [$userId])->get();
            return response()->json(["users" => $users], 200);
        } else {
            return response()->json(["message" => 0], 500);
        }

    }

}
