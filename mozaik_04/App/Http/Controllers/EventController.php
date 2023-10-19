<?php

namespace App\Http\Controllers;
use App\Models\UserEvent;
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

        if ($request->hasCookie('user')) {
            $userId = $request->cookie('user');
            $user = User::find($userId);
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageData = base64_encode(file_get_contents($image));
            }else{$imageData = "";}
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
            ]);
            $event_id = DB::getPdo()->lastInsertId();
            foreach ($names as $name) {
                $user =  DB::table("user")
                            ->where("username", $name)
                            ->first();
                if ($user) {
                    DB::table("userEvent")->insert([
                        "user_id" => $user->id,
                        "event_id" => $event_id,
                    ]);
                }
            }

            return response()->json(["message" => 10], 200);
        } else {
            return response()->json(["message" => 0], 500);
        }
    }

    public function index(Request $request)
    {
        if ($request->hasCookie('user')) {
            $userId = $request->cookie('user');
            $user = User::find($userId);

            $userEventsLimited = DB::table('userevent')
                ->where('user_id', $user->id)
                ->pluck('event_id');

            $userEventsOnlyMe = DB::table('event')
                ->where('user_id', $user->id)
                ->where('visibility', 'Only me')
                ->pluck('id');

            $userEventsPublic = DB::table('event')
                ->where('visibility', 'Public')
                ->pluck('id');

            $eventIds = $userEventsLimited
                ->concat($userEventsOnlyMe)
                ->concat($userEventsPublic);

            $userEvents = DB::table("event")
                    ->whereIn('event.id', $eventIds)
                    ->join('user', 'event.user_id', '=', 'user.id') // Join the user table
                    ->select('event.*', 'user.username', 'user.image as userImage') // Select the required columns
                    ->get();

            return response()->json(["event" => $userEvents], 200);
        } else {
            return response()->json(["message" => 0], 500);
        }
    }

}
