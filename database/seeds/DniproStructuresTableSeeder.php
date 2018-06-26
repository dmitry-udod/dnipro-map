<?php

use Illuminate\Database\Seeder;

class DniproStructuresTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $row = 1;
        if (($handle = fopen( app_path() . "/../database/seeds/csv/dnipro_first_aid.csv", "r")) !== FALSE) {
            while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                if ($row > 1) {
                    dd($data);
                    DB::table('structures')->insert([
                        'uuid' => '',
                        'slug' => 'dnipro',
                        'created_by' => \Carbon\Carbon::now(),
                        'updated_by' => \Carbon\Carbon::now(),
                    ]);
                }
                $row++;
            }
            fclose($handle);
        }
    }
}
