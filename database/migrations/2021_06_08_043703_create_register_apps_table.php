<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRegisterAppsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('register_apps', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid');
            $table->string('email');
            $table->string('app_name');
            $table->string('app_desc');
            $table->string('brand_name');
            $table->enum('status', ['REQUESTED', 'APPROVED', 'REJECTED'])->default('REQUESTED');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('register_apps');
    }
}
