<?php

namespace App\Http\Controllers;

use App\Booking;
use App\Client;
use App\Room;
use Illuminate\Http\Request;

/**
 * Class ManagementController
 * @package App\Http\Controllers
 */
class ManagementController extends Controller
{

    private const DEFAULT_STATUS = "free";
    private const OCCUPIED_STATUS = "occupied";
    private const DEFAULT_ACTIVE = 1;

    public function addRoom(Request $request)
    {
        $request->validate([
            'number' => 'alpha_num|required|unique:rooms|max:255',
            'price' => 'required|numeric',
            'stars' => 'required|numeric|min:0|max:5',
        ]);

        $roomData = (object) $request->all();

        $isConf = isset($roomData->is_conf) ? 1 : 0;

        $room = new Room();
        $room->status = self::DEFAULT_STATUS;
        $room->number = $roomData->number;
        $room->price = (double)$roomData->price;
        $room->stars = (double)$roomData->stars;
        $room->type = $isConf;
        $room->save();
        return redirect(route('rooms'));
    }

    public function editRoom(Request $request)
    {
        $id = (int) $request->all()["id"];
        $room = Room::where("id", $id)->first();

        if(!($room instanceof Room)){
            abort(400);
        }
        $request->validate([
            'number' => "alpha_num|required|unique:rooms,number,$id|max:255",
            'price' => 'required|numeric',
            'stars' => 'required|numeric|min:0|max:5',
        ]);

        $roomData = (object) $request->all();

        $isConf = isset($roomData->is_conf) ? 1 : 0;
        $room->status = self::DEFAULT_STATUS;
        $room->number = $roomData->number;
        $room->price = (double)$roomData->price;
        $room->stars = (double)$roomData->stars;
        $room->type = $isConf;
        $room->save();
        return redirect(route('rooms'));
    }

    public function deleteRoom(Request $request)
    {
        //@TODO Implement
    }

    public function evict ($number)
    {
        $booking = \App\Booking::where([
            ['room_number',"=",$number],
            ['active',"=",1],
        ])->first();

        $room = Room::where("number", $number)->first();

        if(!($booking instanceof Booking) || !($room instanceof Room)){
            abort(400);
        }

        $room->status = self::DEFAULT_STATUS;

        $booking->active = 0;

        $booking->save();

        $room->save();

        return back();
    }

    public function blacklist($id)
    {
        $client = Client::where('id',$id)->first();

        if(!($client instanceof Client)){
            abort(400);
        }

        $client->is_black_listed = 1;

        $client->save();

        return back();
    }

    public function deBlacklist($id)
    {
        $client = Client::where('id',$id)->first();

        if(!($client instanceof Client)){
            abort(400);
        }

        $client->is_black_listed = 0;

        $client->save();

        return back();
    }

    public function addBooking(Request $request)
    {
        $request->validate([
            'number' => 'alpha_num|required|unique:bookings,room_number|max:255',
            'client_id' => 'required|numeric',
            'nights' => 'required|numeric|min:1',
        ]);


        $bookingData = (object) $request->all();

        $room = Room::where("number", $bookingData->number)->first();

        if(!($room instanceof Room)){
            abort(400);
        }
        $room->client_occupied_id = $bookingData->client_id;
        $room->status = self::OCCUPIED_STATUS;

        $room->save();

        $booking = new Booking();
        $booking->room_number = $bookingData->number;
        $booking->client_id = $bookingData->client_id;
        $booking->nights = (double)$bookingData->nights;
        $booking->active = self::DEFAULT_ACTIVE;
        $booking->save();
        return redirect(route('booking'));
    }

    public function addClient(Request $request)
    {
        $request->validate([
            'name' => 'alpha|max:255',
            'phone' => 'required|unique:clients|max:255',
        ]);

        $clientData = (object) $request->all();

        $client = new Client();
        $client->name = $clientData->name;
        $client->phone = $clientData->phone;
        $client->save();
        return redirect(route('clients'));
    }
}
