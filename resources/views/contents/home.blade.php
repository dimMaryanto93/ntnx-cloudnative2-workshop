@extends('layouts.app')

@section('content') 
    <div class="row">
      <div class="medium-6 columns">
        <h4>[DEVELOPMENT ENVIRONMENT] - Dimas Maryanto 2 Workshop cloudnative</h4>
        <img class="thumbnail" src="images\london.jpg">
      </div>
      <div class="medium-6 large-5 columns">
        </br>
        </br>
        </br>
        <p>The original Cinere perseveres after 50 years in the heart of West java. The West End neighborhood has something for everyone—from theater to dining to historic sights.</p>
        <p>And the not-to-miss Rooftop Cafe is a great place for travelers and locals to engage over drinks, food, and good conversation. </p>
        <p>To learn more about the Arief Exclusive Hotel in the West End, browse our website and download our handy information sheet.</p>
        <p>{{ $last_updated }}</p>
      </div>
    </div>
@endsection