<?php

use Illuminate\Database\Seeder;

class CityTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
//		DB::table('cities')->insert([
//            'name' => 'Днiпро',
//            'slug' => 'dnipro',
//            'created_at' => \Carbon\Carbon::now(),
//        ]);

		DB::table('cities')->insert([
            'name' => 'Марганець',
            'slug' => 'marganets',
            'created_at' => \Carbon\Carbon::now(),
        ]);
    }
}
