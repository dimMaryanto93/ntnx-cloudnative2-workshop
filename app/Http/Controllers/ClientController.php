<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Title;
use App\Client;
use App\Client2;
use GuzzleHttp\Client as Api;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Support\Facades\Cache;
use App\Events\Event;


class ClientController extends Controller
{
    
    public function __construct( Title $titles, Client $client, Client2 $client2 )
    {
        $this->titles = $titles->all();
        $this->client = $client;
        $this->client2 = $client2;
    }
    
    
    /*
    public function __construct( Title $titles, Client $client )
    {
        $this->titles = $titles->all();
        $this->client = $client;
    }
    */

    public function di()
    {
        dd($this->titles);
    }

    public function query_biasa()
    {
        $query = Client::all();
        foreach ($query as $q) {
            echo "<li>{$q->name}</li>";
        }
    }

    public function query_redis()
    {
        $query = Cache::remember("list_client", 60 * 60 * 24, function () {
            return Client::all();
        });

        foreach ($query as $q) {
            echo "<li>{$q->name}</li>";
        }
    }

    public function index()
    {
        //$data = [];

//        $data['clients'] = $this->client->all();
        //$data['clients'] = $this->client2->all();

        $data['clients'] = Cache::remember('clients',10 * 60, function () {
            return client::all();
        });

        //$api = new api();
        //$request = $api->get('http://192.168.1.126:8888/api/api_view');
        //$response = $request->getBody()->getContents();

        //$data = json_decode($response);
        //return view('client/index')->with('clients', $data);

        return view('client/index', $data);

    }

    public function api_view()
    {
        $data = [];
        $data= $this->client->all();
        

        //$data = Cache::remember('api_view',10 * 60, function () {
        //    return client::all();
        //});
        
        return $data;
    }

    public function api_show($id)
    {
        
        $data = [];
        
        $data= $this->client->find($id);

        return $data;
    }

    public function api_fetch()
    {
        $hasil = [];

        $api = new api();
        $request = $api->get('http://192.168.1.126:8888/api/api_view');
        $response = $request->getBody()->getContents();

        $hasil = json_decode($response);

        dd($hasil);
        //return view('client/hasil')->with('hasil', $hasil);
    }

    public function export()
    {
        $data = [];

        $data['clients'] = $this->client->all();
        header('Content-Disposition: attachment;filename=export.xls');
        return view('client/export', $data);
    }

    public function newClient( Request $request, Client $client )
    {
        $data = [];

        $data['title'] = $request->input('title');
        $data['name'] = $request->input('name');
        $data['last_name'] = $request->input('last_name');
        $data['address'] = $request->input('address');
        $data['zip_code'] = $request->input('zip_code');
        $data['city'] = $request->input('city');
        $data['state'] = $request->input('state');
        $data['email'] = $request->input('email');



        if( $request->isMethod('post') )
        {
            //dd($data);
            $this->validate(
                $request,
                [
                    'name' => 'required|min:5',
                    'last_name' => 'required',
                    'address' => 'required',
                    'zip_code' => 'required',
                    'city' => 'required',
                    'state' => 'required',
                    'email' => 'required',

                ]
            );
            //dd($data);
            //event(new Event($data));
            
            $client->create($data);

            //Client::create($request->only(['title','name', 'last_name', 'address', 'zip_code', 'city', 'state', 'email']));

            /*
            $api = new api(["base_uri" => 'http://192.168.1.126:8888/']);
            $options = [
                'form_params' => $data
                ];
            $response = $api->post("/api/api_new/", $options);
            */

            return redirect('clients');
        }
        $data['titles'] = $this->titles;
        $data['modify'] = 0;
        return view('client/form', $data);
    }

    public function create()
    {
            return view('client/create');
    }

    public function show($client_id, Request $request)
    {

        /*$hasil = [];

        $api = new api();
        $request = $api->get('http://192.168.1.126:8888/api/api_view/' . $client_id );
        $response = $request->getBody()->getContents();
        $client_data = json_decode($response);

        //dd($client_data);
        */

        $client_data = $this->client->find($client_id);

        $data = []; $data['client_id'] = $client_id;
        $data['titles'] = $this->titles;
        $data['modify'] = 1;
        $data['name'] = $client_data->name;
        $data['last_name'] = $client_data->last_name;
        $data['title'] = $client_data->title;
        $data['address'] = $client_data->address;
        $data['zip_code'] = $client_data->zip_code;
        $data['city'] = $client_data->city;
        $data['state'] = $client_data->state;
        $data['email'] = $client_data->email;

        

        //$request->session()->put('last_updated', $client_data->name . ' ' .
        //$client_data->last_name);


        return view('client/form', $data);
    }

