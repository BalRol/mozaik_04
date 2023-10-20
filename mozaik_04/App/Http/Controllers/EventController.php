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
            if ($request->hasCookie('event')) {
               $eventId = $request->cookie('event');
               $event_id = DB::table('event')->find($eventId);
               if($imageData == ""){
                    $imageData = $event_id->image;
               }
               $event_id = $event_id->id;
               DB::table("event")
                   ->where('id', $event_id)
                   ->update([
                       "name" => $nameInput,
                       "start_date" => $start_date,
                       "end_date" => $end_date,
                       "location" => $location,
                       "image" => $imageData,
                       "type" => $type,
                       "description" => $description,
                       "visibility" => $visibility,
                   ]);
           }

            else{
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
            }
            if($visibility === "Public"){
                $user =  DB::table("user")->get();
                foreach($user as $userTMP){
                    DB::table("userEvent")->insert([
                        "user_id" => $userTMP->id,
                        "event_id" => $event_id,
                    ]);
                }
            }else if($visibility === "Only me"){
                DB::table("userEvent")->insert([
                    "user_id" => $user->id,
                    "event_id" => $event_id,
                ]);
            }else if($visibility === "Limited"){
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
                    ->join('user', 'event.user_id', '=', 'user.id')
                    ->select('event.*', 'user.username', 'user.image as userImage')
                    ->get();

            // Most a $userEvents-höz hozzáadod a userEvent tábla is_interested oszlopát
            foreach ($userEvents as $event) {
                $isInterested = DB::table('userEvent')
                    ->where('user_id', $user->id)
                    ->where('event_id', $event->id)
                    ->value('is_interested');
                $event->is_interested = $isInterested;
            }
            return response()->json(["event" => $userEvents], 200);
        } else {
            return response()->json(["message" => 0], 500);
        }
    }

    public function myEvents(Request $request){
        if ($request->hasCookie('user')) {
            $userId = $request->cookie('user');
            $user = User::find($userId);

            $userEvents = DB::table('event')
                ->where('user_id', $user->id)
                ->join('user', 'event.user_id', '=', 'user.id')
                ->select('event.*', 'user.username', 'user.image as userImage')
                ->get();

            return response()->json(["userEvents" => $userEvents], 200);
        } else {
            return response()->json(["message" => 0], 500);
        }
    }

    public function interestEvents(Request $request){
        if ($request->hasCookie('user')) {
            $userId = $request->cookie('user');
            $user = User::find($userId);

            $interestedEvents = DB::table('event')
                ->join('userEvent', 'event.id', '=', 'userEvent.event_id')
                ->join('user', 'event.user_id', '=', 'user.id')
                ->where('userEvent.user_id', $user->id)
                ->where('userEvent.is_interested', 1)
                ->select('event.*', 'user.username', 'user.image as userImage')
                ->get();

            foreach ($interestedEvents as $event) {
                $isInterested = DB::table('userEvent')
                    ->where('user_id', $user->id)
                    ->where('event_id', $event->id)
                    ->value('is_interested');
                $event->is_interested = $isInterested;
            }
            return response()->json(["interestedEvents" => $interestedEvents], 200);
        } else {
            return response()->json(["message" => 0], 500);
        }
    }

    public function setEvent(Request $request){
        if ($request->hasCookie('user')) {
            $cookieValue = $request->eventId;
            $minutes = 60 * 12;
            Cookie::queue('event', $cookieValue, $minutes);
            return response()->json(["message" => 10], 200);
        } else {
            return response()->json(["message" => 0], 500);
        }
    }

    public function getEvent(Request $request){
        if ($request->hasCookie('event')) {
            $eventId = $request->cookie('event');
            $event = DB::table('event')->find($eventId);
            return response()->json(["message" => 10, "event" => $event], 200);
        }
        return response()->json(["message" => 0], 200);
    }

    public function delCookieEvent(Request $request){
        if ($request->hasCookie('event')) {
            setcookie('event', '', 1, '/');
            return response()->json(['success' => true]);
        }
        return response()->json(["message" => 0], 200);
    }

    public function delete(Request $request){
        if ($request->hasCookie('event')) {
            DB::table('event')->where('id', $request->cookie('event'))->delete();
        }else{
            DB::table('event')->where('id', $request->eventId)->delete();
        }
        return response()->json(["message" => 10], 200);
    }
}
