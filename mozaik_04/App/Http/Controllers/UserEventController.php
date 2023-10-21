<?php

namespace App\Http\Controllers;
use App\Models\UserEvent;
use App\Models\Event;
use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cookie;

class UserEventController extends Controller
{
    public function update(Request $request)
    {
        if ($request->hasCookie("user")) {
            $userId = $request->cookie("user");
            $user = User::find($userId);
            $event_id = $request->eventId;
            DB::table("userEvent")
                ->where("user_id", $user->id)
                ->where("event_id", $event_id)
                ->update([
                    "is_interested" => DB::raw(
                        "CASE WHEN is_interested = 0 THEN 1 ELSE 0 END"
                    ),
                ]);
            return response()->json(["message" => $event_id], 200);
        } else {
            return response()->json(["message" => 0], 500);
        }
    }
}
