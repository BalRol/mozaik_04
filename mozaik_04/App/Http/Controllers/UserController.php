<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
   public function index(Request $request) {

   }

   public function create(Request $request)
      {
          $name = $request->input('name');
          $email = $request->input('email');
          $pwd = $request->input('pwd');

          if($name == ""){
              return response()->json(['message' => 1], 200);
          }elseif($email == ""){
              return response()->json(['message' => 2], 200);
          }elseif(!(filter_var($email, FILTER_VALIDATE_EMAIL))){
              return response()->json(['message' => 6], 200);
          }elseif(DB::table('user')->where('username', $name)->exists()){
              return response()->json(['message' => 7], 200);
          }elseif(DB::table('user')->where('email', $email)->exists()){
              return response()->json(['message' => 8], 200);
          }
          else{
              DB::table('user')->insert([
                  'username' => $name,
                  'email' => $email,
                  'password' => bcrypt($pwd),
              ]);
              return response()->json(['message' => 0], 200);
          }

      }
}
