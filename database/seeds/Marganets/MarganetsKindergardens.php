<?php

use Illuminate\Database\Seeder;

class MarganetsKindergardens extends BaseSeeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $city = $this->cityFindBySlug('marganets');
        $category = $this->createCategory($city, 'Школи та дитячі садочки');
        $type = $this->createType($city, $category, 'Дитячі садочки');

        DB::table('structures')->insert([
            'name' => 'Міське дитяче дошкільне об\'єднання',
            'address' => 'вул. Садова, буд. 13',
            'director' => 'Бородкіна Єлизавета Іванівна',
            'phone' => '(05665) 2-12-66',
            'working_hours' => '8.00-17.00',
            'city_id' => $city->id,
            'category_id' => $category->id,
            'type_id' => $type->id,
            'uuid' => $this->generateUuid(),
            'latitude' => '47.6312932',
            'longitude' => '34.6213258',
        ]);

        DB::table('structures')->insert([
            'name' => 'Комунальний дошкільний навчальний заклад комбінованого типу № 2 «Кульбабка»',
            'address' => 'вул. Єдності, буд.45-а',
            'director' => 'Литвин Наталя Василівна',
            'phone' => '(05665) 2-32-14',
            'working_hours' => '7.00-17.30|6.00-7.00; 17.30-18.00 - чергова група',
            'city_id' => $city->id,
            'category_id' => $category->id,
            'type_id' => $type->id,
            'uuid' => $this->generateUuid(),
            'latitude' => '47.6387783',
            'longitude' => '34.6255516',
        ]);

        DB::table('structures')->insert([
            'name' => 'Комунальний дошкільний навчальний заклад комбінованого типу № 5 «Веселі зайчата»',
            'address' => 'вул. Щаслива, буд.12',
            'director' => 'Бурлака Ольга Анатоліївна',
            'phone' => '(05665) 58-5-06',
            'working_hours' => '7.00-17.30|6.00-7.00; 17.30-18.00 - чергова група',
            'city_id' => $city->id,
            'category_id' => $category->id,
            'type_id' => $type->id,
            'uuid' => $this->generateUuid(),
            'latitude' => '47.6579481',
            'longitude' => '34.5837498',
        ]);

        DB::table('structures')->insert([
            'name' => 'Дошкільний навчальний заклад – навчально-виховний комплекс «Дошкільний навчальний заклад – загальноосвітній навчальний заклад – школа І ступеня» ',
            'address' => 'вул. Фестивальна, буд. 15-а',
            'director' => 'Дяконенко Інна Володимирівна',
            'phone' => '(05665) 3-35-26',
            'working_hours' => '7.00-17.30|6.00-7.00; 17.30-18.00 - чергова група',
            'city_id' => $city->id,
            'category_id' => $category->id,
            'type_id' => $type->id,
            'uuid' => $this->generateUuid(),
            'latitude' => '47.647274',
            'longitude' => '34.6411223',
        ]);

        DB::table('structures')->insert([
            'name' => 'Комунальний дошкільний навчальний заклад комбінованого типу № 10 «Оленка»',
            'address' => 'вул. Осипенко, буд. 13-а',
            'director' => 'Зозуля Наталія Григорівна',
            'phone' => '(05665) 3-17-77',
            'working_hours' => '7.00-17.30|6.00-7.00; 17.30-18.00 - чергова група',
            'city_id' => $city->id,
            'category_id' => $category->id,
            'type_id' => $type->id,
            'uuid' => $this->generateUuid(),
            'latitude' => '47.6403665',
            'longitude' => '34.651109',
        ]);

        DB::table('structures')->insert([
            'name' => 'Комунальний дошкільний навчальний заклад комбінованого типу № 13 «Берізка»',
            'address' => 'вул. Садова, буд. 13',
            'director' => 'Марчукова Олена Віталіївна',
            'phone' => '(05665) 2-14-22',
            'working_hours' => '7.00-17.30|6.00-7.00; 17.30-18.00 - чергова група',
            'city_id' => $city->id,
            'category_id' => $category->id,
            'type_id' => $type->id,
            'uuid' => $this->generateUuid(),
            'latitude' => '47.6312932',
            'longitude' => '34.6213258',
        ]);

        DB::table('structures')->insert([
            'name' => 'Комунальний дошкільний навчальний заклад компенсуючого типу «Психолого-медико-педагогічний центр розвитку дитини «Ромашка»',
            'address' => 'вул. Паркова, буд. 5',
            'director' => 'Новікова Людмила Іванівна',
            'phone' => '(05665) 3-16-85',
            'working_hours' => '7.00-17.30|6.00-7.00; 17.30-18.00 - чергова група',
            'city_id' => $city->id,
            'category_id' => $category->id,
            'type_id' => $type->id,
            'uuid' => $this->generateUuid(),
            'latitude' => '47.6418718',
            'longitude' => '34.6534858',
        ]);

        DB::table('structures')->insert([
            'name' => 'Комунальний дошкільний навчальний заклад комбінованого типу № 18 «Струмочок»',
            'address' => 'Ювілейний квартал ',
            'director' => 'Коваль Анжеліка Юріївна',
            'phone' => '(05665) 4-11-54',
            'working_hours' => '7.00-17.30|6.00-7.00; 17.30-18.00 - чергова група',
            'city_id' => $city->id,
            'category_id' => $category->id,
            'type_id' => $type->id,
            'uuid' => $this->generateUuid(),
            'latitude' => '47.651756',
            'longitude' => '34.650432',
        ]);

        DB::table('structures')->insert([
            'name' => 'Комунальний дошкільний навчальний заклад комбінованого типу № 20 «Буратіно»',
            'address' => 'Східний квартал, буд. 12-а ',
            'director' => 'Качко Світлана Олександрівна',
            'phone' => '(05665) 6-16-40',
            'working_hours' => '7.00-17.30|6.00-7.00; 17.30-18.00 - чергова група',
            'city_id' => $city->id,
            'category_id' => $category->id,
            'type_id' => $type->id,
            'uuid' => $this->generateUuid(),
            'latitude' => '47.6416562',
            'longitude' => '34.6597775',
        ]);
    }
}
