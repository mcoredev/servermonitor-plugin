<?php namespace Mcore\ServerMonitor\Models;

use Model;
use Str;
use Illuminate\Support\Facades\Http;

/**
 * Client Model
 *
 * @link https://docs.octobercms.com/3.x/extend/system/models.html
 */
class Client extends Model
{
    use \October\Rain\Database\Traits\Validation;

    /**
     * @var string table name
     */
    public $table = 'mcore_servermonitor_clients';

    /**
     * @var array rules for validation
     */
    public $rules = [];


    protected $casts = [
        'client_data' => 'object',
    ];

    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            // $model->uuid = Str::uuid()->toString();
            $model->api_key = $model->generateClienApiKey();
        });
    }

    public function generateClienApiKey()
    {
        return hash('sha256', Str::random(64));
    }

    public function getClientInfoUrl()
    {
        return $this->domain.'/monitoring-api/client-info';
    }

    public function getClientPingUrl()
    {
        return $this->domain.'/monitoring-api/client-ping';
    }

    public function callStatusRequest()
    {
        return Http::post($this->getClientInfoUrl(),['api_token' => $this->api_key ]);
    }

    public function callPingRequest()
    {
        //return Http::get($this->domain);
        return Http::post($this->getClientPingUrl(),['api_token' => $this->api_key ]);
    }
}
