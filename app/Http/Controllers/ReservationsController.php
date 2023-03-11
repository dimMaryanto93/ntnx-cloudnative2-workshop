<?php
namespace App\Http\Controllers;
use App\Client as Client;
use App\Room as Room;
use App\Reservation as Reservation;
use Carbon\Carbon;
use GuzzleHttp\Client as Api;
use GuzzleHttp\Exception\RequestException;

use Illuminate\Http\Request;

class ReservationsController extends Controller
{
    //
    public function bookRoom($client_id, $room_id, $date_in, $date_out)
    {
        $reservation = new Reservation();
        $client_instance = new Client();
        $room_instance = new Room();

        $client = $client_instance->find($client_id);
        $room = $room_instance->find($room_id);

        /*
        $api = new api();
        $request = $api->get('http://192.168.3.201:9999/api/api_view/' . $client_id );
        $response = $request->getBody()->getContents();
        $client = json_decode($response);

        $api = new api();
        $request = $api->get('http://192.168.3.201:9999/api/api_view/' . $room_id );
        $response = $request->getBody()->getContents();
        $room = json_decode($response);
        */

        $reservation->date_in = $date_in;
        $reservation->date_out = $date_out;

        $reservation->room()->associate($room);
        $reservation->client()->associate($client);
        if( $room_instance->isRoomBooked( $room_id, $date_in, $date_out ) )
        {
            abort(405, 'Trying to book an already booked room');
        }
        $reservation->save();
        
        /*
        $api = new api();
        $request = $api->get('http://192.168.3.201:9999/api/api_book/room/' . $client_id .'/'. $room_id .'/'. $date_in .'/'. $date_out);
        $response = $request->getBody()->getContents();
        */

        return redirect()->route('clients');
        //return view('reservations/bookRoom');
    }

    public function api_bookRoom($client_id, $room_id, $date_in, $date_out)
    {
        $reservation = new Reservation();
        $client_instance = new Client();
        $room_instance = new Room();

        $client = $client_instance->find($client_id);
        $room = $room_instance->find($room_id);
        $reservation->date_in = $date_in;
        $reservation->date_out = $date_out;

        $reservation->room()->associate($room);
        $reservation->client()->associate($client);
        if( $room_instance->isRoomBooked( $room_id, $date_in, $date_out ) )
        {
            abort(405, 'Trying to book an already booked room');
        }
        $reservation->save();

        //return redirect()->route('clients');
        //return view('reservations/bookRoom');
    }
}
