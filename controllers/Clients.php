<?php namespace Mcore\ServerMonitor\Controllers;

use Flash;
use BackendMenu;
use Backend\Classes\Controller;
use Mcore\ServerMonitor\Classes\ServerMonitor;
use Mcore\ServerMonitor\Models\Client;
use System\Classes\SettingsManager;

/**
 * Clients Backend Controller
 *
 * @link https://docs.octobercms.com/3.x/extend/system/controllers.html
 */
class Clients extends Controller
{
    public $implement = [
        \Backend\Behaviors\FormController::class,
        \Backend\Behaviors\ListController::class,
    ];

    /**
     * @var string formConfig file
     */
    public $formConfig = 'config_form.yaml';

    /**
     * @var string listConfig file
     */
    public $listConfig = 'config_list.yaml';

    /**
     * @var array required permissions
     */
    public $requiredPermissions = ['mcore.servermonitor.clients'];

    /**
     * __construct the controller
     */
    public function __construct()
    {
        parent::__construct();

//        BackendMenu::setContext('Mcore.ServerMonitor', 'servermonitor', 'clients');
        BackendMenu::setContext('October.System', 'system', 'settings');
        SettingsManager::setContext('Mcore.ServerMonitor', 'servermonitor_clients');
    }

    public function onPing()
    {
        $record_id = post('record_id');

        $client = Client::where('id',$record_id)->first();

        $serverMonitor = new ServerMonitor($client);
        $serverMonitor->clientPing();

        return $this->listRefresh();
    }

    public function onClientInfo()
    {
        $record_id = post('record_id');

        $client = Client::where('id',$record_id)->first();
        $serverMonitor = new ServerMonitor($client);
        $serverMonitor->clientInfo(true);

        return $this->listRefresh();
    }

    /**
     * Inject row class based on record status.
     *
     * @param $clientRecord
     * @param $definition
     * @return string|void
     */
    public function listInjectRowClass($clientRecord, $definition = null)
    {
        if (in_array($clientRecord->status, [500, 400, 404])) {
            return 'negative';
        }
        elseif (in_array($clientRecord->status, [200, 201])) {
            return 'positive';
        }
    }
}
