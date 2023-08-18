<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableUserDeviceToken extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */

    public function up()
    {
        Schema::table('user_device_tokens', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->string('device_type')->nullable();
            $table->string('device_token')->nullable();
            $table->string('notification_status')->default(1);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('user_device_tokens');
    }
}
