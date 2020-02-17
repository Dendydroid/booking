<?php

namespace App\Http\Controllers;

use App\Booking;
use App\Client;
use App\Room;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function rooms()
    {
        return view('rooms');
    }

    public function booking()
    {
        return view('booking');
    }

    public function clients()
    {
        return view('clients');
    }

    public function statistics()
    {
        return view('statistics');
    }

    public function addRoom()
    {
        return view('add_room');
    }

    public function editRoom($id)
    {
        $room = Room::where('id', $id)->first();
        if($room instanceof Room){
            return view('edit_room')->with(["room" => $room]);
        }
        return back();
    }

    public function manageRooms()
    {
        $rooms = Room::all();
        return view('manage_rooms')->with([
            "rooms" => $rooms
        ]);
    }

    public function addBooking()
    {
        $rooms = Room::all();
        $clients = Client::all();
        return view('add_booking')->with([
            "rooms" => $rooms,
            "clients" => $clients
        ]);
    }

    public function manageBookings()
    {
        $bookings = Booking::all();
        return view('manage_bookings')->with([
            "bookings" => $bookings
        ]);
    }

    public function manageClients()
    {
        $clients = Client::all();
        return view('manage_clients')->with([
            "clients" => $clients
        ]);
    }

    public function addClient()
    {
        return view('add_client');
    }
}
