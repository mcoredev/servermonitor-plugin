<?php namespace Mcore\ServerMonitor;

use Backend;
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
            'description' => 'No description provided yet...',
            'author' => 'Mcore',
            'icon' => 'icon-leaf'
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
     * registerComponents used by the frontend.
     */
    public function registerComponents()
    {
        return []; // Remove this line to activate

        return [
            'Mcore\ServerMonitor\Components\MyComponent' => 'myComponent',
        ];
    }

    /**
     * registerPermissions used by the backend.
     */
    public function registerPermissions()
    {
        return []; // Remove this line to activate

        return [
            'mcore.servermonitor.some_permission' => [
                'tab' => 'ServerMonitor',
                'label' => 'Some permission'
            ],
        ];
    }

    public function registerSettings()
    {
        return [
            'servermonitor' => [
                'label' => 'Server monitor Setting',
                'description' => 'Setting....',
                'category' => 'CATEGORY_CMS',
                'icon' => 'octo-icon-user-group',
                'url' => Backend::url('mcore/servermonitor/clients'),
                'size' => 'medium',
                'order' => -100,
            ]
        ];
    }


    /**
     * registerNavigation used by the backend.
     */
    public function registerNavigation()
    {
        return [];
        
        return [
            'servermonitor' => [
                'label' => 'ServerMonitor',
                'url' => Backend::url('mcore/servermonitor/clients'),
                'icon' => 'icon-leaf',
                'permissions' => ['mcore.servermonitor.*'],
                'order' => 500,
            ],
        ];
    }
}
