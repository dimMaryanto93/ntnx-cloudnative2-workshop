<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Client;
use App\Room;
use Carbon\Carbon;
use GuzzleHttp\Client as Api;
use GuzzleHttp\Exception\RequestException;

class RoomsController extends Controller
{
    //
    public function checkAvailableRooms($client_id, Request $request)
    {
      $dateFrom = Carbon::parse($request->input('dateFrom'))->format('Y-m-d');
      $dateTo = Carbon::parse($request->input('dateTo'))->format('Y-m-d');
      $client = new Client();
      $room = new Room();

      $data = [];
      $data['dateFrom'] = $dateFrom;
      $data['dateTo'] = $dateTo;
      /*
      $api = new api();
      $request = $api->get('http://192.168.1.126:8888/api/api_view/' . $client_id );
      $response = $request->getBody()->getContents();
      $data['client'] = json_decode($response);
      //dd($data);
      */
      $data['client'] = $client->find($client_id);
      /*
      $api = new api();
      $request = $api->get('http://192.168.1.126:8888/api/api_checkAvailableRooms/' . $dateFrom .'/'. $dateTo);
      $response = $request->getBody()->getContents();
      $data['rooms'] = json_decode($response);
      */
      $data['rooms']= $room->getAvailableRooms($dateFrom, $dateTo);
      //dd($data);
      return view('rooms/checkAvailableRooms', $data);
    }

    public function api_checkAvailableRooms($client_id, Request $request)
    {
        $dateFrom = Carbon::parse($request->input('dateFrom'))->format('Y-m-d');
        $dateTo = Carbon::parse($request->input('dateTo'))->format('Y-m-d');
        $client = new Client();
        $room = new Room();
        $data = [];
        $data = $room->getAvailableRooms($dateFrom, $dateTo);
        return($data);
        //return view('rooms/checkAvailableRooms', $data);
    }
}
