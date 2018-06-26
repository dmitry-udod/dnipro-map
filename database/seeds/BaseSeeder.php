<?php

use Illuminate\Database\Seeder;

class BaseSeeder extends Seeder
{
    protected function cityFindBySlug($slug)
    {
        $cityRepo = new \App\Repositories\CityRepository();

        return $cityRepo->findBySlug($slug);
    }

    protected function createCategory(\App\City $city, $categoryName)
    {
        $categoryRepo = new \App\Repositories\CategoryRepository();
        $data = [
            'name' => $categoryName,
            'slug' => str_slug($categoryName),
            'city_id' => $city->id,
            'is_active' => true,
            'order' => '0',
        ];

        return $categoryRepo->findByCityAndSlugOrCreate($city, $data);
    }

    protected function createType($city, $category, $typeName, $color = '#ffffff')
    {
        $typeRepo = new \App\Repositories\TypeRepository();

        return $typeRepo->findByCityCategoryAndSlugOrCreate($city, $category, [
            'name' => $typeName,
            'slug' => str_slug($typeName),
            'city_id' => $city->id,
            'category_id' => $category->id,
            'is_active' => true,
            'color' => $color,
            'order' => '0',
        ]);
    }

    protected function generateUuid()
    {
        $repo = new \App\Repositories\StructureRepository();

        return $repo->generateUuid();
    }
}
