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
          $pwd_again = $request->input('pwd_again');

          if($name == ""){
              return response()->json(['message' => 1], 200);
          }elseif($email == ""){
              return response()->json(['message' => 2], 200);
          }elseif(!(filter_var($email, FILTER_VALIDATE_EMAIL))){
              return response()->json(['message' => 6], 200);
          }elseif($pwd == ""){
              return response()->json(['message' => 3], 200);
          }elseif($pwd_again == ""){
              return response()->json(['message' => 4], 200);
          }elseif($pwd_again != $pwd){
              return response()->json(['message' => 5], 200);
          }elseif($pwd == $pwd_again){
              DB::table('user')->insert([
                  'username' => $name,
                  'email' => $email,
                  'password' => bcrypt($pwd),
              ]);
              return response()->json(['message' => 0], 200);
          }

      }
}
