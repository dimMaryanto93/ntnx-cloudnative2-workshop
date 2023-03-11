<?php

namespace App\Listeners;

use App\Events\Event;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Http\Request;
use App\Title as Title;
use App\Client as Client;
use App\Client3 as Client3;
use GuzzleHttp\Client as Api;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Support\Facades\Cache;

class EventListener 
{
    /**
     * Create the event listener.
     *
     * @return void
     */

    /**
     * Handle the event.
     *
     * @param  Event  $event
     * @return void
     */

    public function handle(Event $data)
    {   
        $title = $data->title;
        $name = $data->name;
        $last_name = $data->last_name;
        $address = $data->address;
        $zip_code = $data->zip_code;
        $city = $data->city;
        $state = $data->state;
        $email = $data->email;

        $data = array('title'=>$title, 'name'=>$name, 'last_name'=>$last_name, 'address'=>$address, 'zip_code'=>$zip_code, 'city'=>$city, 'state'=>$state, 'email'=>$email);
        //dd($data);

         $client = new Client();
         $client->create($data);
    }

}
