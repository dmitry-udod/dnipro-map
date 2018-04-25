<?php

namespace Tests;

use App\User;
use App\City;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    public function route($url)
    {
    	return "http://dnipro.localhost{$url}";
    }

    public function asAdmin()
    {
        $data = [
            'name' => 'Dmytro Udod',
            'email' => 'admin@gmail.com',
            'password' => '123456',
            'roles' => ["admin"],
            'cities' => ["1"],
        ];

        if(!is_null($user = User::where('email', $data['email'])->first())) {
            return $user;
        }

        return User::create($data);
    }

    public function adminLviv()
    {
        $this->createCategory();
        $u = $this->asAdmin();
        $u->cities = ["{$this->createCity()->id}"];
        $u->save();

        return $this->actingAs($u);
    }

    public function adminDnipro()
    {
        $this->createCategory();
        $u = $this->asAdmin();
        $u->cities = ["1"];
        $u->save();

        return $this->actingAs($u);
    }

    public function asSuperAdmin()
    {
        $data = [
            'name' => 'Superadmin',
            'email' => 'reedwalter24@gmail.com',
            'password' => '123456',
            'roles' => ["superadmin"],
        ];

        if(!is_null($user = User::where('email', $data['email'])->first())) {
            return $user;
        }

        return User::create($data);
    }


    public function asAnonymous()
    {
        return new User();
    }

    protected function superadmin()
    {
        return $this->actingAs($this->asSuperAdmin());
    }

    protected function admin()
    {
        return $this->actingAs($this->asAdmin());
    }

    protected function createCity()
    {
        $city = City::where('slug', 'lviv')->first();
        if (!$city) {
            $city = new City();
        }
        $city->name = 'Львiв';
        $city->slug = 'lviv';
        $city->save();

        return $city;
    }

    protected function createCategory()
    {
        $entity = \App\Category::where('slug', 'new-year-trees')->first();
        if (!$entity) {
            $entity = new \App\Category();
        }
        $entity->name = 'New Year Trees';
        $entity->slug = 'new-year-trees';
        $entity->order = 0;
        $entity->is_active = true;
        $entity->city_id = $this->createCity()->id;
        $entity->logo = '{}';
        $entity->save();

        return $entity;
    }

    protected function createCategoryForDnipro()
    {
        $entity = \App\Category::where('slug', 'maf')->first();
        if (!$entity) {
            $entity = new \App\Category();
        }
        $entity->name = 'MAF';
        $entity->slug = 'maf';
        $entity->order = 0;
        $entity->is_active = true;
        $entity->city_id = 1;
        $entity->logo = '{}';
        $entity->save();

        return $entity;
    }

    protected function cityBySlug($slug = 'cherkasi')
    {
        return City::where('slug', $slug)->firstOrFail();
    }
}
