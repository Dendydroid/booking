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

    public function evict ($id)
    {
        $booking = \App\Booking::where('id',$id)->first();


        if(!($booking instanceof Booking)){
            abort(400);
        }


        $booking->active = 0;

        $booking->save();


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
            'number' => 'alpha_num|required|max:255',
            'client_id' => 'required|numeric',
            'fromto' => 'required',
        ]);


        $bookingData = (object) $request->all();

        $fromTo = explode(',', $bookingData->fromto);

        if(!isset($fromTo[1])){
            $fromTo[1] = $fromTo[0];
        }
        
        $from = new \DateTime($fromTo[0]);

        $to = new \DateTime($fromTo[1]);

        $bookings = \App\Booking::all();

        foreach ($bookings->toArray() as $key => $booking) {
            if($booking['active'] == 1 && $booking['room_number'] === $bookingData->number){
                $start = new \DateTime($booking['night_start']);
                $end = new \DateTime($booking['night_end']);
                if($start <= $to && $end >= $from){
                    $request->session()->put('taken', 'Дати у вказаному дiапазонi зайнятi для вказаного номера');
                    return back();
                }
            }
        }

        $room = Room::where("number", $bookingData->number)->first();

        if(!($room instanceof Room)){
            return abort(400);
        }
        $room->client_occupied_id = $bookingData->client_id;
        $room->status = self::OCCUPIED_STATUS;

        $room->save();

        $booking = new Booking();
        $booking->room_number = $bookingData->number;
        $booking->client_id = $bookingData->client_id;
        $booking->night_start = $fromTo[0];
        $booking->night_end = $fromTo[1];
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
