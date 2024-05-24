<?php namespace Mcore\ServerMonitor\Updates;

use Schema;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

/**
 * CreateClientsTable Migration
 *
 * @link https://docs.octobercms.com/3.x/extend/database/structure.html
 */
return new class extends Migration
{
    /**
     * up builds the migration
     */
    public function up()
    {
        Schema::table('mcore_servermonitor_clients', function($table)
        {
            $table->integer('status')->nullable();
        });
    }


    /**
     * down reverses the migration
     */
    public function down()
    {
        Schema::table('mcore_servermonitor_clients', function($table)
        {
            $table->dropColumn('status');
        });
    }
};
