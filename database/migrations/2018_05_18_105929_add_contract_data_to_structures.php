<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddContractDataToStructures extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('structures', function (Blueprint $table) {
            $table->boolean('has_contract')->nullable();
            $table->string('contract_number')->nullable();
            $table->date('contract_start_at')->nullable();
            $table->date('contract_finish_at')->nullable();
            $table->string('registry_number')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('structures', function (Blueprint $table) {
            $table->dropColumn(['has_contract', 'contract_number',  'contract_start_at' , 'contract_finish_at', 'registry_number']);
        });
    }
}
