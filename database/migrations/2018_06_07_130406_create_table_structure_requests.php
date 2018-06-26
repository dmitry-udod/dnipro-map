<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableStructureRequests extends Migration
{
    public function up()
    {
        Schema::create('structure_requests', function (Blueprint $table) {
            $table->increments('id');
            $table->string('address');
            $table->string('latitude');
            $table->string('longitude');
            $table->string('name');
            $table->string('email');
            $table->text('description');
            $table->json('photos')->default('[]');
            $table->boolean('is_processed')->default(false);
            $table->string('processed_by')->nullable();
            $table->dateTime('processed_at')->nullable();
            $table->string('uuid');
            $table->unsignedInteger('city_id');
            $table->unsignedInteger('category_id');

            // Indexes
            $table->unique('uuid');
            $table->index('city_id');

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
        Schema::dropIfExists('structure_requests');
    }
}
