<?php

use Illuminate\Database\Seeder;

class MarganetsCivilBudget extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $repo = new \App\Repositories\StructureRepository();
        $cityRepo = new \App\Repositories\CityRepository();
        $city = $cityRepo->findBySlug('marganets');

        $categoryName = 'Бюджет участі';
        $categoryRepo = new \App\Repositories\CategoryRepository();

        $data = [
            'name' => $categoryName,
            'slug' => str_slug($categoryName),
            'city_id' => $city->id,
            'is_active' => true,
            'order' => '0',
            'additional_fields' => [
                ["name" => "Кошти міського бюджету","id" => "city_budget","value" => ""],
                ["name" => "Власні кошти", "id" => "own_budget","value" => ""],
                ["name" => "Загальний бюджет","id" => "total_budget","value" => ""],
                ["name" => "Всього голосів за результататми голосування","id" => "votes","value" => ""]
            ],
        ];
        $category = $categoryRepo->findByCityAndSlugOrCreate($city, $data);


        $typeName = 'Спорт';
        $typeRepo = new \App\Repositories\TypeRepository();
        $sportType = $typeRepo->findByCityCategoryAndSlugOrCreate($city, $category, [
            'name' => $typeName,
            'slug' => str_slug($typeName),
            'city_id' => $city->id,
            'category_id' => $category->id,
            'is_active' => true,
            'color' => '#ffffff',
            'order' => '0',
        ]);
        $sportType->icon = json_encode([
            'path' => '/icons/city_budget/sport.png',
            'name' => 'sport.png',
        ]);
        $sportType->save();

        DB::table('structures')->insert([
            'name' => 'Встановлення спортивного майданчика',
            'address' => 'с. Миколаївка',
            'city_id' => $city->id,
            'category_id' => $category->id,
            'type_id' => $sportType->id,
            'uuid' => $repo->generateUuid(),
            'latitude' => '48.543030',
            'longitude' => '34.714825',
            'additional_fields' => json_encode([
                ["id" => "city_budget","value" => "90 000 грн."],
                ["id" => "own_budget","value" => "10 000 грн."],
                ["id" => "total_budget","value" => "100 000 грн."],
                ["id" => "votes","value" => "468"]
            ]),
        ]);

        DB::table('structures')->insert([
            'name' => 'Встановлення спортивного майданчика',
            'address' => 'Дитячий садок № 5',
            'city_id' => $city->id,
            'category_id' => $category->id,
            'type_id' => $sportType->id,
            'uuid' => $repo->generateUuid(),
            'latitude' => '47.6579481',
            'longitude' => '34.5837498',
            'additional_fields' => json_encode([
                ["id" => "city_budget","value" => "90 000 грн."],
                ["id" => "own_budget","value" => "10 000 грн."],
                ["id" => "total_budget","value" => "100 000 грн."],
                ["id" => "votes","value" => "275"]
            ]),
        ]);


        $typeName = 'Освіта';
        $educationType = $typeRepo->findByCityCategoryAndSlugOrCreate($city, $category, [
            'name' => $typeName,
            'slug' => str_slug($typeName),
            'city_id' => $city->id,
            'category_id' => $category->id,
            'is_active' => true,
            'color' => '#ffffff',
            'order' => '0',
        ]);
        $educationType->icon = json_encode([
            'path' => '/icons/city_budget/education.png',
            'name' => 'education.png',
        ]);
        $educationType->save();

        DB::table('structures')->insert([
            'name' => 'Ремонт майстерні',
            'address' => 'ВК Ліцей № 10',
            'city_id' => $city->id,
            'category_id' => $category->id,
            'type_id' => $educationType->id,
            'uuid' => $repo->generateUuid(),
            'latitude' => '47.6403528',
            'longitude' => '34.6556133',
            'additional_fields' => json_encode([
                ["id" => "city_budget","value" => "90 000 грн."],
                ["id" => "own_budget","value" => "10 000 грн."],
                ["id" => "total_budget","value" => "100 000 грн."],
                ["id" => "votes","value" => "468"]
            ]),
        ]);


        DB::table('structures')->insert([
            'name' => 'Закупівля обладнання та меблів  для їдальні',
            'address' => 'СШ № 12',
            'city_id' => $city->id,
            'category_id' => $category->id,
            'type_id' => $educationType->id,
            'uuid' => $repo->generateUuid(),
            'latitude' => '47.643250',
            'longitude' => '34.626627',
            'additional_fields' => json_encode([
                ["id" => "city_budget","value" => "45 000 грн."],
                ["id" => "own_budget","value" => "5 000 грн."],
                ["id" => "total_budget","value" => "50 000 грн."],
                ["id" => "votes","value" => "219"]
            ]),
        ]);

        DB::table('structures')->insert([
            'name' => 'Закупівля спортивного інвентарю для тренувань з карате',
            'address' => 'СШ № 9',
            'city_id' => $city->id,
            'category_id' => $category->id,
            'type_id' => $educationType->id,
            'uuid' => $repo->generateUuid(),
            'latitude' => '47.6527201',
            'longitude' => '34.6496246',
            'additional_fields' => json_encode([
                ["id" => "city_budget","value" => "40 000 грн."],
                ["id" => "own_budget","value" => "10 000 грн."],
                ["id" => "total_budget","value" => "50 000 грн."],
                ["id" => "votes","value" => "191"]
            ]),
        ]);

        $typeName = 'Енергозбереження';
        $type = $typeRepo->findByCityCategoryAndSlugOrCreate($city, $category, [
            'name' => $typeName,
            'slug' => str_slug($typeName),
            'city_id' => $city->id,
            'category_id' => $category->id,
            'is_active' => true,
            'color' => '#ffffff',
            'order' => '0',
        ]);
        $type->icon = json_encode([
            'path' => '/icons/city_budget/efficent.png',
            'name' => 'efficent.png',
        ]);
        $type->save();

        DB::table('structures')->insert([
            'name' => 'Встановлення металопластикових енергозберігаючих вікон',
            'address' => 'Проектна, 4',
            'city_id' => $city->id,
            'category_id' => $category->id,
            'type_id' => $type->id,
            'uuid' => $repo->generateUuid(),
            'latitude' => '47.6403193',
            'longitude' => '34.6579955',
            'additional_fields' => json_encode([
                ["id" => "city_budget","value" => "50 000 грн."],
                ["id" => "own_budget","value" => "50 000 грн."],
                ["id" => "total_budget","value" => "100 000 грн."],
                ["id" => "votes","value" => "148"]
            ]),
        ]);

        DB::table('structures')->insert([
            'name' => 'Встановлення металопластикових енергозберігаючих вікон',
            'address' => 'Київська, 149',
            'city_id' => $city->id,
            'category_id' => $category->id,
            'type_id' => $type->id,
            'uuid' => $repo->generateUuid(),
            'latitude' => '47.6384069',
            'longitude' => '34.6607858',
            'additional_fields' => json_encode([
                ["id" => "city_budget","value" => "45 000 грн."],
                ["id" => "own_budget","value" => "18 000 грн."],
                ["id" => "total_budget","value" => "63 000 грн."],
                ["id" => "votes","value" => "145"]
            ]),
        ]);

        DB::table('structures')->insert([
            'name' => 'Встановлення металопластикових енергозберігаючих вікон',
            'address' => 'Ювілейний, 10',
            'city_id' => $city->id,
            'category_id' => $category->id,
            'type_id' => $type->id,
            'uuid' => $repo->generateUuid(),
            'latitude' => '47.653328',
            'longitude' => '34.646437',
            'additional_fields' => json_encode([
                ["id" => "city_budget","value" => "45 000 грн."],
                ["id" => "own_budget","value" => "5 000 грн."],
                ["id" => "total_budget","value" => "50 000 грн."],
                ["id" => "votes","value" => "268"]
            ]),
        ]);
    }
}
