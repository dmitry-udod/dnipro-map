<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStructuresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('structures', function (Blueprint $table) {
            $table->increments('id');
            $table->string('address');
            $table->string('name')->nullable();
            $table->string('uuid');
            $table->unique('uuid');
            $table->unsignedInteger('city_id');
            $table->index('city_id');
            $table->unsignedInteger('category_id');
            $table->index('category_id');
            $table->unsignedInteger('type_id');
            $table->unsignedInteger('district_id')->nullable();
            $table->string('area')->nullable();
            $table->string('business')->nullable();
            $table->string('owner')->nullable();
            $table->string('renter')->nullable();
            $table->string('notes')->nullable();
            $table->string('author_phone')->nullable();
            $table->string('author_email')->nullable();
            $table->string('url')->nullable();
            $table->string('working_hours')->nullable();
            $table->string('phone')->nullable();
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();
            $table->string('zoom')->nullable();
            $table->json('photos')->default('[]');
            $table->boolean('is_active')->default(true);
            $table->boolean('has_problem')->default(false);
            $table->boolean('is_free')->default(false);
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
        Schema::dropIfExists('structures');
    }
}
