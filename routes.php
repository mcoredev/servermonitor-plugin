<?php

use Illuminate\Support\Facades\Log;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;
use Mcore\ServerMonitor\Models\Client;

Route::get('/monitor/server/update', function() {

	$clientList = Client::where('is_active',1)->get();

    foreach ($clientList as $client) {

    	$response = Http::post($client->domain.'/monitor/client/info',['api_token' => $client->api_key ]);
	    
	    if( $response->successful() ) {
	    	$body = $response->json();

	    	if(!empty($body)) {
		    	$client->version = $body['version'];
		    	$client->plugins = json_encode($body);
		    	$client->last_connected = Carbon::now();
		    	$client->save();
	    	}
	    	else {
	    		Log::error("Empty body from domain: ".$client->domain);
	    	}
	    }	
	    else {
    		Log::error("Unsuccessfully request: ".$client->domain);
    	}
    }
});
