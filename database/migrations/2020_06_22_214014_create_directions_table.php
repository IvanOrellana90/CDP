<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDirectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('directions', function (Blueprint $table) {
            $table->id();
            $table->string("street")->nullable();
            $table->integer("number")->nullable();
            $table->string("district")->nullable();
            $table->text("detail")->nullable();
            $table->text("country_id")->nullable();
            $table->integer("region_id")->nullable();
            $table->integer("province_id")->nullable();
            $table->integer("commune_id")->nullable();
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
        Schema::dropIfExists('directions');

    }
}
