<?php

use Illuminate\Database\Seeder;

class MarganetsClinics extends Seeder
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

        $categoryRepo = new \App\Repositories\CategoryRepository();
        $categoryRepo->model = \App\Category::class;
        $data = [
            'name' => 'Центр первинної медико-санітарної допомоги',
            'slug' => str_slug('Центр первинної медико-санітарної допомоги'),
            'city_id' => $city->id,
            'is_active' => true,
            'order' => '0',
        ];
        $category = $categoryRepo->findByCityAndSlugOrCreate($city, $data);

        $typeName = 'Центр первинної медико-санітарної допомоги';
        $typeRepo = new \App\Repositories\TypeRepository();
        $typeRepo->model = App\Type::class;
        $type = $typeRepo->findByCityCategoryAndSlugOrCreate($city, $category, [
            'name' => $typeName,
            'slug' => str_slug($typeName),
            'city_id' => $city->id,
            'category_id' => $category->id,
            'is_active' => true,
            'color' => '#ffffff',
            'order' => '0',
        ]);

        DB::table('structures')->insert([
            'name' => 'Амбулаторія ЗПСМ № 1',
            'address' => 'Паркова,15',
            'city_id' => $city->id,
            'category_id' => $category->id,
            'type_id' => $type->id,
            'uuid' => $repo->generateUuid(),
            'working_hours' => '|Бірюкова Наталя Петрівна - І зміна 8.00.-13.00; ІІ зміна 13.00-18.00|Миргородський Сергій Іванович - з13.00-14.30 неділя з 8.00-11.00|Тиха Ганна Іванівна - І зміна 8.00.-13.00; ІІ зміна 13.00-18.00|Чичика Ірина Миколаївна - з 12.00-13.00 щодня, крім вихідних',
            'latitude' => '47.6431254',
            'longitude' => '34.6601773',
        ]);

        DB::table('structures')->insert([
            'name' => 'Амбулаторія ЗПСМ № 2',
            'address' => 'Фабрична,1',
            'city_id' => $city->id,
            'category_id' => $category->id,
            'type_id' => $type->id,
            'uuid' => $repo->generateUuid(),
            'working_hours' => '|Винокурова Ірина Миколаївна - І зміна 8.00.-13.00; ІІ зміна 13.00-18.00',
            'latitude' => '47.6579284',
            'longitude' => '34.5881297',
        ]);

        DB::table('structures')->insert([
            'name' => 'Амбулаторія ЗПСМ № 3',
            'address' => 'Паркова,15',
            'city_id' => $city->id,
            'category_id' => $category->id,
            'type_id' => $type->id,
            'uuid' => $repo->generateUuid(),
            'working_hours' => '|Гаврилова Наталія Іванівна - І зміна 8.00.-13.00; ІІ зміна 13.00-18.00|Кравченко Олег Петрович - І зміна 8.00.-13.00; ІІ зміна 13.00-18.00|Полякова Тетяна Вікторівна - І зміна 8.00.-13.00; ІІ зміна 13.00-18.00|',
            'latitude' => '47.64312720712857',
            'longitude' => '34.660249049091135',
        ]);

        DB::table('structures')->insert([
            'name' => 'Амбулаторія ЗПСМ № 4',
            'address' => 'Лермонтова,27а',
            'city_id' => $city->id,
            'category_id' => $category->id,
            'type_id' => $type->id,
            'uuid' => $repo->generateUuid(),
            'working_hours' => '|Полякова Олена Василівна - І зміна 8.00.-13.00; ІІ зміна 13.00-18.00|',
            'latitude' => '47.6487967',
            'longitude' => '34.6471925',
        ]);

        DB::table('structures')->insert([
            'name' => '',
            'address' => 'Єдності, 170',
            'city_id' => $city->id,
            'category_id' => $category->id,
            'type_id' => $type->id,
            'uuid' => $repo->generateUuid(),
            'working_hours' => '|Лукашева Валентина Миколаївна - І зміна 8.00.-13.00; ІІ зміна 13.00-18.00|',
            'latitude' => '47.653147',
            'longitude' => '34.6215936',
        ]);

        DB::table('structures')->insert([
            'name' => 'Амбулаторія ЗПСМ № 5',
            'address' => 'Північний кв.,1',
            'city_id' => $city->id,
            'category_id' => $category->id,
            'type_id' => $type->id,
            'uuid' => $repo->generateUuid(),
            'working_hours' => '|Калашник Наталя Віталіївна - І зміна 8.00.-13.00; ІІ зміна 13.00-18.00|Петренко Дмитро Васильович - І зміна 8.00.-13.00; ІІ зміна 13.00-18.00|Скоробогатько Ніна Ярославівна - І зміна 8.00.-13.00; ІІ зміна 13.00-18.00|',
            'latitude' => '47.637248',
            'longitude' => '34.628039',
        ]);
    }
}