    public function modify( Request $request, $client_id, Client $client )
    {

        $data = [];

        $data['title'] = $request->input('title');
        $data['name'] = $request->input('name');
        $data['last_name'] = $request->input('last_name');
        $data['address'] = $request->input('address');
        $data['zip_code'] = $request->input('zip_code');
        $data['city'] = $request->input('city');
        $data['state'] = $request->input('state');
        $data['email'] = $request->input('email');

        //dd($data);
        /*
        $api = new api(["base_uri" => 'http://192.168.1.126:8888/']);
        $options = [
            'form_params' => $data
            ];
        $response = $api->post("/api/api_view/" . $client_id, $options);
        //dd($response);
        return redirect('clients');
        */

        if( $request->isMethod('post') )
        {
            //dd($data);
            $this->validate(
                $request,
                [
                    'name' => 'required|min:5',
                    'last_name' => 'required',
                    'address' => 'required',
                    'zip_code' => 'required',
                    'city' => 'required',
                    'state' => 'required',
                    'email' => 'required',

                ]
            );

            $client_data = $this->client->find($client_id);
            /*
            $hasil = [];

            $api = new api();
            $request = $api->get('http://192.168.1.126:8888/api/api_view/' . $client_id );
            $response = $request->getBody()->getContents();
            $client_data = json_decode($response);

            //dd($client_data);
            */
            $client_data->title = $request->input('title');
            $client_data->name = $request->input('name');
            $client_data->last_name = $request->input('last_name');
            $client_data->address = $request->input('address');
            $client_data->zip_code = $request->input('zip_code');
            $client_data->city = $request->input('city');
            $client_data->state = $request->input('state');
            $client_data->email = $request->input('email');

            $client_data->save();
            //$client_data->unsetEventDispatcher();

            return redirect('clients');
        }

        return view('client/form', $data);
    }

    public function api_modify( Request $request, $client_id, Client $client )
    {

        $data = [];

        $data['title'] = $request->input('title');
        $data['name'] = $request->input('name');
        $data['last_name'] = $request->input('last_name');
        $data['address'] = $request->input('address');
        $data['zip_code'] = $request->input('zip_code');
        $data['city'] = $request->input('city');
        $data['state'] = $request->input('state');
        $data['email'] = $request->input('email');

        if( $request->isMethod('post') )
        {
            //dd($data);
            $this->validate(
                $request,
                [
                    'name' => 'required|min:5',
                    'last_name' => 'required',
                    'address' => 'required',
                    'zip_code' => 'required',
                    'city' => 'required',
                    'state' => 'required',
                    'email' => 'required',

                ]
            );

            $client_data = $this->client->find($client_id);

            $client_data->title = $request->input('title');
            $client_data->name = $request->input('name');
            $client_data->last_name = $request->input('last_name');
            $client_data->address = $request->input('address');
            $client_data->zip_code = $request->input('zip_code');
            $client_data->city = $request->input('city');
            $client_data->state = $request->input('state');
            $client_data->email = $request->input('email');

            $client_data->save();
            //dd($client_data);
            //return redirect('clients');
        }

        //return view('client/form', $data);
    }

  public function api_new( Request $request, Client $client )
  {
      $data = [];

      $data['title'] = $request->input('title');
      $data['name'] = $request->input('name');
      $data['last_name'] = $request->input('last_name');
      $data['address'] = $request->input('address');
      $data['zip_code'] = $request->input('zip_code');
      $data['city'] = $request->input('city');
      $data['state'] = $request->input('state');
      $data['email'] = $request->input('email');

      if( $request->isMethod('post') )
      {
          //dd($data);
          $this->validate(
              $request,
              [
                  'name' => 'required|min:5',
                  'last_name' => 'required',
                  'address' => 'required',
                  'zip_code' => 'required',
                  'city' => 'required',
                  'state' => 'required',
                  'email' => 'required',

              ]
          );

          $client->insert($data);

          //return redirect('clients');
      }
      $data['titles'] = $this->titles;
      $data['modify'] = 0;
      //return view('client/form', $data);
  }
}
