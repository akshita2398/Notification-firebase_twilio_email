<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnDeviceToken extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */

    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('device_type')->nullable();
            $table->string('device_token')->nullable();
            $table->string('notification_status')->default(1);
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('device_type'); //dropcolumn
            $table->dropColumn('device_token'); //dropcolumn
            $table->dropColumn('notification_status'); //dropcolumn
        });
    }
}
