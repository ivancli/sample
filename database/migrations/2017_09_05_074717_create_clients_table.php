<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->increments('id');
            $table->string('segment', 100);
            $table->string('name', 100);
            $table->text('layout_html')->nullable();
            $table->text('layout_non_auth_html')->nullable();
            $table->string('base_url')->nullable();
            $table->string('css')->nullable();
            $table->string('banner')->nullable();
            $table->string('client_logo')->nullable();
            $table->string('apple_touch_icon')->nullable();
            $table->string('favicon')->nullable();
            $table->string('sprooki_endpoint');
            $table->string('sprooki_publickey');
            $table->string('sprooki_privatekey');
            $table->string('sprooki_api_version', 6);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clients');
    }
}
