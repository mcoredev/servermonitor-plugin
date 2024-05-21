<?php namespace Mcore\ServerMonitor\Models;

use Model;
use Str;
use Carbon\Carbon;

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
}
