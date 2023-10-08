<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

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

          $user = new User;
          $user->name = $name;
          $user->email = $email;
          $user->pwd = $pwd;
          if($pwd == $pwd_again){
              $user->save();
              return response()->json(['message' => 'Sikeres'], 200);
          }
          else{
             return response()->json(['message' => 'Sikertelen'], 500);
          }

      }
}
