<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePreviousRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('previous_records', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('age');
            $table->string('parent_name');
            $table->string('parent_phone');
            $table->string('date');
            $table->string('notes')->nullable();
            $table->text('response')->nullable();
            $table->boolean('is_processed')->default(false);
            $table->string('processed_by')->nullable();
            $table->dateTime('processed_at')->nullable();
            $table->unsignedInteger('structure_id');
            $table->unsignedInteger('city_id');

            // Indexes
            $table->string('uuid');
            $table->unique('uuid');
            $table->index('structure_id');
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
        Schema::dropIfExists('previous_records');
    }
}
