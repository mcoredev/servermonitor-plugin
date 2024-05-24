<?php namespace Mcore\ServerMonitor;

use Backend;
use Mcore\ServerMonitor\Classes\ServerMonitor;
use Mcore\ServerMonitor\Models\Client;
use System\Classes\PluginBase;

/**
 * Plugin Information File
 *
 * @link https://docs.octobercms.com/3.x/extend/system/plugins.html
 */
class Plugin extends PluginBase
{
    /**
     * pluginDetails about this plugin.
     */
    public function pluginDetails()
    {
        return [
            'name' => 'ServerMonitor',
            'description' => 'Manage multiple OCMS projects from a single backend',
            'author' => 'Mcore',
            'icon' => 'icon-server'
        ];
    }

    /**
     * register method, called when the plugin is first registered.
     */
    public function register()
    {
        //
    }

    /**
     * boot method, called right before the request route.
     */
    public function boot()
    {
        //
    }

    /**
     * Registers the scheduled functions for this plugin.
     *
     * @return void
     */
    public function registerSchedule($schedule)
    {
        $schedule->call(function () {

            $clientList = Client::where('is_active',1)->get();

            if($clientList) {
                foreach ($clientList as $client) {

                    $serverMonitor = new ServerMonitor($client);
                    $serverMonitor->clientInfo();
                }
            }

        })->daily();
    }


    /**
     * registerPermissions used by the backend.
     */
    public function registerPermissions()
    {
        return [
            'mcore.servermonitor.clients' => [
                'tab' => 'ServerMonitor',
                'label' => 'Client list'
            ],
        ];
    }

    public function registerSettings()
    {
        return [
            'servermonitor_clients' => [
                'label' => 'Server clients monitor',
                'description' => 'List of clients monitoring system updates',
                'category' => 'CATEGORY_CMS',
                'icon' => 'octo-icon-server',
                'url' => Backend::url('mcore/servermonitor/clients'),
                'permissions' => ['mcore.servermonitor.clients'],
                'size' => 'medium',
                'order' => -100,
            ]
        ];
    }
}
