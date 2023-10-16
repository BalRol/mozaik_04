<?php

namespace App\Http\Controllers;
use App\Models\Event;
use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cookie;

class EventController extends Controller
{
    public function create(Request $request)
    {
        $nameInput = $request->input("nameInput");
        $start_date = $request->input("start_date");
        $end_date = $request->input("end_date");
        $location = $request->input("location");
        $type = $request->input("type");
        $visibility = $request->input("visibility");
        $description = $request->input("description");
        $userNames = $request->input("allowed_users");
        $names = explode(",", $userNames);
        $userIds = [];

        foreach ($names as $name) {
            $user =  DB::table("user")
                        ->where("username", $name)
                        ->first();
            if ($user) {
                $userIds[] = $user->id;
            }
        }

        $idString = implode(',', $userIds);

        if ($request->hasCookie('user')) {
            $userId = $request->cookie('user');
            $user = User::find($userId);
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageData = base64_encode(file_get_contents($image));
            }
            DB::table("event")->insert([
                            "user_id" => $user->id,
                            "name" => $nameInput,
                            "start_date" => $start_date,
                            "end_date" => $end_date,
                            "location" => $location,
                            "image" => $imageData,
                            "type" => $type,
                            "description" => $description,
                            "visibility" => $visibility,
                            "allowed_users" => $idString,
                        ]);


            return response()->json(["message" => 10], 200);
        } else {
            return response()->json(["message" => 0], 500);
        }
    }
}
