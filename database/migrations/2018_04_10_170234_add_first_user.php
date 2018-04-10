<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFirstUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $user = App\User::firstOrCreate([
            'email' => 'reedwalter24@gmail.com',
            'name' => 'Dima Udod',
            'password' => bcrypt('admin'),
        ]);

        $user->roles = '["superadmin"]';    
        $user->save();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
