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
        Schema::create('mcore_servermonitor_clients', function(Blueprint $table) {
            $table->id('id');
            $table->string('domain',100);
            $table->text('description')->nullable();
            $table->string('api_key',64)->nullable();
            $table->string('version',20)->nullable();
            $table->text('plugins')->nullable();
            $table->dateTime('last_connected')->nullable();
            $table->boolean('is_active')->unsigned()->default(0);
            $table->timestamps();
        });
    }

    /**
     * down reverses the migration
     */
    public function down()
    {
        Schema::dropIfExists('mcore_servermonitor_clients');
    }
};
