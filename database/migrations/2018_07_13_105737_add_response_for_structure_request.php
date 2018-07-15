<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddResponseForStructureRequest extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('structure_requests', function (Blueprint $table) {
            $table->text('response')->nullable();
            $table->boolean('is_structure_created')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('structure_requests', function (Blueprint $table) {
            $table->dropColumn('response');
            $table->dropColumn('is_structure_created');
        });
    }
}
