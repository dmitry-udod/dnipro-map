<?php

namespace Tests;

use App\Claim;
use App\Repositories\ClaimRepository;
use App\Repositories\StructureRepository;
use App\Repositories\StructureRequestRepository;
use App\Structure;
use App\StructureRequest;
use App\User;
use App\City;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Support\Facades\Mail;
use Tests\Feature\AdminStructureTest;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    public function route($url, $city = 'dnipro')
    {
    	return "http://$city.localhost{$url}";
    }

    /**
     * @return User
     */
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
        $entity->logo = '{"path": "/photo.jpg"}';
        $entity->responsible_user_id = $this->asAdmin()->id;
        $entity->save();

        return $entity;
    }

    /**
     * @return \App\Category
     */
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
        $entity->logo = '{"path": "/dnipro_photo.jpg"}';
        $entity->save();

        return $entity;
    }

    protected function cityBySlug($slug = 'cherkasi')
    {
        return City::where('slug', $slug)->firstOrFail();
    }

    protected function createStructure()
    {
        $category = $this->createCategory();

        $data = [
            'address' => "бульвар Шевченка 368",
            'category_id' => $category->id,
            'type_id' => 1,
            'is_active' => true,
            'is_free'  => false,
            'latitude' => "48.4697571",
            'longitude' => "34.9357767",
        ];

        $structureRepository = new StructureRepository();
        session()->put('currentCity', $this->createCity());
        $structureRepository->save($data);


        return Structure::first();
    }

    /**
     * Create user claim
     *
     * @return Claim
     */
    protected function createClaim()
    {
        Mail::fake();

        $structure = $this->createStructure();

        $data = [
            'name' => 'Dima Udod',
            'phone' => '+380938300000',
            'email' => 'reedwalter24@gmail.com',
            'category' => 1,
            'description'  => 'Very bad place',
            'structure_id'  => $structure->uuid,
        ];

        $repository = new ClaimRepository();
        $repository->createFromUser($data, $this->createCity()->slug);

        return Claim::first();
    }

    /**
     * Create user claim
     *
     * @return StructureRequest
     */
    protected function createStructureRequest()
    {
        Mail::fake();

        $data = [
            'name' => 'Dima Udod',
            'email' => 'reedwalter24@gmail.com',
            'description'  => 'Very nice place',
            'address'  => 'Baiker Street 36',
            'latitude' => '1',
            'longitude' => '2',
            'category_id' => $this->createCategory()->id,
        ];

        $repository = new StructureRequestRepository();
        $repository->createFromUser($data, $this->createCity()->slug);

        return StructureRequest::first();
    }
}
