<?php

class MarganetsTempConstructions extends BaseSeeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $city = $this->cityFindBySlug('marganets');
        $category = $this->createCategory($city, 'Тимчасові споруди');
        $type = $this->createType($city, $category, 'Підприємницька діяльність', '#00ff3c');

        DB::table('structures')->insert([
            'address' => 'вул. Київська, біля житлового будинку № 147',
            'city_id' => $city->id,
            'category_id' => $category->id,
            'type_id' => $type->id,
            'uuid' => $this->generateUuid(),
            'latitude' => '47.6377287',
            'longitude' => '34.6601661',
            'has_contract' => true,
            'registry_number' => '№ 3 від 27.03.2017',
            'area' => '6,0 м2',
            'renter' => 'ФОП Таккі А.Б.',
            'business' => 'Продовольчі товари',
        ]);

        DB::table('structures')->insert([
            'address' => 'Вул. Лермонтова, біля житлового будинку № 27',
            'city_id' => $city->id,
            'category_id' => $category->id,
            'type_id' => $type->id,
            'uuid' => $this->generateUuid(),
            'latitude' => '47.6483952',
            'longitude' => '34.6473245',
            'has_contract' => true,
            'registry_number' => '№ 5 від 30.03.2017,',
            'area' => '6,0 м2',
            'renter' => 'ФОП Таккі А.Б.',
            'business' => 'Продовольчі товари',
        ]);
    }
}
