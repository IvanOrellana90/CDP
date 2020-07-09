<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAreasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('areas', function (Blueprint $table) {
            $table->id();
            $table->text("detail")->nullable();
            $table->integer("country_id")->default(1);
            $table->timestamps();
        });

        Schema::create('area_region', function (Blueprint $table) {
            $table->id();
            $table->integer("area_id");
            $table->integer("region_id");
            $table->timestamps();
        });

        Schema::create('area_commune', function (Blueprint $table) {
            $table->id();
            $table->integer("area_id");
            $table->integer("commune_id");
            $table->timestamps();
        });

        Schema::create('area_direction', function (Blueprint $table) {
            $table->id();
            $table->integer("area_id");
            $table->integer("direction_id");
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
        Schema::dropIfExists('areas');

        Schema::dropIfExists('area_region');

        Schema::dropIfExists('area_commune');

        Schema::dropIfExists('area_direction');
    }
}
