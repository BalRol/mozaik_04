<?php

namespace App\Http\Controllers;
use App\Models\Event;

use Illuminate\Http\Request;

class EventController extends Controller
{
   public function create(Request $request)
   {
       $name = $request->input('name');
       $email = $request->input('email');
       $pwd = $request->input('pwd');
       $pwd_again = $request->input('pwd_again');

       $event = new Event;
       $event->name = $name;
       $event->email = $email;
       $event->pwd = $pwd;
       $event->save();

       return response()->json(['message' => 'Sikeres'], 200);
   }
}
