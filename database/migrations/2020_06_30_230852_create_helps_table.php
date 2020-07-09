<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHelpsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('helps', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->integer('support_id');
            $table->text("description")->nullable();
        });

        Schema::create('category_help', function (Blueprint $table) {
            $table->id();
            $table->integer("category_id");
            $table->integer("help_id");
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
        Schema::dropIfExists('helps');

        Schema::dropIfExists('category_help');
    }
}
