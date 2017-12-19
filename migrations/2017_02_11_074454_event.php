<?php
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Capsule\Manager as Capsule;

class Event extends Migration
{
    public function up()
    {
        // Had to be renamed from `event` due to a name clash with laravel
        $capsule = new Capsule();
        $capsule::schema()->create('event', function (Blueprint $table) {
            $table->increments('id');

            $table->string('serial_number');
            $table->string('type');
            $table->string('module');
            $table->string('msg');
            $table->string('data')->nullable();
            $table->bigInteger('timestamp');

            //$table->timestamps();

            $table->index('msg');
            $table->index('serial_number');
            $table->index(['serial_number', 'module']);
            $table->index('type');
        });
    }
    
    public function down()
    {
        $capsule = new Capsule();
        $capsule::schema()->dropIfExists('event');
    }
}
