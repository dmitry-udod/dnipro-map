<?php

class MarganetsAfterSchool extends BaseSeeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $city = $this->cityFindBySlug('marganets');
        $category = $this->createCategory($city, 'Комунальні позашкільні заклади');
        $type = $this->createType($city, $category, 'Музичні школи');

        DB::table('structures')->insert([
            'address' => 'вул. Єдності, 37',
            'director' => 'Лелюх Леонід Васильович',
            'phone' => '05665 2-20-40',
            'working_hours' => 'пн.-пт. 08:00 - 17:00',
            'city_id' => $city->id,
            'category_id' => $category->id,
            'type_id' => $type->id,
            'uuid' => $this->generateUuid(),
            'latitude' => '47.634519',
            'longitude' => '34.624773',
        ]);

        $type = $this->createType($city, $category, 'Музеї');

        DB::table('structures')->insert([
            'address' => 'вул. Єдності, 76',
            'name' => 'Марганецький міський краєзнавчий музей',
            'director' => 'Аліфірова Людмила Григорівна',
            'phone' => '0660393992',
            'working_hours' => 'вт.-сб. 08:30 - 17:00',
            'city_id' => $city->id,
            'category_id' => $category->id,
            'type_id' => $type->id,
            'uuid' => $this->generateUuid(),
            'latitude' => '47.634519',
            'longitude' => '34.624773',
        ]);

        $type = $this->createType($city, $category, 'Клуби');

        DB::table('structures')->insert([
            'address' => 'вул. Єдності, 86',
            'name' => 'клуб "Дніпро"',
            'director' => 'Жданюк Віталій Вікторович',
            'phone' => '0958667757',
            'working_hours' => 'пн.-пт. 08:00 - 17:00',
            'city_id' => $city->id,
            'category_id' => $category->id,
            'type_id' => $type->id,
            'uuid' => $this->generateUuid(),
            'latitude' => '47.6398173',
            'longitude' => '34.6280106',
        ]);

        $type = $this->createType($city, $category, 'Бібліотеки');

        DB::table('structures')->insert([
            'address' => 'вул. Палацова, 1',
            'name' => 'Міська центральна бібліотека ім. М.Островського',
            'director' => 'Пономарьорва Лідія Віталіївна',
            'phone' => '0507515078',
            'working_hours' => 'пн., ср., чт., пт., сб., нд 08:30 - 17:00',
            'city_id' => $city->id,
            'category_id' => $category->id,
            'type_id' => $type->id,
            'uuid' => $this->generateUuid(),
            'latitude' => '47.6359786',
            'longitude' => '34.629204',
        ]);

        DB::table('structures')->insert([
            'address' => 'вул. Садова, 1',
            'name' => 'Дитяча бібліотека',
            'director' => 'Подобєдова Юлія Олександрівна',
            'phone' => '0667976999',
            'working_hours' => 'пн.-пт. 08:00 - 17:00',
            'city_id' => $city->id,
            'category_id' => $category->id,
            'type_id' => $type->id,
            'uuid' => $this->generateUuid(),
            'latitude' => '47.6338992',
            'longitude' => '34.6234305',
        ]);

        DB::table('structures')->insert([
            'address' => 'вул. Історична, 37',
            'name' => 'Бібліотечний філіал № 1',
            'director' => 'Патяка Світлана Володимирівна',
            'phone' => '0990487622',
            'working_hours' => 'пн., вт., ср., чт., нд 09:00 - 18:00',
            'city_id' => $city->id,
            'category_id' => $category->id,
            'type_id' => $type->id,
            'uuid' => $this->generateUuid(),
            'latitude' => '47.6509687',
            'longitude' => '34.5898969',
        ]);

        DB::table('structures')->insert([
            'address' => 'вул. Палацова, 1',
            'name' => 'Бібліотечний філіал № 2',
            'director' => 'Мащенко Ірина Іванівна',
            'phone' => '0954752553',
            'working_hours' => 'пн., ср., чт., пт., сб., нд 08:30 - 17:00',
            'city_id' => $city->id,
            'category_id' => $category->id,
            'type_id' => $type->id,
            'uuid' => $this->generateUuid(),
            'latitude' => '47.6359786',
            'longitude' => '34.629204',
        ]);
    }
}
