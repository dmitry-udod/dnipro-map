<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClaimsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('claims', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('phone');
            $table->string('email');
            $table->string('claim_category_id');
            $table->text('description');
            $table->json('photos')->default('[]');
            $table->boolean('is_processed')->default(false);
            $table->string('processed_by')->nullable();
            $table->dateTime('processed_at')->nullable();
            $table->string('uuid');
            $table->unsignedInteger('city_id');
            $table->unsignedInteger('category_id');
            $table->unsignedInteger('structure_id');

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
        Schema::dropIfExists('claims');
    }
}
