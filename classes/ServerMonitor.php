<?php namespace Mcore\ServerMonitor\Classes;

use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;
use October\Rain\Support\Facades\Flash;
use Mcore\ServerMonitor\Models\Client;

class ServerMonitor {

    private $model;


    public function __construct(Client $client)
    {
        $this->model = $client;
    }

    public function clientInfo(bool $withFlash = false)
    {
        $message = null;

        $response = $this->model->callStatusRequest();

        if( $response->successful() ) {
            $body = $response->json();

            if(!empty($body)) {
                $this->model->version = $body['version'];
                $this->model->client_data = json_encode($body);
                $this->model->status = $response->status();
                $this->model->last_connected = Carbon::now();
                $this->model->save();
            }
            else {
                $message = "Empty body from domain: ".$this->model->domain;
            }
        }
        else {
            $message = "Unsuccessfully request: ".$this->model->domain;
        }

        if($message) {
            Log::error($message);

            if($withFlash) {
                Flash::error($message);
            }
        }
    }

    public function clientPing()
    {
        if($this->model && $this->model->is_active) {
            $response = $this->model->callPingRequest();

            $this->model->status = $response->status();
            $this->model->last_connected = Carbon::now();
        }
        else {
            $this->model->status = null;
            Flash::error('Client is not active to ping.');
        }

        $this->model->save();
    }
}
