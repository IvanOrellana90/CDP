<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrganizationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('organizations', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->boolean("verified")->default(false);
            $table->string("rut")->nullable();
            $table->integer("points")->default(0);
            $table->integer("category_id")->nullable();
            $table->integer("support_id");
            $table->integer("contact_id");
            $table->integer("observation_id");
            $table->integer("operation_id"); // Categoria con tipos de operacion
            $table->integer("area_id");
            $table->integer("image_id")->nullable();
            $table->timestamps();
        });

        Schema::create('direction_organization', function (Blueprint $table) {
            $table->id();
            $table->integer("direction_id");
            $table->integer("organization_id");
            $table->timestamps();
        });

        Schema::create('event_organization', function (Blueprint $table) {
            $table->id();
            $table->integer("event_id");
            $table->integer("organization_id");
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
        Schema::dropIfExists('organizations');

        Schema::dropIfExists('direction_organization');

        Schema::dropIfExists('event_organization');
    }
}
