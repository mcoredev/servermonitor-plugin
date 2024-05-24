<?php

use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;
use October\Rain\Support\Facades\Flash;
use Mcore\ServerMonitor\Models\Client;
use Mcore\ServerMonitor\Classes\ServerMonitor;

Route::get('/monitor-api/clients-status', function() {

	$clientList = Client::where('is_active',1)->get();

    foreach ($clientList as $client) {

        $serverMonitor = new ServerMonitor($client);
        $serverMonitor->clientInfo();
    }
});

Route::get('/monitor-api/client-status/{token}', function(string $token) {

    $client = Client::where('api_key',$token)->first();

    if($client) {
        $serverMonitor = new ServerMonitor($client);
        $serverMonitor->clientInfo(true);
    }
    else {
        Flash::error("Client {$client->domain} not found!");
    }
});

Route::get('/monitor-api/client-ping/{token}', function(string $token) {

    $client = Client::where('api_key', $token)->first();

    if($client) {
        $serverMonitor = new ServerMonitor($client);
        $serverMonitor->clientPing();
    }
    else {
        Flash::error("Client {$client->domain} not found!");
    }
});
