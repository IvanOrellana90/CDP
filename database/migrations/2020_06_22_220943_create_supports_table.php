<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSupportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('supports', function (Blueprint $table) {
            $table->id();
            $table->text("description")->nullable();
            $table->string("number_beneficiaries")->nullable();
            $table->timestamps();
        });

        Schema::create('category_support', function (Blueprint $table) {
            $table->id();
            $table->integer("category_id");
            $table->integer("support_id");
            $table->timestamps();
        });

        Schema::create('beneficiary_support', function (Blueprint $table) {
            $table->id();
            $table->integer("category_id");
            $table->integer("support_id");
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
        Schema::dropIfExists('supports');

        Schema::dropIfExists('category_support');

        Schema::dropIfExists('beneficiary_support');
    }
}
